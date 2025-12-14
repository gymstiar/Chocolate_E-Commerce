<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.product', 'payment'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('buyer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['items.product.primaryImage', 'payment', 'address']);

        return view('buyer.orders.show', compact('order'));
    }

    public function uploadPayment(Request $request, Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bank_name' => 'required|string|max:100',
            'account_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'notes' => 'nullable|string|max:500',
        ]);

        // Upload image
        $path = $request->file('proof_image')->store('payments', 'public');

        // Update payment
        $order->payment->update([
            'proof_image' => $path,
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'notes' => $request->notes,
            'status' => 'uploaded',
        ]);

        return back()->with('success', 'Payment proof uploaded successfully! Please wait for verification.');
    }

    public function confirmDelivery(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'delivered') {
            return back()->with('error', 'Cannot confirm delivery for this order.');
        }

        $order->update([
            'status' => 'completed',
        ]);

        return back()->with('success', 'Order completed! Thank you for shopping with us.');
    }

    public function invoice(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['items.product', 'user', 'address', 'payment']);

        return view('orders.invoice', compact('order'));
    }
}
