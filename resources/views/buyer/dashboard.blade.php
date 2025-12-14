@extends('layouts.app')

@section('title', 'Dashboard - ChocoLuxe')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
                    <i class="bi bi-speedometer2 me-2" style="color: var(--chocolate-gold);"></i>Buyer Dashboard
                </h2>
                <p class="text-white-50 mb-0">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3" style="width: 60px; height: 60px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-bag fs-4 text-dark"></i>
                        </div>
                        <h3 class="fw-bold mb-0" style="color: var(--chocolate-gold);">{{ $totalOrders }}</h3>
                        <small class="text-muted">Total Orders</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3" style="width: 60px; height: 60px; background: var(--chocolate-light); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-clock-history fs-4 text-white"></i>
                        </div>
                        <h3 class="fw-bold mb-0" style="color: var(--chocolate-light);">{{ $pendingOrders }}</h3>
                        <small class="text-muted">Pending Orders</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3" style="width: 60px; height: 60px; background: #28a745; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-check-circle fs-4 text-white"></i>
                        </div>
                        <h3 class="fw-bold mb-0" style="color: #28a745;">{{ $completedOrders }}</h3>
                        <small class="text-muted">Completed</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3" style="width: 60px; height: 60px; background: #dc3545; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-heart fs-4 text-white"></i>
                        </div>
                        <h3 class="fw-bold mb-0" style="color: #dc3545;">{{ $wishlistCount }}</h3>
                        <small class="text-muted">Wishlist Items</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Recent Orders -->
            <div class="col-lg-8" data-aos="fade-right">
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-receipt me-2" style="color: var(--chocolate-gold);"></i>Recent Orders</h5>
                        <a href="{{ route('buyer.orders') }}" class="btn btn-sm btn-chocolate">View All</a>
                    </div>
                    <div class="card-body p-0">
                        @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="fw-semibold">{{ $order->order_number }}</td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>{{ $order->items->count() }} item(s)</td>
                                        <td class="fw-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('buyer.orders.show', $order) }}" class="btn btn-sm btn-outline-chocolate">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="bi bi-bag-x display-4 text-muted"></i>
                            <p class="text-muted mt-3">No orders yet</p>
                            <a href="{{ route('products.index') }}" class="btn btn-chocolate">Start Shopping</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent border-bottom">
                        <h5 class="mb-0"><i class="bi bi-lightning me-2" style="color: var(--chocolate-gold);"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('products.index') }}" class="btn btn-chocolate w-100 mb-3">
                            <i class="bi bi-bag me-2"></i>Browse Products
                        </a>
                        <a href="{{ route('buyer.cart') }}" class="btn btn-outline-chocolate w-100 mb-3">
                            <i class="bi bi-cart me-2"></i>View Cart ({{ $cartCount }})
                        </a>
                        <a href="{{ route('buyer.wishlist') }}" class="btn btn-outline-chocolate w-100 mb-3">
                            <i class="bi bi-heart me-2"></i>My Wishlist
                        </a>
                        <a href="{{ route('profile') }}" class="btn btn-outline-chocolate w-100">
                            <i class="bi bi-person me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>

                <!-- Total Spent -->
                <div class="card card-chocolate">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-wallet2 display-4 mb-3" style="color: var(--chocolate-gold);"></i>
                        <h6 class="text-muted">Total Spent</h6>
                        <h3 class="fw-bold" style="color: var(--chocolate-gold);">
                            Rp {{ number_format($totalSpent, 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
