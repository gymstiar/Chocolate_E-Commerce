@extends('layouts.seller')

@section('title', 'Order {{ $order->order_number }} - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('seller.orders.index') }}" class="text-white text-decoration-none">Orders</a></li>
                <li class="breadcrumb-item active text-white-50">{{ $order->order_number }}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">{{ $order->order_number }}</h2>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('seller.orders.invoice', $order) }}" class="btn btn-sm" style="background: var(--chocolate-gold); color: var(--chocolate-dark);" target="_blank">
                    <i class="bi bi-printer me-1"></i>Print Invoice
                </a>
                <span class="badge bg-{{ $order->status_badge }} fs-5">{{ $order->status_label }}</span>
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
                                    <img src="{{ asset('storage/' . $item->product->primaryImage->image) }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=100" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">{{ $item->product_name }}</h6>
                                <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                            </div>
                            <div class="text-end">
                                <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Verification -->
                @if($order->payment && $order->payment->status === 'uploaded')
                <div class="card card-chocolate mb-4 border-warning">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-credit-card me-2"></i>Payment Verification Required</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Bank:</strong> {{ $order->payment->bank_name }}</p>
                                <p><strong>Account Name:</strong> {{ $order->payment->account_name }}</p>
                                <p><strong>Account Number:</strong> {{ $order->payment->account_number }}</p>
                                <p><strong>Amount:</strong> Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</p>
                                @if($order->payment->notes)
                                <p><strong>Notes:</strong> {{ $order->payment->notes }}</p>
                                @endif
                            </div>
                            <div class="col-md-6 text-center">
                                @if($order->payment->proof_image)
                                <img src="{{ asset('storage/' . $order->payment->proof_image) }}" class="img-fluid rounded" style="max-height: 200px;">
                                <a href="{{ asset('storage/' . $order->payment->proof_image) }}" target="_blank" class="d-block mt-2">View Full Image</a>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('seller.orders.payment', $order) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label class="form-label">Admin Notes</label>
                                <textarea name="admin_notes" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="action" value="verify" class="btn btn-success me-2">
                                    <i class="bi bi-check-circle me-1"></i>Verify Payment
                                </button>
                                <button type="submit" name="action" value="reject" class="btn btn-danger">
                                    <i class="bi bi-x-circle me-1"></i>Reject Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                <!-- Shipping Update -->
                @if(in_array($order->status, ['paid', 'processing']))
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-truck me-2" style="color: var(--chocolate-gold);"></i>Update Shipping</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seller.orders.shipping', $order) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label class="form-label">Tracking Number</label>
                                <input type="text" name="tracking_number" class="form-control form-control-chocolate" value="{{ $order->tracking_number }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shipping Method</label>
                                <input type="text" name="shipping_method" class="form-control form-control-chocolate" value="{{ $order->shipping_method }}">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-chocolate">
                                    <i class="bi bi-send me-1"></i>Mark as Shipped
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                <!-- Status Update -->
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-arrow-repeat me-2" style="color: var(--chocolate-gold);"></i>Update Status</h5>
                    </div>
                    <div class="card-body">
                        @if(in_array($order->status, ['completed', 'cancelled']))
                        <!-- Status is Locked -->
                        <div class="alert {{ $order->status === 'completed' ? 'alert-success' : 'alert-danger' }} mb-0">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-lock-fill fs-4 me-3"></i>
                                <div>
                                    <strong>Status Locked</strong>
                                    <p class="mb-0 small">This order is <strong>{{ ucfirst($order->status) }}</strong> and cannot be changed anymore.</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Status Change Form -->
                        <form action="{{ route('seller.orders.status', $order) }}" method="POST" class="row g-3" id="statusUpdateForm">
                            @csrf
                            @method('PUT')
                            <div class="col-md-8">
                                <select name="status" class="form-select form-control-chocolate" id="statusSelect">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="waiting_payment" {{ $order->status == 'waiting_payment' ? 'selected' : '' }}>Waiting Payment</option>
                                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }} class="text-success fw-bold">✓ Completed (Final)</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }} class="text-danger fw-bold">✗ Cancelled (Final)</option>
                                </select>
                                <small class="text-muted mt-1 d-block">
                                    <i class="bi bi-exclamation-triangle text-warning me-1"></i>
                                    Warning: "Completed" and "Cancelled" are final statuses and cannot be changed.
                                </small>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-chocolate w-100" id="updateStatusBtn">Update Status</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-left">
                <!-- Customer Info -->
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-person me-2" style="color: var(--chocolate-gold);"></i>Customer</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>{{ $order->user->name ?? 'N/A' }}</strong></p>
                        <p class="mb-1 text-muted">{{ $order->user->email ?? 'N/A' }}</p>
                        <p class="mb-0 text-muted">{{ $order->user->phone ?? '-' }}</p>
                    </div>
                </div>

                <!-- Buyer Notes -->
                @if($order->notes)
                <div class="card card-chocolate mb-4 border-info">
                    <div class="card-header bg-info bg-opacity-10 border-info">
                        <h5 class="mb-0 text-info"><i class="bi bi-chat-left-text me-2"></i>Buyer Notes</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $order->notes }}</p>
                    </div>
                </div>
                @endif

                <!-- Shipping Address -->
                @if($order->address)
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-geo-alt me-2" style="color: var(--chocolate-gold);"></i>Shipping Address</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>{{ $order->address->recipient_name }}</strong></p>
                        <p class="mb-1">{{ $order->address->phone }}</p>
                        <p class="mb-0 text-muted small">{{ $order->address->full_address }}</p>
                    </div>
                </div>
                @endif

                <!-- Order Summary -->
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-receipt me-2" style="color: var(--chocolate-gold);"></i>Summary</h5>
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
                            <strong class="fs-5">Total</strong>
                            <strong class="fs-5" style="color: var(--chocolate-gold);">Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                        </div>
                        <hr>
                        <small class="text-muted">
                            <strong>Created:</strong> {{ $order->created_at->format('d M Y H:i') }}<br>
                            @if($order->paid_at)<strong>Paid:</strong> {{ $order->paid_at->format('d M Y H:i') }}<br>@endif
                            @if($order->shipped_at)<strong>Shipped:</strong> {{ $order->shipped_at->format('d M Y H:i') }}<br>@endif
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusForm = document.getElementById('statusUpdateForm');
    const statusSelect = document.getElementById('statusSelect');
    
    if (statusForm && statusSelect) {
        statusForm.addEventListener('submit', function(e) {
            const selectedStatus = statusSelect.value;
            
            if (selectedStatus === 'completed') {
                e.preventDefault();
                if (confirm('⚠️ WARNING: Setting status to COMPLETED is PERMANENT!\n\nThis action cannot be undone. The order status will be locked forever.\n\nAre you sure you want to mark this order as completed?')) {
                    this.submit();
                }
            } else if (selectedStatus === 'cancelled') {
                e.preventDefault();
                if (confirm('⚠️ WARNING: Setting status to CANCELLED is PERMANENT!\n\nThis action cannot be undone. The order status will be locked forever and stock will be restored.\n\nAre you sure you want to cancel this order?')) {
                    this.submit();
                }
            }
        });
    }
});
</script>
@endpush
@endsection

