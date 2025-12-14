@extends('layouts.app')

@section('title', 'My Orders - ChocoLuxe')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-bag-check me-2" style="color: var(--chocolate-gold);"></i>My Orders
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        @if($orders->count() > 0)
        <div class="row">
            @foreach($orders as $order)
            <div class="col-12 mb-4" data-aos="fade-up">
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h5 class="mb-1">{{ $order->order_number }}</h5>
                            <small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small>
                        </div>
                        <span class="badge bg-{{ $order->status_badge }} fs-6">{{ $order->status_label }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center flex-wrap gap-2">
                                    @foreach($order->items->take(3) as $item)
                                    <div class="bg-light rounded p-2 text-center" style="width: 70px;">
                                        @if($item->product && $item->product->primaryImage)
                                            <img src="{{ asset('storage/' . $item->product->primaryImage->image) }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=100" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                    </div>
                                    @endforeach
                                    @if($order->items->count() > 3)
                                    <span class="text-muted">+{{ $order->items->count() - 3 }} more</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                <span class="text-muted">Total</span>
                                <h5 class="mb-0" style="color: var(--chocolate-gold);">Rp {{ number_format($order->total, 0, ',', '.') }}</h5>
                            </div>
                            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                <a href="{{ route('buyer.orders.show', $order) }}" class="btn btn-chocolate">
                                    <i class="bi bi-eye me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
        @else
        <div class="text-center py-5" data-aos="fade-up">
            <i class="bi bi-bag-x display-1 text-muted"></i>
            <h3 class="mt-4 text-muted">No orders yet</h3>
            <p class="text-muted mb-4">Start shopping to see your orders here</p>
            <a href="{{ route('products.index') }}" class="btn btn-chocolate btn-lg">
                <i class="bi bi-bag me-2"></i>Browse Products
            </a>
        </div>
        @endif
    </div>
</section>
@endsection
