<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'buyer')
            ->withCount('orders')
            ->withSum('orders', 'total');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $customers = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('seller.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        if ($customer->role !== 'buyer') {
            abort(404);
        }

        $orders = Order::with(['items', 'payment'])
            ->withCount('items')
            ->where('user_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalSpent = Order::where('user_id', $customer->id)
            ->where('status', 'completed')
            ->sum('total');

        return view('seller.customers.show', compact('customer', 'orders', 'totalSpent'));
    }
}
