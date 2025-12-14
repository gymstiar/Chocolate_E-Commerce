@extends('layouts.app')

@section('title', 'Order {{ $order->order_number }} - ChocoLuxe')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('buyer.orders') }}" class="text-white text-decoration-none">My Orders</a></li>
                <li class="breadcrumb-item active text-white-50">{{ $order->order_number }}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
                <i class="bi bi-receipt me-2" style="color: var(--chocolate-gold);"></i>{{ $order->order_number }}
            </h2>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('buyer.orders.invoice', $order) }}" class="btn btn-sm" style="background: var(--chocolate-gold); color: var(--chocolate-dark);" target="_blank">
                    <i class="bi bi-printer me-1"></i>Print Invoice
                </a>
                <span class="badge bg-{{ $order->status_badge }} fs-6">{{ $order->status_label }}</span>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-right">
                <!-- Order Items -->
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-bag me-2" style="color: var(--chocolate-gold);"></i>Order Items</h5>
                    </div>
                    <div class="card-body p-0">
                        @foreach($order->items as $item)
                        <div class="d-flex p-3 border-bottom">
                            <div class="flex-shrink-0">
                                @if($item->product && $item->product->primaryImage)
                                    <img src="{{ asset('storage/' . $item->product->primaryImage->image) }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=100" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">{{ $item->product_name }}</h6>
                                <small class="text-muted">Qty: {{ $item->quantity }}</small>
                            </div>
                            <div class="text-end">
                                <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                                <small class="d-block text-muted">@ Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping Info -->
                @if($order->address)
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-geo-alt me-2" style="color: var(--chocolate-gold);"></i>Shipping Address</h5>
                    </div>
                    <div class="card-body">
                        <strong>{{ $order->address->recipient_name }}</strong> | {{ $order->address->phone }}
                        <p class="mb-0 mt-1 text-muted">{{ $order->address->full_address }}</p>
                        @if($order->tracking_number || $order->shipping_method)
                        <hr>
                        <div class="row">
                            @if($order->shipping_method)
                            <div class="col-sm-6 mb-2">
                                <i class="bi bi-truck me-2" style="color: var(--chocolate-gold);"></i>
                                <strong>Shipping Method:</strong><br>
                                <span class="badge bg-info">{{ $order->shipping_method }}</span>
                            </div>
                            @endif
                            @if($order->tracking_number)
                            <div class="col-sm-6 mb-2">
                                <i class="bi bi-box-seam me-2" style="color: var(--chocolate-gold);"></i>
                                <strong>Tracking Number:</strong><br>
                                <code class="fs-6">{{ $order->tracking_number }}</code>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Order Notes -->
                @if($order->notes)
                <div class="card card-chocolate mb-4 border-info">
                    <div class="card-header bg-info bg-opacity-10 border-info">
                        <h5 class="mb-0 text-info"><i class="bi bi-chat-left-text me-2"></i>Your Notes</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $order->notes }}</p>
                    </div>
                </div>
                @endif

                <!-- Payment Section -->
                @if($order->status === 'waiting_payment' && $order->payment && in_array($order->payment->status, ['pending', 'rejected']))
                <div class="card card-chocolate mb-4 border-{{ $order->payment->status === 'rejected' ? 'danger' : 'warning' }}">
                    <div class="card-header bg-{{ $order->payment->status === 'rejected' ? 'danger' : 'warning' }} {{ $order->payment->status === 'rejected' ? 'text-white' : 'text-dark' }}">
                        <h5 class="mb-0">
                            <i class="bi bi-{{ $order->payment->status === 'rejected' ? 'x-circle' : 'exclamation-triangle' }} me-2"></i>
                            {{ $order->payment->status === 'rejected' ? 'Payment Rejected - Please Re-upload' : 'Payment Required' }}
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($order->payment->status === 'rejected')
                        <div class="alert alert-danger mb-3">
                            <strong><i class="bi bi-exclamation-circle me-1"></i>Your payment was rejected!</strong><br>
                            @if($order->payment->admin_notes)
                            <span class="mt-2 d-block"><strong>Reason:</strong> {{ $order->payment->admin_notes }}</span>
                            @else
                            <span class="mt-2 d-block">Please upload a valid payment proof.</span>
                            @endif
                        </div>
                        @endif
                        <div class="alert alert-info mb-3">
                            <strong>Bank Transfer Details:</strong><br>
                            Bank BCA: 1234567890<br>
                            Account Name: ChocoLuxe Store
                        </div>
                        <form action="{{ route('buyer.orders.payment', $order) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" name="bank_name" class="form-control form-control-chocolate" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Account Name</label>
                                    <input type="text" name="account_name" class="form-control form-control-chocolate" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Account Number</label>
                                    <input type="text" name="account_number" class="form-control form-control-chocolate" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Payment Proof</label>
                                    <input type="file" name="proof_image" class="form-control form-control-chocolate" accept="image/*" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Notes (Optional)</label>
                                    <textarea name="notes" class="form-control form-control-chocolate" rows="2"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-chocolate">
                                        <i class="bi bi-upload me-2"></i>Upload Payment Proof
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                <!-- Confirm Delivery -->
                @if($order->status === 'delivered')
                <div class="card card-chocolate mb-4 border-success">
                    <div class="card-body text-center">
                        <i class="bi bi-box-seam display-4 text-success"></i>
                        <h5 class="mt-3">Your order has been delivered!</h5>
                        <p class="text-muted">Please confirm if you have received your order</p>
                        <form action="{{ route('buyer.orders.confirm', $order) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle me-2"></i>Confirm Delivery
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4" data-aos="fade-left">
                <!-- Order Summary -->
                <div class="card card-chocolate sticky-top" style="top: 100px;">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-receipt me-2" style="color: var(--chocolate-gold);"></i>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        @if($order->discount > 0)
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Discount</span>
                            <span>- Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5" style="color: var(--chocolate-gold);">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>

                        <hr>

                        <div class="small text-muted">
                            <p class="mb-1"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                            @if($order->paid_at)
                            <p class="mb-1"><strong>Paid:</strong> {{ $order->paid_at->format('d M Y, H:i') }}</p>
                            @endif
                            @if($order->shipped_at)
                            <p class="mb-1"><strong>Shipped:</strong> {{ $order->shipped_at->format('d M Y, H:i') }}</p>
                            @endif
                            @if($order->delivered_at)
                            <p class="mb-1"><strong>Delivered:</strong> {{ $order->delivered_at->format('d M Y, H:i') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
