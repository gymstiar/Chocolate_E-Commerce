@extends('layouts.app')

@section('title', 'Products - ChocoLuxe')

@section('content')
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">Products</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold text-white mb-0" style="font-family: 'Playfair Display', serif;">
                    <i class="bi bi-grid me-2" style="color: var(--chocolate-gold);"></i>Our Products
                </h1>
            </div>
            <div class="col-lg-6 text-lg-end" data-aos="fade-left">
                <p class="text-white-50 mb-0">Showing {{ $products->count() }} of {{ $products->total() }} products</p>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3 mb-4" data-aos="fade-right">
                <div class="card card-chocolate sticky-top" style="top: 100px;">
                    <div class="card-body">
                        <h5 class="mb-4"><i class="bi bi-funnel me-2" style="color: var(--chocolate-gold);"></i>Filters</h5>
                        
                        <form action="{{ route('products.index') }}" method="GET">
                            <!-- Search -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Search</label>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control form-control-chocolate" placeholder="Search products..." value="{{ request('search') }}">
                                    <button class="btn btn-chocolate" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Categories -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Category</label>
                                <select name="category" class="form-select form-control-chocolate">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Chocolate Type -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Chocolate Type</label>
                                <select name="type" class="form-select form-control-chocolate">
                                    <option value="">All Types</option>
                                    <option value="dark" {{ request('type') == 'dark' ? 'selected' : '' }}>Dark Chocolate</option>
                                    <option value="milk" {{ request('type') == 'milk' ? 'selected' : '' }}>Milk Chocolate</option>
                                    <option value="white" {{ request('type') == 'white' ? 'selected' : '' }}>White Chocolate</option>
                                    <option value="ruby" {{ request('type') == 'ruby' ? 'selected' : '' }}>Ruby Chocolate</option>
                                    <option value="mixed" {{ request('type') == 'mixed' ? 'selected' : '' }}>Mixed</option>
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Price Range</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" name="min_price" class="form-control form-control-chocolate" placeholder="Min" value="{{ request('min_price') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="max_price" class="form-control form-control-chocolate" placeholder="Max" value="{{ request('max_price') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Sort -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Sort By</label>
                                <select name="sort" class="form-select form-control-chocolate">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-chocolate w-100 mb-2">
                                <i class="bi bi-funnel me-2"></i>Apply Filters
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-chocolate w-100">
                                <i class="bi bi-x-circle me-2"></i>Clear Filters
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @forelse($products as $product)
                    <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="card card-chocolate h-100 position-relative">
                            <div class="position-relative overflow-hidden">
                                @if($product->primaryImage)
                                    <img src="{{ asset('storage/' . $product->primaryImage->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=400" class="card-img-top" alt="{{ $product->name }}">
                                @endif

                                @if($product->is_on_sale)
                                <span class="position-absolute top-0 start-0 m-3 badge bg-danger">
                                    -{{ $product->discount_percentage }}%
                                </span>
                                @endif

                                @if(!$product->in_stock)
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.5);">
                                    <span class="badge bg-dark fs-6">Out of Stock</span>
                                </div>
                                @endif

                                @auth
                                <button class="wishlist-btn" onclick="toggleWishlist({{ $product->id }})">
                                    <i class="bi bi-heart{{ $product->wishlists->where('user_id', auth()->id())->count() ? '-fill text-danger' : '' }}"></i>
                                </button>
                                @endauth

                                <div class="product-overlay">
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-gold btn-sm w-100">
                                        <i class="bi bi-eye me-1"></i> View Details
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge badge-chocolate small">{{ $product->category->name ?? 'Chocolate' }}</span>
                                    <small class="text-muted"><i class="bi bi-eye"></i> {{ $product->views }}</small>
                                </div>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="text-muted small mb-3">{{ Str::limit($product->short_description, 60) }}</p>
                                
                                @if($product->cocoa_percentage)
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="bi bi-percent"></i> {{ $product->cocoa_percentage }}% Cocoa
                                    </small>
                                </div>
                                @endif

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($product->is_on_sale)
                                            <span class="price">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                            <span class="price-old ms-2">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        @else
                                            <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    @auth
                                        @if(Auth::user()->isBuyer() && $product->in_stock)
                                        <form action="{{ route('buyer.cart.add') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-chocolate btn-sm rounded-circle" style="width: 40px; height: 40px;">
                                                <i class="bi bi-cart-plus"></i>
                                            </button>
                                        </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-search display-1 text-muted"></i>
                        <h4 class="mt-3 text-muted">No products found</h4>
                        <p class="text-muted">Try adjusting your filters or search terms</p>
                        <a href="{{ route('products.index') }}" class="btn btn-chocolate">
                            <i class="bi bi-arrow-left me-2"></i>Clear Filters
                        </a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                    {{ $products->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function toggleWishlist(productId) {
    fetch('{{ route("buyer.wishlist.toggle") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endpush
@endsection
