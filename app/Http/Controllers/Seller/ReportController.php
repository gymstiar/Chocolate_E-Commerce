<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $dateFrom = $request->get('date_from', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $dateTo = $request->get('date_to', Carbon::now()->format('Y-m-d'));

        // Get completed orders in date range
        $orders = Order::with(['user', 'items.product'])
            ->whereIn('status', ['completed', 'delivered'])
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->get();

        // Calculate stats
        $stats = [
            'total_orders' => $orders->count(),
            'total_revenue' => $orders->sum('total'),
            'total_products_sold' => $orders->sum(fn($o) => $o->items->sum('quantity')),
            'average_order' => $orders->count() > 0 ? $orders->sum('total') / $orders->count() : 0,
        ];

        // Top selling products
        $topProducts = Product::select('products.id', 'products.name')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_qty')
            ->selectRaw('COALESCE(SUM(order_items.subtotal), 0) as total_revenue')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function($join) use ($dateFrom, $dateTo) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->whereIn('orders.status', ['completed', 'delivered'])
                    ->whereDate('orders.created_at', '>=', $dateFrom)
                    ->whereDate('orders.created_at', '<=', $dateTo);
            })
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_qty')
            ->limit(10)
            ->get();

        // Sales by category
        $salesByCategory = Category::select('categories.id', 'categories.name')
            ->selectRaw('COUNT(DISTINCT orders.id) as orders_count')
            ->selectRaw('COALESCE(SUM(order_items.subtotal), 0) as revenue')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function($join) use ($dateFrom, $dateTo) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->whereIn('orders.status', ['completed', 'delivered'])
                    ->whereDate('orders.created_at', '>=', $dateFrom)
                    ->whereDate('orders.created_at', '<=', $dateTo);
            })
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('revenue')
            ->get();

        // Recent orders
        $recentOrders = $orders->sortByDesc('created_at')->take(10);

        return view('seller.reports.index', compact(
            'stats', 'topProducts', 'salesByCategory', 'recentOrders', 'dateFrom', 'dateTo'
        ));
    }

    public function sales(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        $orders = Order::with(['items.product', 'user'])
            ->whereIn('status', ['completed', 'delivered'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSales = $orders->sum('total');
        $totalOrders = $orders->count();
        $averageOrder = $totalOrders > 0 ? $totalSales / $totalOrders : 0;

        $dailySales = Order::whereIn('status', ['completed', 'delivered'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->selectRaw('DATE(created_at) as date, SUM(total) as total, COUNT(*) as orders')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('seller.reports.sales', compact(
            'orders', 'totalSales', 'totalOrders', 'averageOrder', 'dailySales', 'startDate', 'endDate'
        ));
    }

    public function products(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        $topProducts = Product::select('products.*')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
            ->selectRaw('COALESCE(SUM(order_items.subtotal), 0) as total_revenue')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function($join) use ($startDate, $endDate) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->whereIn('orders.status', ['completed', 'delivered'])
                    ->whereDate('orders.created_at', '>=', $startDate)
                    ->whereDate('orders.created_at', '<=', $endDate);
            })
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->paginate(20);

        return view('seller.reports.products', compact('topProducts', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');
        $dateFrom = $request->get('date_from', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $dateTo = $request->get('date_to', Carbon::now()->format('Y-m-d'));

        // Get product sales data
        $productSales = Product::select('products.id', 'products.name', 'products.price', 'products.stock')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as qty_sold')
            ->selectRaw('COALESCE(SUM(order_items.subtotal), 0) as total_revenue')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function($join) use ($dateFrom, $dateTo) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->whereIn('orders.status', ['completed', 'delivered'])
                    ->whereDate('orders.created_at', '>=', $dateFrom)
                    ->whereDate('orders.created_at', '<=', $dateTo);
            })
            ->with('category')
            ->groupBy('products.id', 'products.name', 'products.price', 'products.stock')
            ->orderByDesc('qty_sold')
            ->get();

        // Get order summary
        $orders = Order::with(['user', 'items'])
            ->whereIn('status', ['completed', 'delivered'])
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = "sales_report_{$dateFrom}_to_{$dateTo}";

        if ($format === 'excel') {
            return $this->exportExcel($productSales, $orders, $filename, $dateFrom, $dateTo);
        } elseif ($format === 'pdf') {
            return $this->exportPdf($productSales, $orders, $filename, $dateFrom, $dateTo);
        }

        // Default CSV
        return $this->exportCsv($productSales, $orders, $filename);
    }

    private function exportCsv($productSales, $orders, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}.csv\"",
        ];

        $callback = function () use ($productSales, $orders) {
            $file = fopen('php://output', 'w');
            
            // Product Sales Section
            fputcsv($file, ['=== PRODUCT SALES REPORT ===']);
            fputcsv($file, ['Product Name', 'Category', 'Unit Price', 'Qty Sold', 'Total Revenue', 'Current Stock']);
            
            foreach ($productSales as $product) {
                fputcsv($file, [
                    $product->name,
                    $product->category->name ?? '-',
                    $product->price,
                    $product->qty_sold,
                    $product->total_revenue,
                    $product->stock,
                ]);
            }
            
            fputcsv($file, []);
            fputcsv($file, ['=== ORDER SUMMARY ===']);
            fputcsv($file, ['Order #', 'Date', 'Customer', 'Items', 'Subtotal', 'Discount', 'Shipping', 'Total', 'Status']);
            
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->created_at->format('Y-m-d H:i'),
                    $order->user->name ?? 'N/A',
                    $order->items->count(),
                    $order->subtotal,
                    $order->discount,
                    $order->shipping_cost,
                    $order->total,
                    $order->status_label,
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportExcel($productSales, $orders, $filename, $dateFrom, $dateTo)
    {
        // Generate HTML-based Excel (works without external packages)
        $html = '
        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel">
        <head>
            <meta charset="UTF-8">
            <style>
                table { border-collapse: collapse; width: 100%; }
                th, td { border: 1px solid #333; padding: 8px; text-align: left; }
                th { background-color: #5D3A1A; color: white; }
                .header { font-size: 18px; font-weight: bold; background: #D4AF37; }
                .number { text-align: right; }
            </style>
        </head>
        <body>
            <h2>ChocoLuxe Sales Report</h2>
            <p>Period: ' . $dateFrom . ' to ' . $dateTo . '</p>
            
            <h3>Product Sales</h3>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Unit Price (Rp)</th>
                    <th>Qty Sold</th>
                    <th>Total Revenue (Rp)</th>
                    <th>Current Stock</th>
                </tr>';
        
        foreach ($productSales as $product) {
            $html .= '<tr>
                <td>' . htmlspecialchars($product->name) . '</td>
                <td>' . ($product->sku ?? '-') . '</td>
                <td>' . ($product->category->name ?? '-') . '</td>
                <td class="number">' . number_format($product->price, 0, ',', '.') . '</td>
                <td class="number">' . $product->qty_sold . '</td>
                <td class="number">' . number_format($product->total_revenue, 0, ',', '.') . '</td>
                <td class="number">' . $product->stock . '</td>
            </tr>';
        }
        
        $html .= '</table>
            
            <h3 style="margin-top: 30px;">Order Summary</h3>
            <table>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Subtotal (Rp)</th>
                    <th>Discount (Rp)</th>
                    <th>Shipping (Rp)</th>
                    <th>Total (Rp)</th>
                    <th>Status</th>
                </tr>';
        
        foreach ($orders as $order) {
            $html .= '<tr>
                <td>' . $order->order_number . '</td>
                <td>' . $order->created_at->format('Y-m-d H:i') . '</td>
                <td>' . htmlspecialchars($order->user->name ?? 'N/A') . '</td>
                <td class="number">' . $order->items->count() . '</td>
                <td class="number">' . number_format($order->subtotal, 0, ',', '.') . '</td>
                <td class="number">' . number_format($order->discount, 0, ',', '.') . '</td>
                <td class="number">' . number_format($order->shipping_cost, 0, ',', '.') . '</td>
                <td class="number">' . number_format($order->total, 0, ',', '.') . '</td>
                <td>' . $order->status_label . '</td>
            </tr>';
        }
        
        $html .= '</table>
            
            <h3 style="margin-top: 30px;">Summary</h3>
            <table style="width: 300px;">
                <tr><td>Total Orders</td><td class="number">' . $orders->count() . '</td></tr>
                <tr><td>Total Revenue</td><td class="number">Rp ' . number_format($orders->sum('total'), 0, ',', '.') . '</td></tr>
                <tr><td>Products Sold</td><td class="number">' . $productSales->sum('qty_sold') . '</td></tr>
            </table>
        </body>
        </html>';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}.xls\"");
    }

    private function exportPdf($productSales, $orders, $filename, $dateFrom, $dateTo)
    {
        // Generate HTML that can be printed as PDF
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Sales Report</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; color: #333; margin: 20px; }
                h1 { color: #5D3A1A; border-bottom: 2px solid #D4AF37; padding-bottom: 10px; }
                h2 { color: #5D3A1A; margin-top: 30px; }
                table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
                th { background-color: #5D3A1A; color: white; padding: 10px; text-align: left; }
                td { border: 1px solid #ddd; padding: 8px; }
                tr:nth-child(even) { background-color: #f9f9f9; }
                .number { text-align: right; }
                .summary-box { background: #FFF8E7; border: 2px solid #D4AF37; padding: 15px; margin: 20px 0; }
                .summary-box h3 { color: #5D3A1A; margin-top: 0; }
                .print-btn { 
                    background: #5D3A1A; color: white; padding: 10px 20px; border: none; 
                    cursor: pointer; font-size: 14px; margin-bottom: 20px;
                }
                @media print { .print-btn { display: none; } }
            </style>
        </head>
        <body>
            <button class="print-btn" onclick="window.print()">🖨️ Print / Save as PDF</button>
            
            <h1>🍫 ChocoLuxe Sales Report</h1>
            <p><strong>Period:</strong> ' . $dateFrom . ' to ' . $dateTo . '</p>
            <p><strong>Generated:</strong> ' . now()->format('d M Y H:i') . '</p>
            
            <div class="summary-box">
                <h3>📊 Summary</h3>
                <table style="width: auto; border: none;">
                    <tr><td style="border: none; padding: 5px 20px 5px 0;"><strong>Total Orders:</strong></td><td style="border: none;">' . $orders->count() . '</td></tr>
                    <tr><td style="border: none; padding: 5px 20px 5px 0;"><strong>Total Revenue:</strong></td><td style="border: none;">Rp ' . number_format($orders->sum('total'), 0, ',', '.') . '</td></tr>
                    <tr><td style="border: none; padding: 5px 20px 5px 0;"><strong>Products Sold:</strong></td><td style="border: none;">' . $productSales->sum('qty_sold') . ' units</td></tr>
                    <tr><td style="border: none; padding: 5px 20px 5px 0;"><strong>Average Order:</strong></td><td style="border: none;">Rp ' . number_format($orders->count() > 0 ? $orders->sum('total') / $orders->count() : 0, 0, ',', '.') . '</td></tr>
                </table>
            </div>
            
            <h2>📦 Product Sales</h2>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Unit Price</th>
                    <th>Qty Sold</th>
                    <th>Revenue</th>
                    <th>Stock</th>
                </tr>';
        
        foreach ($productSales->take(20) as $product) {
            $html .= '<tr>
                <td>' . htmlspecialchars($product->name) . '</td>
                <td>' . ($product->category->name ?? '-') . '</td>
                <td class="number">Rp ' . number_format($product->price, 0, ',', '.') . '</td>
                <td class="number">' . $product->qty_sold . '</td>
                <td class="number">Rp ' . number_format($product->total_revenue, 0, ',', '.') . '</td>
                <td class="number">' . $product->stock . '</td>
            </tr>';
        }
        
        $html .= '</table>
            
            <h2>🧾 Order Details</h2>
            <table>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>';
        
        foreach ($orders->take(20) as $order) {
            $html .= '<tr>
                <td>' . $order->order_number . '</td>
                <td>' . $order->created_at->format('d M Y') . '</td>
                <td>' . htmlspecialchars($order->user->name ?? 'N/A') . '</td>
                <td class="number">' . $order->items->count() . '</td>
                <td class="number">Rp ' . number_format($order->total, 0, ',', '.') . '</td>
                <td>' . $order->status_label . '</td>
            </tr>';
        }
        
        $html .= '</table>
            
            <p style="text-align: center; margin-top: 30px; color: #888;">
                Generated by ChocoLuxe E-Commerce System
            </p>
        </body>
        </html>';

        return response($html)
            ->header('Content-Type', 'text/html');
    }
}
