@extends('layouts.seller')

@section('title', 'Reports - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-graph-up me-2" style="color: var(--chocolate-gold);"></i>Sales Reports
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <!-- Date Filter -->
        <div class="card card-chocolate mb-4" data-aos="fade-up" style="overflow: visible;">
            <div class="card-body" style="overflow: visible;">
                <form action="{{ route('seller.reports.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">From Date</label>
                        <input type="date" name="date_from" class="form-control form-control-chocolate" value="{{ request('date_from', now()->startOfMonth()->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">To Date</label>
                        <input type="date" name="date_to" class="form-control form-control-chocolate" value="{{ request('date_to', now()->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-chocolate"><i class="bi bi-filter me-1"></i>Apply Filter</button>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ route('seller.reports.export', array_merge(request()->query(), ['format' => 'csv'])) }}" class="btn btn-outline-success">
                                <i class="bi bi-filetype-csv me-1"></i>CSV
                            </a>
                            <a href="{{ route('seller.reports.export', array_merge(request()->query(), ['format' => 'excel'])) }}" class="btn btn-outline-success">
                                <i class="bi bi-file-earmark-excel me-1"></i>Excel
                            </a>
                            <a href="{{ route('seller.reports.export', array_merge(request()->query(), ['format' => 'pdf'])) }}" class="btn btn-outline-danger" target="_blank">
                                <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3" data-aos="fade-up">
                <div class="card card-chocolate text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-receipt display-4" style="color: var(--chocolate-gold);"></i>
                        <h3 class="mt-3">{{ $stats['total_orders'] ?? 0 }}</h3>
                        <p class="text-muted mb-0">Total Orders</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="50">
                <div class="card card-chocolate text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-cash-stack display-4 me-2" style="color: var(--chocolate-gold);"></i>
                        <span class="display-4 fw-bold" style="color: var(--chocolate-gold);"></span>
                        <h3 class="mt-3">Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Total Revenue</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-chocolate text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-box-seam display-4" style="color: var(--chocolate-gold);"></i>
                        <h3 class="mt-3">{{ $stats['total_products_sold'] ?? 0 }}</h3>
                        <p class="text-muted mb-0">Products Sold</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="150">
                <div class="card card-chocolate text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-calculator display-4" style="color: var(--chocolate-gold);"></i>
                        <h3 class="mt-3">Rp {{ number_format($stats['average_order'] ?? 0, 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Avg Order Value</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Top Products -->
            <div class="col-lg-6 mb-4" data-aos="fade-up">
                <div class="card card-chocolate h-100">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-star me-2" style="color: var(--chocolate-gold);"></i>Top Selling Products</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr><th>Product</th><th>Qty Sold</th><th>Revenue</th></tr>
                                </thead>
                                <tbody>
                                    @forelse($topProducts ?? [] as $product)
                                    <tr>
                                        <td>{{ $product->name ?? 'N/A' }}</td>
                                        <td>{{ $product->total_qty ?? 0 }}</td>
                                        <td>Rp {{ number_format($product->total_revenue ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center text-muted py-4">No data</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales by Category -->
            <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-chocolate h-100">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-pie-chart me-2" style="color: var(--chocolate-gold);"></i>Sales by Category</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr><th>Category</th><th>Orders</th><th>Revenue</th></tr>
                                </thead>
                                <tbody>
                                    @forelse($salesByCategory ?? [] as $cat)
                                    <tr>
                                        <td>{{ $cat->name ?? 'N/A' }}</td>
                                        <td>{{ $cat->orders_count ?? 0 }}</td>
                                        <td>Rp {{ number_format($cat->revenue ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center text-muted py-4">No data</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="card card-chocolate" data-aos="fade-up">
            <div class="card-header bg-transparent">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2" style="color: var(--chocolate-gold);"></i>Recent Orders (This Period)</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr><th>Order #</th><th>Customer</th><th>Total</th><th>Status</th><th>Date</th></tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders ?? [] as $order)
                            <tr>
                                <td><a href="{{ route('seller.orders.show', $order) }}">{{ $order->order_number }}</a></td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td><span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No orders in this period</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
