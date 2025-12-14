@extends('layouts.app')

@section('title', 'My Wishlist - ChocoLuxe')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active text-white-50">Wishlist</li>
                    </ol>
                </nav>
                <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
                    <i class="bi bi-heart me-2" style="color: var(--chocolate-gold);"></i>My Wishlist
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        @if($wishlists->count() > 0)
        <div class="row g-4">
            @foreach($wishlists as $wishlist)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="card card-chocolate h-100 position-relative">
                    <div class="position-relative overflow-hidden">
                        @if($wishlist->product->primaryImage)
                            <img src="{{ asset('storage/' . $wishlist->product->primaryImage->image) }}" class="card-img-top" alt="{{ $wishlist->product->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=400" class="card-img-top" alt="{{ $wishlist->product->name }}">
                        @endif

                        @if($wishlist->product->is_on_sale)
                        <span class="position-absolute top-0 start-0 m-3 badge bg-danger">
                            -{{ $wishlist->product->discount_percentage }}%
                        </span>
                        @endif

                        <form action="{{ route('buyer.wishlist.remove', $wishlist->id) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm rounded-circle" style="width: 35px; height: 35px;">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </form>

                        <div class="product-overlay">
                            <a href="{{ route('products.show', $wishlist->product->slug) }}" class="btn btn-gold btn-sm w-100">
                                <i class="bi bi-eye me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <span class="badge badge-chocolate small mb-2">{{ $wishlist->product->category->name ?? 'Chocolate' }}</span>
                        <h5 class="card-title">{{ $wishlist->product->name }}</h5>
                        <div class="mb-3">
                            @if($wishlist->product->is_on_sale)
                                <span class="price">Rp {{ number_format($wishlist->product->sale_price, 0, ',', '.') }}</span>
                                <span class="price-old ms-2">Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}</span>
                            @else
                                <span class="price">Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        @if($wishlist->product->in_stock)
                        <form action="{{ route('buyer.cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-chocolate btn-sm w-100">
                                <i class="bi bi-cart-plus me-1"></i>Add to Cart
                            </button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-sm w-100" disabled>
                            <i class="bi bi-x-circle me-1"></i>Out of Stock
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $wishlists->links() }}
        </div>
        @else
        <div class="text-center py-5" data-aos="fade-up">
            <i class="bi bi-heart display-1 text-muted"></i>
            <h3 class="mt-4 text-muted">Your wishlist is empty</h3>
            <p class="text-muted mb-4">Save your favorite chocolates here</p>
            <a href="{{ route('products.index') }}" class="btn btn-chocolate btn-lg">
                <i class="bi bi-bag me-2"></i>Browse Products
            </a>
        </div>
        @endif
    </div>
</section>
@endsection
