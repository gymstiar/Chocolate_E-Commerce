<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Promo;
use App\Models\Address;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['product.primaryImage'])
            ->where('user_id', auth()->id())
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('buyer.cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->current_price * $item->quantity;
        });

        $addresses = Address::where('user_id', auth()->id())->get();
        $defaultAddress = $addresses->where('is_default', true)->first() ?? $addresses->first();

        // Get active promos
        $promos = Promo::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->where(function ($query) {
                $query->whereNull('usage_limit')
                    ->orWhereColumn('used_count', '<', 'usage_limit');
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Calculate discount if promo is applied
        $discount = 0;
        $appliedPromo = null;
        if (session()->has('promo_code')) {
            $appliedPromo = Promo::where('code', session('promo_code'))->first();
            if ($appliedPromo && $appliedPromo->isValid()) {
                $discount = $appliedPromo->calculateDiscount($subtotal);
            } else {
                // Clear invalid promo
                session()->forget('promo_code');
                $appliedPromo = null;
            }
        }

        $shippingCost = 15000; // Default shipping
        $total = $subtotal - $discount + $shippingCost;

        return view('buyer.checkout', compact('cartItems', 'subtotal', 'addresses', 'defaultAddress', 'promos', 'discount', 'appliedPromo', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'shipping_method' => 'required|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string|max:500',
        ]);

        $cartItems = Cart::with(['product'])
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('buyer.cart')->with('error', 'Your cart is empty.');
        }

        // Validate stock
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->with('error', "Not enough stock for {$item->product->name}.");
            }
        }

        DB::beginTransaction();

        try {
            // Calculate totals
            $subtotal = $cartItems->sum(function ($item) {
                return $item->product->current_price * $item->quantity;
            });

            $discount = 0;
            $promoId = null;

            // Apply promo if exists in session
            if (session()->has('promo_code')) {
                $promo = Promo::where('code', session('promo_code'))->first();
                if ($promo && $promo->isValid()) {
                    $discount = $promo->calculateDiscount($subtotal);
                    $promoId = $promo->id;
                    $promo->increment('used_count');
                }
            }

            // Shipping cost (simplified)
            $shippingCost = $request->shipping_method === 'express' ? 25000 : 15000;

            $total = $subtotal - $discount + $shippingCost;

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $request->address_id,
                'promo_id' => $promoId,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => 'waiting_payment',
                'shipping_method' => $request->shipping_method,
                'notes' => $request->notes,
            ]);

            // Create order items and reduce stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->current_price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->product->current_price * $item->quantity,
                ]);

                // Reduce stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $total,
                'status' => 'pending',
            ]);

            // Clear cart
            Cart::where('user_id', auth()->id())->delete();

            // Clear promo from session
            session()->forget('promo_code');

            // Notify sellers about new order
            $sellers = User::where('role', 'seller')->get();
            foreach ($sellers as $seller) {
                Notification::create([
                    'user_id' => $seller->id,
                    'type' => 'new_order',
                    'title' => 'New Order Received!',
                    'message' => 'Order #' . $order->order_number . ' has been placed by ' . auth()->user()->name . ' for Rp ' . number_format($total, 0, ',', '.'),
                    'link' => route('seller.orders.show', $order),
                    'data' => ['order_id' => $order->id, 'order_number' => $order->order_number],
                ]);
            }

            DB::commit();

            return redirect()->route('buyer.orders.show', $order)
                ->with('success', 'Order placed successfully! Please complete the payment.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to process order. Please try again.');
        }
    }

    public function applyPromo(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
        ]);

        $promo = Promo::where('code', strtoupper($request->promo_code))->first();

        if (!$promo) {
            return back()->with('error', 'Invalid promo code.');
        }

        if (!$promo->isValid()) {
            return back()->with('error', 'This promo code is no longer valid.');
        }

        // Get cart subtotal
        $cartItems = Cart::with(['product'])
            ->where('user_id', auth()->id())
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->current_price * $item->quantity;
        });

        if ($promo->min_purchase && $subtotal < $promo->min_purchase) {
            return back()->with('error', 'Minimum purchase of Rp ' . number_format($promo->min_purchase, 0, ',', '.') . ' required.');
        }

        session(['promo_code' => $promo->code]);

        return back()->with('success', 'Promo code applied! You get ' . 
            ($promo->type === 'percentage' ? $promo->value . '%' : 'Rp ' . number_format($promo->value, 0, ',', '.')) . ' discount.');
    }

    public function removePromo()
    {
        session()->forget('promo_code');
        
        return back()->with('success', 'Promo code removed.');
    }
}
