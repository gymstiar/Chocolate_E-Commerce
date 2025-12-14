@extends('layouts.app')

@section('title', 'Checkout - ChocoLuxe')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-credit-card me-2" style="color: var(--chocolate-gold);"></i>Checkout
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <form action="{{ route('buyer.checkout.process') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-7" data-aos="fade-right">
                    <!-- Shipping Address -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-geo-alt me-2" style="color: var(--chocolate-gold);"></i>Shipping Address</h5>
                        </div>
                        <div class="card-body">
                            @if($addresses->count() > 0)
                                @foreach($addresses as $address)
                                <div class="form-check border rounded p-3 mb-2 {{ $address->is_default ? 'border-warning' : '' }}">
                                    <input class="form-check-input" type="radio" name="address_id" id="address{{ $address->id }}" value="{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }} required>
                                    <label class="form-check-label w-100" for="address{{ $address->id }}">
                                        <div class="d-flex justify-content-between">
                                            <strong>{{ $address->label }}</strong>
                                            @if($address->is_default)
                                            <span class="badge badge-gold">Default</span>
                                            @endif
                                        </div>
                                        <div class="text-muted small mt-1">
                                            {{ $address->recipient_name }} | {{ $address->phone }}<br>
                                            {{ $address->full_address }}
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            @else
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                You haven't added any shipping address yet.
                                <a href="{{ route('buyer.addresses') }}" class="alert-link">Add Address</a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-truck me-2" style="color: var(--chocolate-gold);"></i>Shipping Method</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check border rounded p-3 mb-2">
                                <input class="form-check-input" type="radio" name="shipping_method" id="regular" value="regular" checked required>
                                <label class="form-check-label w-100" for="regular">
                                    <div class="d-flex justify-content-between">
                                        <strong>Regular Shipping</strong>
                                        <span class="fw-semibold">Rp 15.000</span>
                                    </div>
                                    <small class="text-muted">Estimated: 3-5 business days</small>
                                </label>
                            </div>
                            <div class="form-check border rounded p-3">
                                <input class="form-check-input" type="radio" name="shipping_method" id="express" value="express">
                                <label class="form-check-label w-100" for="express">
                                    <div class="d-flex justify-content-between">
                                        <strong>Express Shipping</strong>
                                        <span class="fw-semibold">Rp 25.000</span>
                                    </div>
                                    <small class="text-muted">Estimated: 1-2 business days</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-wallet2 me-2" style="color: var(--chocolate-gold);"></i>Payment Method</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check border rounded p-3 mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" checked required>
                                <label class="form-check-label w-100" for="bank_transfer">
                                    <strong><i class="bi bi-bank me-2"></i>Bank Transfer</strong>
                                    <small class="text-muted d-block">Manual payment verification</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-chat-left-text me-2" style="color: var(--chocolate-gold);"></i>Order Notes (Optional)</h5>
                        </div>
                        <div class="card-body">
                            <textarea name="notes" class="form-control form-control-chocolate" rows="3" placeholder="Add any special instructions for your order...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left">
                    <div class="card card-chocolate sticky-top" style="top: 100px;">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-receipt me-2" style="color: var(--chocolate-gold);"></i>Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <!-- Cart Items -->
                            @foreach($cartItems as $item)
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 position-relative">
                                    @if($item->product->primaryImage)
                                        <img src="{{ asset('storage/' . $item->product->primaryImage->image) }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=100" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    @endif
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">{{ $item->quantity }}</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0 small">{{ $item->product->name }}</h6>
                                </div>
                                <div class="text-end">
                                    <strong>Rp {{ number_format($item->product->current_price * $item->quantity, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                            @endforeach

                            <hr>

                            <!-- Promo Code -->
                            <div class="mb-3">
                                <label class="form-label small fw-bold"><i class="bi bi-tag me-1"></i>Promo Code</label>
                                <div class="input-group mb-2">
                                    <input type="text" id="promo_code" class="form-control form-control-chocolate" placeholder="Enter code" value="{{ session('promo_code') }}">
                                    <button type="button" class="btn btn-outline-chocolate" onclick="applyPromo()">Apply</button>
                                </div>
                                @if(session('promo_code'))
                                <div class="alert alert-success py-2 small d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="bi bi-check-circle me-1"></i>Promo <strong>{{ session('promo_code') }}</strong> applied!
                                    </span>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removePromo()">
                                        <i class="bi bi-x-circle me-1"></i>Remove
                                    </button>
                                </div>
                                @endif
                                
                                @if(isset($promos) && $promos->count() > 0)
                                <div class="mt-3">
                                    <p class="small text-muted mb-2"><i class="bi bi-gift me-1"></i>Available Promos:</p>
                                    <div class="promo-list" style="max-height: 200px; overflow-y: auto;">
                                        @foreach($promos as $promo)
                                        <div class="promo-item border rounded p-2 mb-2 {{ session('promo_code') === $promo->code ? 'border-success bg-success bg-opacity-10' : '' }}" style="cursor: pointer;" onclick="selectPromo('{{ $promo->code }}')">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="badge" style="background: var(--chocolate-gold); color: var(--chocolate-dark);">{{ $promo->code }}</span>
                                                    <span class="small ms-1 fw-semibold">{{ $promo->name }}</span>
                                                </div>
                                                <span class="badge bg-success">
                                                    {{ $promo->type === 'percentage' ? $promo->value . '%' : 'Rp ' . number_format($promo->value, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            @if($promo->description)
                                            <small class="text-muted d-block mt-1">{{ Str::limit($promo->description, 50) }}</small>
                                            @endif
                                            @if($promo->min_purchase)
                                            <small class="text-muted d-block">Min. purchase: Rp {{ number_format($promo->min_purchase, 0, ',', '.') }}</small>
                                            @endif
                                            @if($promo->end_date)
                                            <small class="text-danger d-block"><i class="bi bi-clock"></i> Expires: {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}</small>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>

                            <hr>

                            <!-- Totals -->
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <span id="shipping_cost">Rp 15.000</span>
                            </div>
                            @if($discount > 0 && $appliedPromo)
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>
                                    <i class="bi bi-tag-fill me-1"></i>Discount 
                                    <small class="text-muted">({{ $appliedPromo->code }})</small>
                                </span>
                                <span class="fw-bold">- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Total</span>
                                <span class="fw-bold fs-5" style="color: var(--chocolate-gold);" id="total_price" data-subtotal="{{ $subtotal }}" data-discount="{{ $discount }}">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <button type="submit" class="btn btn-chocolate btn-lg w-100" {{ $addresses->count() == 0 ? 'disabled' : '' }}>
                                <i class="bi bi-check-circle me-2"></i>Place Order
                            </button>

                            <p class="text-center text-muted small mt-3">
                                <i class="bi bi-shield-check"></i> Secure checkout
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@push('scripts')
<script>
document.querySelectorAll('input[name="shipping_method"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        const shippingCost = this.value === 'express' ? 25000 : 15000;
        document.getElementById('shipping_cost').textContent = 'Rp ' + shippingCost.toLocaleString('id-ID');
        const subtotal = {{ $subtotal }};
        const discount = {{ $discount ?? 0 }};
        const total = subtotal - discount + shippingCost;
        document.getElementById('total_price').textContent = 'Rp ' + total.toLocaleString('id-ID');
    });
});

function applyPromo() {
    const code = document.getElementById('promo_code').value;
    if (code) {
        fetch('{{ route("buyer.checkout.promo") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ promo_code: code })
        })
        .then(response => response.json())
        .then(data => {
            location.reload();
        })
        .catch(() => location.reload());
    }
}

function selectPromo(code) {
    document.getElementById('promo_code').value = code;
    applyPromo();
}

function removePromo() {
    fetch('{{ route("buyer.checkout.remove-promo") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(() => location.reload())
    .catch(() => location.reload());
}
</script>
@endpush
@endsection
