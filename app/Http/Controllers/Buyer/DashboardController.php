<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get order statistics
        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'waiting_payment', 'paid', 'processing', 'shipped'])
            ->count();
        $completedOrders = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        
        // Get recent orders
        $recentOrders = Order::with(['items.product'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get wishlist count
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();
        
        // Get cart count
        $cartCount = Cart::where('user_id', $user->id)->sum('quantity');
        
        // Calculate total spent
        $totalSpent = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->sum('total');

        return view('buyer.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'recentOrders',
            'wishlistCount',
            'cartCount',
            'totalSpent'
        ));
    }
}
