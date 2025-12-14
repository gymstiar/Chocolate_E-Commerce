@extends('layouts.app')

@section('title', 'Shopping Cart - ChocoLuxe')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active text-white-50">Shopping Cart</li>
                    </ol>
                </nav>
                <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
                    <i class="bi bi-cart3 me-2" style="color: var(--chocolate-gold);"></i>Shopping Cart
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        @if($cartItems->count() > 0)
        <div class="row">
            <div class="col-lg-8" data-aos="fade-right">
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-bag me-2" style="color: var(--chocolate-gold);"></i>Cart Items ({{ $cartItems->count() }})</h5>
                        <form action="{{ route('buyer.cart.clear') }}" method="POST" onsubmit="return confirm('Clear all items from cart?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash me-1"></i>Clear Cart
                            </button>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        @foreach($cartItems as $item)
                        <div class="d-flex align-items-center p-3 border-bottom">
                            <div class="flex-shrink-0">
                                @if($item->product->primaryImage)
                                    <img src="{{ asset('storage/' . $item->product->primaryImage->image) }}" alt="{{ $item->product->name }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=100" alt="{{ $item->product->name }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">
                                    <a href="{{ route('products.show', $item->product->slug) }}" class="text-decoration-none" style="color: var(--chocolate-dark);">
                                        {{ $item->product->name }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $item->product->category->name ?? 'Chocolate' }}</small>
                                <div class="mt-1">
                                    @if($item->product->is_on_sale)
                                        <span class="fw-bold" style="color: var(--chocolate-gold);">Rp {{ number_format($item->product->sale_price, 0, ',', '.') }}</span>
                                        <span class="text-muted text-decoration-line-through small ms-1">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="fw-bold" style="color: var(--chocolate-gold);">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <form action="{{ route('buyer.cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group" style="width: 120px;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="updateQty(this, -1)">-</button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control form-control-sm text-center" onchange="this.form.submit()">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="updateQty(this, 1)">+</button>
                                    </div>
                                </form>
                                <div class="text-end" style="min-width: 120px;">
                                    <strong style="color: var(--chocolate-dark);">Rp {{ number_format($item->product->current_price * $item->quantity, 0, ',', '.') }}</strong>
                                </div>
                                <form action="{{ route('buyer.cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this item?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('products.index') }}" class="btn btn-outline-chocolate">
                    <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                </a>
            </div>

            <div class="col-lg-4" data-aos="fade-left">
                <div class="card card-chocolate sticky-top" style="top: 100px;">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-receipt me-2" style="color: var(--chocolate-gold);"></i>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                            <span class="fw-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="text-muted">Calculated at checkout</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5" style="color: var(--chocolate-gold);">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('buyer.checkout') }}" class="btn btn-chocolate btn-lg w-100">
                            <i class="bi bi-credit-card me-2"></i>Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-5" data-aos="fade-up">
            <i class="bi bi-cart-x display-1 text-muted"></i>
            <h3 class="mt-4 text-muted">Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added any chocolates yet</p>
            <a href="{{ route('products.index') }}" class="btn btn-chocolate btn-lg">
                <i class="bi bi-bag me-2"></i>Start Shopping
            </a>
        </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
function updateQty(btn, delta) {
    const input = btn.parentElement.querySelector('input');
    const newVal = parseInt(input.value) + delta;
    const min = parseInt(input.min);
    const max = parseInt(input.max);
    
    if (newVal >= min && newVal <= max) {
        input.value = newVal;
        input.form.submit();
    }
}
</script>
@endpush
@endsection
