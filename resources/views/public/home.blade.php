@extends('layouts.app')

@section('title', 'ChocoLuxe - Premium Artisan Chocolate')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden" style="min-height: 100vh; background: linear-gradient(135deg, #2C1810 0%, #4A3728 50%, #6B4423 100%);">
    <div class="hero-pattern position-absolute top-0 start-0 w-100 h-100" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><circle cx=\"50\" cy=\"50\" r=\"1\" fill=\"rgba(212,175,55,0.1)\"/></svg>'); background-size: 30px 30px;"></div>
    <div class="container h-100 position-relative">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6 text-white" data-aos="fade-right">
                <span class="badge badge-gold mb-3">Premium Quality Since 2024</span>
                <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    Indulge in 
                    <span style="color: var(--chocolate-gold);">Luxury</span> 
                    Chocolate
                </h1>
                <p class="lead mb-4" style="color: var(--chocolate-cream); font-size: 1.2rem;">
                    Experience the finest artisanal chocolates crafted with passion, using premium cocoa beans sourced from the world's most renowned plantations.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('products.index') }}" class="btn btn-gold btn-lg">
                        <i class="bi bi-bag me-2"></i>Shop Now
                    </a>
                    <a href="#about" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-info-circle me-2"></i>Learn More
                    </a>
                </div>
                <div class="mt-5 d-flex gap-4">
                    <div class="text-center">
                        <h3 class="fw-bold mb-0" style="color: var(--chocolate-gold);">50+</h3>
                        <small>Products</small>
                    </div>
                    <div class="text-center">
                        <h3 class="fw-bold mb-0" style="color: var(--chocolate-gold);">10K+</h3>
                        <small>Happy Customers</small>
                    </div>
                    <div class="text-center">
                        <h3 class="fw-bold mb-0" style="color: var(--chocolate-gold);">100%</h3>
                        <small>Premium Cocoa</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left">
                <div class="position-relative">
                    <div class="hero-image-wrapper" style="animation: float 6s ease-in-out infinite;">
                        <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=600" alt="Premium Chocolate" class="img-fluid rounded-4 shadow-lg" style="max-height: 500px; object-fit: cover;">
                    </div>
                    <div class="position-absolute" style="bottom: -30px; left: -30px; background: var(--chocolate-gold); padding: 1.5rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);" data-aos="zoom-in" data-aos-delay="300">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 60px; height: 60px; background: var(--chocolate-dark); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-award text-white fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-dark fw-bold">Best Quality</h5>
                                <small class="text-muted">Award Winning</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scroll Indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x pb-4" style="animation: bounce 2s infinite;">
        <a href="#about" class="text-white text-decoration-none">
            <i class="bi bi-chevron-double-down fs-3"></i>
        </a>
    </div>
</section>

<!-- About Chocolate Section -->
<section id="about" class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge badge-chocolate mb-3">Our Story</span>
            <h2 class="section-title">The Art of Chocolate</h2>
            <p class="section-subtitle mt-4">Discover the rich history and craftsmanship behind every piece of ChocoLuxe chocolate</p>
        </div>
        
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1606312619070-d48b4c652a52?w=600" alt="Chocolate History" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h3 class="mb-4" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                    <i class="bi bi-clock-history me-2" style="color: var(--chocolate-gold);"></i>
                    History of Chocolate
                </h3>
                <p class="mb-4" style="line-height: 1.8;">
                    Chocolate's journey began over 4,000 years ago in ancient Mesoamerica. The Mayans and Aztecs revered cacao as "food of the gods," using it in sacred ceremonies and as currency. Spanish conquistadors brought cacao to Europe in the 16th century, where it evolved into the sweet treat we love today.
                </p>
                <p style="line-height: 1.8;">
                    At ChocoLuxe, we honor this rich heritage by combining traditional techniques with modern innovation, creating chocolates that tell a story with every bite.
                </p>
            </div>
        </div>

        <div class="row align-items-center flex-lg-row-reverse mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1578269174936-2709b6aeb913?w=600" alt="Cocoa Origin" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6" data-aos="fade-right">
                <h3 class="mb-4" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                    <i class="bi bi-globe-americas me-2" style="color: var(--chocolate-gold);"></i>
                    Origin of Cocoa
                </h3>
                <p class="mb-4" style="line-height: 1.8;">
                    The finest cocoa beans grow in tropical regions within 20 degrees of the equator. Our cocoa is sourced from renowned plantations in Ghana, Ecuador, Madagascar, and Indonesia – each region imparting unique flavor profiles to our chocolates.
                </p>
                <p style="line-height: 1.8;">
                    We work directly with farmers, ensuring fair trade practices and sustainable cultivation methods that protect both the environment and local communities.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Types of Chocolate -->
<section class="section-padding" style="background: linear-gradient(135deg, var(--chocolate-cream) 0%, #F5E6D3 100%);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge badge-chocolate mb-3">Chocolate Varieties</span>
            <h2 class="section-title">Types of Chocolate</h2>
            <p class="section-subtitle mt-4">Explore our exquisite collection of chocolate varieties</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4" style="width: 80px; height: 80px; background: #2C1810; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-moon-fill text-white fs-3"></i>
                        </div>
                        <h4 class="card-title">Dark Chocolate</h4>
                        <p class="text-muted">70-85% cocoa content with rich, intense flavors. Low in sugar with antioxidant benefits.</p>
                        <span class="badge badge-chocolate">Premium</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4" style="width: 80px; height: 80px; background: #8B5A2B; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-cup-hot-fill text-white fs-3"></i>
                        </div>
                        <h4 class="card-title">Milk Chocolate</h4>
                        <p class="text-muted">Creamy and smooth with 30-45% cocoa. Blended with milk for a sweeter taste.</p>
                        <span class="badge badge-gold">Popular</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4" style="width: 80px; height: 80px; background: #FFF8F0; border: 3px solid var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-stars fs-3" style="color: var(--chocolate-gold);"></i>
                        </div>
                        <h4 class="card-title">White Chocolate</h4>
                        <p class="text-muted">Made with cocoa butter, milk, and sugar. Sweet, creamy, and melt-in-your-mouth.</p>
                        <span class="badge badge-chocolate">Classic</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4" style="width: 80px; height: 80px; background: linear-gradient(135deg, #E8A0BF, #FFB6C1); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-gem text-white fs-3"></i>
                        </div>
                        <h4 class="card-title">Ruby Chocolate</h4>
                        <p class="text-muted">Natural pink color with berry-like taste. The fourth type of chocolate, discovered in 2017.</p>
                        <span class="badge badge-gold">New</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge badge-chocolate mb-3">Our Collection</span>
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle mt-4">Handpicked selections from our premium chocolate collection</p>
        </div>

        <div class="row g-4">
            @forelse($featuredProducts as $product)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card card-chocolate h-100 position-relative overflow-hidden">
                    <div class="position-relative" style="overflow: hidden;">
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

                        <button class="wishlist-btn">
                            <i class="bi bi-heart"></i>
                        </button>

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
                                @if(Auth::user()->isBuyer())
                                <button class="btn btn-chocolate btn-sm rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-box-seam display-1 text-muted"></i>
                <h4 class="mt-3 text-muted">No featured products yet</h4>
                <p class="text-muted">Check back soon for our premium chocolate collection</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('products.index') }}" class="btn btn-chocolate btn-lg">
                <i class="bi bi-grid me-2"></i>View All Products
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section-padding" style="background: var(--chocolate-dark);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge badge-gold mb-3">Why ChocoLuxe</span>
            <h2 class="section-title text-white">Why Choose Our Chocolate</h2>
            <p class="section-subtitle mt-4 text-white opacity-75">Experience the difference of truly premium artisan chocolate</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center p-4">
                    <div class="mb-4" style="width: 100px; height: 100px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-award-fill fs-1 text-dark"></i>
                    </div>
                    <h4 class="text-white mb-3">Premium Quality</h4>
                    <p class="text-white opacity-75">Only the finest cocoa beans selected from ethical sources worldwide</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center p-4">
                    <div class="mb-4" style="width: 100px; height: 100px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-hand-thumbs-up-fill fs-1 text-dark"></i>
                    </div>
                    <h4 class="text-white mb-3">Handcrafted</h4>
                    <p class="text-white opacity-75">Each piece is carefully crafted by expert chocolatiers with passion</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center p-4">
                    <div class="mb-4" style="width: 100px; height: 100px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-gift-fill fs-1 text-dark"></i>
                    </div>
                    <h4 class="text-white mb-3">Perfect Gift</h4>
                    <p class="text-white opacity-75">Elegant packaging that makes every box a memorable gift</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center p-4">
                    <div class="mb-4" style="width: 100px; height: 100px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-truck fs-1 text-dark"></i>
                    </div>
                    <h4 class="text-white mb-3">Fast Delivery</h4>
                    <p class="text-white opacity-75">Temperature-controlled shipping to preserve perfect taste</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                <div class="text-center p-4">
                    <div class="mb-4" style="width: 100px; height: 100px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-recycle fs-1 text-dark"></i>
                    </div>
                    <h4 class="text-white mb-3">Eco-Friendly</h4>
                    <p class="text-white opacity-75">Sustainable practices and recyclable packaging</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                <div class="text-center p-4">
                    <div class="mb-4" style="width: 100px; height: 100px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-heart-fill fs-1 text-dark"></i>
                    </div>
                    <h4 class="text-white mb-3">Made with Love</h4>
                    <p class="text-white opacity-75">Every chocolate tells a story of dedication and care</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge badge-chocolate mb-3">Testimonials</span>
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle mt-4">Real reviews from chocolate lovers around the world</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-chocolate h-100">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="mb-4" style="font-style: italic;">"The best chocolate I've ever tasted! The dark chocolate truffle melts in your mouth. Will definitely order again!"</p>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Customer" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">Jakarta</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-chocolate h-100">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="mb-4" style="font-style: italic;">"Sent this as a gift to my mom, she absolutely loved it! The packaging was elegant and the chocolate arrived in perfect condition."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="Customer" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-muted">Bandung</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-chocolate h-100">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                        </div>
                        <p class="mb-4" style="font-style: italic;">"The ruby chocolate was a unique experience! Never tasted anything like it. Fast delivery and amazing customer service."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/3.jpg" alt="Customer" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0">Anita Wijaya</h6>
                                <small class="text-muted">Surabaya</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--chocolate-medium) 0%, var(--chocolate-dark) 100%);">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="display-5 fw-bold text-white mb-4" style="font-family: 'Playfair Display', serif;">
                    Ready to Experience Premium Chocolate?
                </h2>
                <p class="lead text-white opacity-75 mb-4">
                    Join thousands of chocolate lovers and discover the taste of luxury. Sign up now and get 10% off your first order!
                </p>
            </div>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                @guest
                <a href="{{ route('register') }}" class="btn btn-gold btn-lg">
                    <i class="bi bi-person-plus me-2"></i>Join Now
                </a>
                @else
                <a href="{{ route('products.index') }}" class="btn btn-gold btn-lg">
                    <i class="bi bi-bag me-2"></i>Start Shopping
                </a>
                @endguest
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>
@endsection
