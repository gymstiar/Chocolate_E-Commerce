<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items', 'payment']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('order_number', 'like', '%' . $request->search . '%')
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('seller.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product.primaryImage', 'payment', 'address']);
        return view('seller.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Block status changes for completed or cancelled orders
        if (in_array($order->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Cannot change status for ' . ucfirst($order->status) . ' orders. This status is final.');
        }

        $request->validate([
            'status' => 'required|in:pending,waiting_payment,paid,processing,shipped,delivered,completed,cancelled',
        ]);

        // Restore stock if order is being cancelled
        if ($request->status === 'cancelled' && $order->status !== 'cancelled') {
            $order->load('items');
            foreach ($order->items as $item) {
                if ($item->product_id) {
                    \App\Models\Product::find($item->product_id)?->increment('stock', $item->quantity);
                }
            }
        }

        $order->update(['status' => $request->status]);

        // Update timestamps
        if ($request->status === 'paid') {
            $order->update(['paid_at' => now()]);
        } elseif ($request->status === 'shipped') {
            $order->update(['shipped_at' => now()]);
        } elseif ($request->status === 'delivered') {
            $order->update(['delivered_at' => now()]);
        }

        // Notify buyer about status change
        $statusLabels = [
            'processing' => 'is being processed',
            'shipped' => 'has been shipped',
            'delivered' => 'has been delivered',
            'completed' => 'is complete',
            'cancelled' => 'has been cancelled',
        ];
        
        if (isset($statusLabels[$request->status])) {
            Notification::create([
                'user_id' => $order->user_id,
                'type' => 'order_' . $request->status,
                'title' => 'Order Update',
                'message' => 'Your order #' . $order->order_number . ' ' . $statusLabels[$request->status] . '.',
                'link' => route('buyer.orders.show', $order),
                'data' => ['order_id' => $order->id, 'status' => $request->status],
            ]);
        }

        return back()->with('success', 'Order status updated successfully!');
    }

    public function verifyPayment(Request $request, Order $order)
    {
        $request->validate([
            'action' => 'required|in:verify,reject',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        if ($request->action === 'verify') {
            $order->payment->update([
                'status' => 'verified',
                'verified_at' => now(),
                'admin_notes' => $request->admin_notes,
            ]);
            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
            $message = 'Payment verified successfully!';
            
            // Notify buyer
            Notification::create([
                'user_id' => $order->user_id,
                'type' => 'payment_verified',
                'title' => 'Payment Verified!',
                'message' => 'Your payment for order #' . $order->order_number . ' has been verified. Your order is now being processed.',
                'link' => route('buyer.orders.show', $order),
            ]);
        } else {
            $order->payment->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes,
            ]);
            $order->update(['status' => 'waiting_payment']);
            $message = 'Payment rejected. Customer will be notified.';
            
            // Notify buyer
            Notification::create([
                'user_id' => $order->user_id,
                'type' => 'payment_rejected',
                'title' => 'Payment Rejected',
                'message' => 'Your payment for order #' . $order->order_number . ' was rejected. Reason: ' . ($request->admin_notes ?? 'Please contact support.'),
                'link' => route('buyer.orders.show', $order),
            ]);
        }

        return back()->with('success', $message);
    }

    public function updateShipping(Request $request, Order $order)
    {
        $request->validate([
            'tracking_number' => 'required|string|max:100',
            'shipping_method' => 'nullable|string|max:50',
        ]);

        $order->update([
            'tracking_number' => $request->tracking_number,
            'shipping_method' => $request->shipping_method ?? $order->shipping_method,
            'status' => 'shipped',
            'shipped_at' => now(),
        ]);

        return back()->with('success', 'Shipping information updated!');
    }

    public function invoice(Order $order)
    {
        $order->load(['items.product', 'user', 'address', 'payment']);

        return view('orders.invoice', compact('order'));
    }
}
