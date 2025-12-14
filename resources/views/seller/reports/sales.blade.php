@extends('layouts.seller')

@section('title', 'Sales Report - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('seller.reports.index') }}" class="text-white text-decoration-none">Reports</a></li>
                <li class="breadcrumb-item active text-white-50">Sales</li>
            </ol>
        </nav>
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-graph-up me-2" style="color: var(--chocolate-gold);"></i>Sales Report
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <!-- Date Filter -->
        <div class="card card-chocolate mb-4" data-aos="fade-up">
            <div class="card-body">
                <form action="{{ route('seller.reports.sales') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control form-control-chocolate" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control form-control-chocolate" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-chocolate"><i class="bi bi-filter me-1"></i>Apply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card card-chocolate text-center">
                    <div class="card-body">
                        <i class="bi bi-receipt display-4" style="color: var(--chocolate-gold);"></i>
                        <h3 class="mt-3">{{ $totalOrders }}</h3>
                        <p class="text-muted mb-0">Total Orders</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="50">
                <div class="card card-chocolate text-center">
                    <div class="card-body">
                        <i class="bi bi-currency-dollar display-4" style="color: var(--chocolate-gold);"></i>
                        <h3 class="mt-3">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Total Sales</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-chocolate text-center">
                    <div class="card-body">
                        <i class="bi bi-calculator display-4" style="color: var(--chocolate-gold);"></i>
                        <h3 class="mt-3">Rp {{ number_format($averageOrder, 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Average Order</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Sales -->
        <div class="card card-chocolate mb-4" data-aos="fade-up">
            <div class="card-header bg-transparent">
                <h5 class="mb-0"><i class="bi bi-calendar me-2" style="color: var(--chocolate-gold);"></i>Daily Sales</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr><th>Date</th><th>Orders</th><th>Revenue</th></tr>
                        </thead>
                        <tbody>
                            @forelse($dailySales as $day)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($day->date)->format('d M Y') }}</td>
                                <td>{{ $day->orders }}</td>
                                <td>Rp {{ number_format($day->total, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center py-4 text-muted">No sales data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Orders List -->
        <div class="card card-chocolate" data-aos="fade-up">
            <div class="card-header bg-transparent">
                <h5 class="mb-0"><i class="bi bi-list me-2" style="color: var(--chocolate-gold);"></i>Order Details</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr><th>Order #</th><th>Date</th><th>Customer</th><th>Items</th><th>Total</th></tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td><a href="{{ route('seller.orders.show', $order) }}">{{ $order->order_number }}</a></td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->items->count() }}</td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center py-4 text-muted">No orders</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
