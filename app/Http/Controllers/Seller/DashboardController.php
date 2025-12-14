<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total stats
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'buyer')->count();
        
        // Revenue stats
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Recent orders
        $recentOrders = Order::with(['user', 'items'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Pending payments
        $pendingPayments = Order::where('status', 'waiting_payment')
            ->orWhereHas('payment', function ($q) {
                $q->where('status', 'uploaded');
            })
            ->count();

        // Low stock products
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->where('stock', '>', 0)
            ->limit(5)
            ->get();

        // Monthly sales chart data (last 6 months)
        $chartData = $this->getMonthlyChartData();

        // Top selling products
        $topProducts = Product::select('products.*')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        return view('seller.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalRevenue',
            'monthlyRevenue',
            'recentOrders',
            'pendingPayments',
            'lowStockProducts',
            'chartData',
            'topProducts'
        ));
    }

    private function getMonthlyChartData()
    {
        $months = [];
        $sales = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            $monthSales = Order::where('status', 'completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total');
            
            $sales[] = $monthSales;
        }

        return [
            'labels' => $months,
            'data' => $sales,
        ];
    }
}
