@extends('layouts.seller')

@section('title', 'Seller Dashboard - ChocoLuxe')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
                    <i class="bi bi-speedometer2 me-2" style="color: var(--chocolate-gold);"></i>Seller Dashboard
                </h2>
                <p class="text-white-50 mb-0">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
            <div class="col-auto">
                {{-- <a href="{{ route('seller.products.create') }}" class="btn btn-gold">
                    <i class="bi bi-plus-circle me-2"></i>Add Product
                </a> --}}
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-chocolate h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Revenue</h6>
                                <h3 class="fw-bold mb-0" style="color: var(--chocolate-gold);">
                                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                                </h3>
                            </div>
                            <div style="width: 60px; height: 60px; background: var(--chocolate-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-currency-dollar fs-4 text-dark"></i>
                            </div>
                        </div>
                        <hr>
                        <small class="text-success"><i class="bi bi-graph-up-arrow me-1"></i>Monthly: Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-chocolate h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Orders</h6>
                                <h3 class="fw-bold mb-0" style="color: var(--chocolate-light);">{{ $totalOrders }}</h3>
                            </div>
                            <div style="width: 60px; height: 60px; background: var(--chocolate-light); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-receipt fs-4 text-white"></i>
                            </div>
                        </div>
                        <hr>
                        <small class="text-warning"><i class="bi bi-clock me-1"></i>{{ $pendingPayments }} pending payments</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-chocolate h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Products</h6>
                                <h3 class="fw-bold mb-0" style="color: var(--chocolate-medium);">{{ $totalProducts }}</h3>
                            </div>
                            <div style="width: 60px; height: 60px; background: var(--chocolate-medium); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-box-seam fs-4 text-white"></i>
                            </div>
                        </div>
                        <hr>
                        <small class="text-danger"><i class="bi bi-exclamation-triangle me-1"></i>{{ $lowStockProducts->count() }} low stock</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card card-chocolate h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Customers</h6>
                                <h3 class="fw-bold mb-0" style="color: #28a745;">{{ $totalCustomers }}</h3>
                            </div>
                            <div style="width: 60px; height: 60px; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-people fs-4 text-white"></i>
                            </div>
                        </div>
                        <hr>
                        <a href="{{ route('seller.customers.index') }}" class="small text-decoration-none">View all customers <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Sales Chart -->
            <div class="col-lg-8" data-aos="fade-right">
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent border-bottom">
                        <h5 class="mb-0"><i class="bi bi-graph-up me-2" style="color: var(--chocolate-gold);"></i>Sales Overview (Last 6 Months)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Low Stock -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent border-bottom">
                        <h5 class="mb-0"><i class="bi bi-lightning me-2" style="color: var(--chocolate-gold);"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('seller.products.create') }}" class="btn btn-chocolate w-100 mb-2">
                            <i class="bi bi-plus-circle me-2"></i>Add New Product
                        </a>
                        <a href="{{ route('seller.promos.create') }}" class="btn btn-gold w-100 mb-2">
                            <i class="bi bi-ticket-perforated me-2"></i>Add New Promo
                        </a>
                        <a href="{{ route('seller.orders.index') }}?status=waiting_payment" class="btn btn-outline-chocolate w-100 mb-2">
                            <i class="bi bi-credit-card me-2"></i>Pending Payments
                        </a>
                        <a href="{{ route('seller.reports.sales') }}" class="btn btn-outline-chocolate w-100">
                            <i class="bi bi-bar-chart me-2"></i>View Reports
                        </a>
                    </div>
                </div>

                @if($lowStockProducts->count() > 0)
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent border-bottom">
                        <h5 class="mb-0 text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Low Stock Alert</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($lowStockProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ Str::limit($product->name, 20) }}</strong>
                                    <br><small class="text-muted">Stock: {{ $product->stock }}</small>
                                </div>
                                <a href="{{ route('seller.products.edit', $product) }}" class="btn btn-sm btn-outline-chocolate">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Recent Orders & Top Products -->
        <div class="row g-4 mt-2">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-receipt me-2" style="color: var(--chocolate-gold);"></i>Recent Orders</h5>
                        <a href="{{ route('seller.orders.index') }}" class="btn btn-sm btn-chocolate">View All</a>
                    </div>
                    <div class="card-body p-0">
                        @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="fw-semibold">{{ $order->order_number }}</td>
                                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                                        <td>{{ $order->created_at->format('M d, H:i') }}</td>
                                        <td class="fw-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td><span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                                        <td>
                                            <a href="{{ route('seller.orders.show', $order) }}" class="btn btn-sm btn-outline-chocolate"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="bi bi-receipt display-4 text-muted"></i>
                            <p class="text-muted mt-3">No orders yet</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up">
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent border-bottom">
                        <h5 class="mb-0"><i class="bi bi-trophy me-2" style="color: var(--chocolate-gold);"></i>Top Selling Products</h5>
                    </div>
                    <div class="card-body p-0">
                        @if($topProducts->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($topProducts as $index => $product)
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge rounded-pill me-3" style="background: {{ $index === 0 ? 'var(--chocolate-gold)' : 'var(--chocolate-light)' }}; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex-grow-1">
                                    <strong>{{ Str::limit($product->name, 25) }}</strong>
                                    <br><small class="text-muted">{{ $product->total_sold }} sold</small>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <div class="text-center py-5">
                            <i class="bi bi-trophy display-4 text-muted"></i>
                            <p class="text-muted mt-3">No sales data yet</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartData['labels']) !!},
        datasets: [{
            label: 'Revenue (Rp)',
            data: {!! json_encode($chartData['data']) !!},
            borderColor: '#D4AF37',
            backgroundColor: 'rgba(212, 175, 55, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#D4AF37',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
@endpush
@endsection
