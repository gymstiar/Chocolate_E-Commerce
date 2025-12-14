@extends('layouts.seller')

@section('title', 'Customer {{ $customer->name }} - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('seller.customers.index') }}" class="text-white text-decoration-none">Customers</a></li>
                <li class="breadcrumb-item active text-white-50">{{ $customer->name }}</li>
            </ol>
        </nav>
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-person me-2" style="color: var(--chocolate-gold);"></i>{{ $customer->name }}
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4" data-aos="fade-right">
                <div class="card card-chocolate mb-4">
                    <div class="card-body text-center">
                        @if($customer->avatar)
                            <img src="{{ asset('storage/' . $customer->avatar) }}" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px; background: var(--chocolate-light); color: white; font-size: 2.5rem;">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>
                        @endif
                        <h4>{{ $customer->name }}</h4>
                        <p class="text-muted mb-0">{{ $customer->email }}</p>
                        <p class="text-muted">{{ $customer->phone ?? '-' }}</p>
                    </div>
                </div>

                <div class="card card-chocolate">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">Stats</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Orders</span>
                            <strong>{{ $customer->orders->count() }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Spent</span>
                            <strong style="color: var(--chocolate-gold);">Rp {{ number_format($customer->orders->sum('total'), 0, ',', '.') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Member Since</span>
                            <strong>{{ $customer->created_at->format('d M Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-left">
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-bag me-2" style="color: var(--chocolate-gold);"></i>Order History</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order #</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                    <tr>
                                        <td><a href="{{ route('seller.orders.show', $order) }}">{{ $order->order_number }}</a></td>
                                        <td>{{ $order->items_count ?? $order->items->count() }}</td>
                                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td><span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="5" class="text-center py-4 text-muted">No orders</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
