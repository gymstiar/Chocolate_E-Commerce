@extends('layouts.app')

@section('title', $product->name . ' - ChocoLuxe')

@section('content')
<!-- Breadcrumb -->
<section class="py-3" style="background: var(--chocolate-cream);">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none" style="color: var(--chocolate-medium);">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none" style="color: var(--chocolate-medium);">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Product Detail -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row">
            <!-- Product Images & Video -->
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="position-relative">
                    @if($product->is_on_sale)
                    <span class="position-absolute top-0 start-0 m-3 badge bg-danger fs-6 z-3">
                        -{{ $product->discount_percentage }}% OFF
                    </span>
                    @endif

                    @php
                        $mediaItems = [];
                        // Add images first
                        foreach($product->images as $image) {
                            $mediaItems[] = ['type' => 'image', 'src' => asset('storage/' . $image->image)];
                        }
                        // Add video if exists
                        if($product->video) {
                            $mediaItems[] = ['type' => 'video', 'src' => asset('storage/' . $product->video)];
                        }
                        // Fallback if no media
                        if(empty($mediaItems)) {
                            $mediaItems[] = ['type' => 'image', 'src' => 'https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=600'];
                        }
                    @endphp

                    <!-- Main Display Area -->
                    <div class="mb-3 position-relative">
                        <!-- Image Display -->
                        <img id="mainImage" src="{{ $mediaItems[0]['src'] ?? '' }}" alt="{{ $product->name }}" 
                             class="img-fluid rounded-4 shadow w-100" style="max-height: 500px; object-fit: cover; {{ $mediaItems[0]['type'] === 'video' ? 'display:none;' : '' }}">
                        
                        <!-- Video Display -->
                        <video id="mainVideo" controls class="img-fluid rounded-4 shadow w-100" style="max-height: 500px; object-fit: cover; {{ $mediaItems[0]['type'] !== 'video' ? 'display:none;' : '' }}">
                            <source id="videoSource" src="{{ $mediaItems[0]['type'] === 'video' ? $mediaItems[0]['src'] : '' }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        @if(count($mediaItems) > 1)
                        <!-- Navigation Buttons -->
                        <button type="button" class="btn btn-chocolate btn-sm position-absolute start-0 top-50 translate-middle-y ms-2" onclick="prevMedia()" style="z-index: 10; opacity: 0.9;">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button type="button" class="btn btn-chocolate btn-sm position-absolute end-0 top-50 translate-middle-y me-2" onclick="nextMedia()" style="z-index: 10; opacity: 0.9;">
                            <i class="bi bi-chevron-right"></i>
                        </button>

                        <!-- Counter Badge -->
                        <span id="mediaCounter" class="position-absolute bottom-0 end-0 m-3 badge" style="background: rgba(0,0,0,0.7); font-size: 0.9rem;">
                            1 / {{ count($mediaItems) }}
                        </span>
                        @endif
                    </div>

                    <!-- Thumbnails -->
                    @if(count($mediaItems) > 1)
                    <div class="d-flex gap-2 overflow-auto pb-2">
                        @foreach($mediaItems as $index => $media)
                        <div class="thumbnail-wrapper position-relative" style="flex-shrink: 0;">
                            @if($media['type'] === 'video')
                            <div class="rounded-3 thumbnail-img d-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px; cursor: pointer; background: var(--chocolate-dark); {{ $index === 0 ? 'opacity: 1; border: 2px solid var(--chocolate-gold);' : 'opacity: 0.6;' }}"
                                 onclick="goToMedia({{ $index }})" data-index="{{ $index }}">
                                <i class="bi bi-play-circle-fill text-white fs-3"></i>
                            </div>
                            @else
                            <img src="{{ $media['src'] }}" alt="{{ $product->name }}" 
                                 class="rounded-3 thumbnail-img" 
                                 style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; {{ $index === 0 ? 'opacity: 1; border: 2px solid var(--chocolate-gold);' : 'opacity: 0.6;' }} transition: all 0.3s;" 
                                 onclick="goToMedia({{ $index }})" data-index="{{ $index }}">
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6" data-aos="fade-left">
                <span class="badge badge-chocolate mb-3">{{ $product->category->name ?? 'Chocolate' }}</span>
                
                <h1 class="mb-3" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                    {{ $product->name }}
                </h1>

                <!-- Price -->
                <div class="mb-4">
                    @if($product->is_on_sale)
                        <span class="fs-2 fw-bold" style="color: var(--chocolate-gold);">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                        <span class="fs-4 text-muted text-decoration-line-through ms-2">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @else
                        <span class="fs-2 fw-bold" style="color: var(--chocolate-gold);">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="mb-4">
                    <div class="row g-3">
                        @if($product->chocolate_type)
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-cup-hot fs-4 me-2" style="color: var(--chocolate-gold);"></i>
                                <div>
                                    <small class="text-muted d-block">Type</small>
                                    <span class="fw-semibold text-capitalize">{{ str_replace('_', ' ', $product->chocolate_type) }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($product->cocoa_percentage)
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-percent fs-4 me-2" style="color: var(--chocolate-gold);"></i>
                                <div>
                                    <small class="text-muted d-block">Cocoa</small>
                                    <span class="fw-semibold">{{ $product->cocoa_percentage }}%</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($product->weight)
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-box fs-4 me-2" style="color: var(--chocolate-gold);"></i>
                                <div>
                                    <small class="text-muted d-block">Weight</small>
                                    <span class="fw-semibold">{{ $product->weight }}g</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($product->origin)
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-globe fs-4 me-2" style="color: var(--chocolate-gold);"></i>
                                <div>
                                    <small class="text-muted d-block">Origin</small>
                                    <span class="fw-semibold">{{ $product->origin }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Stock Status -->
                <div class="mb-4">
                    @if($product->in_stock)
                        <span class="badge bg-success fs-6"><i class="bi bi-check-circle me-1"></i>In Stock ({{ $product->stock }} available)</span>
                    @else
                        <span class="badge bg-danger fs-6"><i class="bi bi-x-circle me-1"></i>Out of Stock</span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h5 class="mb-3">Description</h5>
                    <p class="text-muted" style="line-height: 1.8;">{{ $product->description ?? $product->short_description }}</p>
                </div>

                <!-- Add to Cart Form -->
                @auth
                    @if(Auth::user()->isBuyer())
                        @if($product->in_stock)
                        <form action="{{ route('buyer.cart.add') }}" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="row g-3 align-items-end">
                                <div class="col-auto">
                                    <label class="form-label">Quantity</label>
                                    <div class="input-group" style="width: 140px;">
                                        <button type="button" class="btn btn-outline-secondary" onclick="decrementQty()">-</button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control text-center">
                                        <button type="button" class="btn btn-outline-secondary" onclick="incrementQty({{ $product->stock }})">+</button>
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-chocolate btn-lg w-100">
                                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif

                        <!-- Wishlist Button -->
                        <form action="{{ route('buyer.wishlist.toggle') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-outline-chocolate">
                                <i class="bi bi-heart me-2"></i>Add to Wishlist
                            </button>
                        </form>
                    @endif
                @else
                    <div class="alert alert-chocolate">
                        <i class="bi bi-info-circle me-2"></i>
                        <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login</a> to add this item to your cart
                    </div>
                @endauth

                <!-- Share -->
                <div class="mt-4 pt-4 border-top">
                    <span class="me-3 text-muted">Share:</span>
                    <a href="#" class="btn btn-sm rounded-circle" style="background: #3b5998; color: white;"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-sm rounded-circle" style="background: #1da1f2; color: white;"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="btn btn-sm rounded-circle" style="background: #25d366; color: white;"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="btn btn-sm rounded-circle" style="background: #0077b5; color: white;"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="section-padding" style="background: var(--chocolate-cream);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Related Products</h2>
            <p class="section-subtitle mt-4">You might also like these chocolates</p>
        </div>

        <div class="row g-4">
            @foreach($relatedProducts as $related)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card card-chocolate h-100">
                    <div class="position-relative overflow-hidden">
                        @if($related->primaryImage)
                            <img src="{{ asset('storage/' . $related->primaryImage->image) }}" class="card-img-top" alt="{{ $related->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=400" class="card-img-top" alt="{{ $related->name }}">
                        @endif

                        @if($related->is_on_sale)
                        <span class="position-absolute top-0 start-0 m-3 badge bg-danger">
                            -{{ $related->discount_percentage }}%
                        </span>
                        @endif

                        <div class="product-overlay">
                            <a href="{{ route('products.show', $related->slug) }}" class="btn btn-gold btn-sm w-100">
                                <i class="bi bi-eye me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $related->name }}</h5>
                        <div>
                            @if($related->is_on_sale)
                                <span class="price">Rp {{ number_format($related->sale_price, 0, ',', '.') }}</span>
                                <span class="price-old ms-2">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                            @else
                                <span class="price">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
.thumbnail-img:hover, .thumbnail-img.active {
    opacity: 1 !important;
    border: 2px solid var(--chocolate-gold);
}
</style>

@push('scripts')
<script>
// Media gallery data
const mediaItems = @json($mediaItems);
let currentIndex = 0;

function updateDisplay() {
    const mainImage = document.getElementById('mainImage');
    const mainVideo = document.getElementById('mainVideo');
    const videoSource = document.getElementById('videoSource');
    const counter = document.getElementById('mediaCounter');
    
    const currentMedia = mediaItems[currentIndex];
    
    if (currentMedia.type === 'video') {
        mainImage.style.display = 'none';
        mainVideo.style.display = 'block';
        videoSource.src = currentMedia.src;
        mainVideo.load();
    } else {
        mainVideo.style.display = 'none';
        mainVideo.pause();
        mainImage.style.display = 'block';
        mainImage.src = currentMedia.src;
    }
    
    // Update counter
    if (counter) {
        counter.textContent = (currentIndex + 1) + ' / ' + mediaItems.length;
    }
    
    // Update thumbnail states
    document.querySelectorAll('.thumbnail-img').forEach((thumb, idx) => {
        if (idx === currentIndex) {
            thumb.style.opacity = '1';
            thumb.style.border = '2px solid var(--chocolate-gold)';
        } else {
            thumb.style.opacity = '0.6';
            thumb.style.border = 'none';
        }
    });
}

function nextMedia() {
    currentIndex = (currentIndex + 1) % mediaItems.length;
    updateDisplay();
}

function prevMedia() {
    currentIndex = (currentIndex - 1 + mediaItems.length) % mediaItems.length;
    updateDisplay();
}

function goToMedia(index) {
    currentIndex = index;
    updateDisplay();
}

function incrementQty(max) {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) < max) {
        input.value = parseInt(input.value) + 1;
    }
}

function decrementQty() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

// Initialize first thumbnail as active
document.addEventListener('DOMContentLoaded', function() {
    const firstThumb = document.querySelector('.thumbnail-img');
    if (firstThumb) {
        firstThumb.style.opacity = '1';
        firstThumb.style.border = '2px solid var(--chocolate-gold)';
    }
});
</script>
@endpush
@endsection

