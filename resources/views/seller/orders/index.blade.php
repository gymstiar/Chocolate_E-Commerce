@extends('layouts.seller')

@section('title', 'Orders - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-receipt me-2" style="color: var(--chocolate-gold);"></i>Orders
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <!-- Filters -->
        <div class="card card-chocolate mb-4" data-aos="fade-up">
            <div class="card-body">
                <form action="{{ route('seller.orders.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control form-control-chocolate" placeholder="Order # or customer..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select form-control-chocolate">
                            <option value="">All Status</option>
                            <option value="waiting_payment" {{ request('status') == 'waiting_payment' ? 'selected' : '' }}>Waiting Payment</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">From Date</label>
                        <input type="date" name="date_from" class="form-control form-control-chocolate" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">To Date</label>
                        <input type="date" name="date_to" class="form-control form-control-chocolate" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-chocolate"><i class="bi bi-search me-1"></i>Filter</button>
                        <a href="{{ route('seller.orders.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="card card-chocolate" data-aos="fade-up">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td><strong>{{ $order->order_number }}</strong></td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->items->count() }} item(s)</td>
                                <td class="fw-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>
                                    @if($order->payment)
                                        <span class="badge bg-{{ $order->payment->status_badge }}">{{ $order->payment->status_label }}</span>
                                    @else
                                        <span class="badge bg-secondary">No Payment</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('seller.orders.show', $order) }}" class="btn btn-sm btn-outline-chocolate">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="bi bi-receipt display-4 text-muted"></i>
                                    <p class="text-muted mt-3">No orders yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</section>
@endsection
