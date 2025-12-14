@extends('layouts.app')

@section('title', 'About Us - ChocoLuxe')

@section('content')
<!-- Hero Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%); min-height: 40vh; display: flex; align-items: center;">
    <div class="container text-center text-white">
        <span class="badge badge-gold mb-3" data-aos="fade-up">Our Story</span>
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100" style="font-family: 'Playfair Display', serif;">
            About ChocoLuxe
        </h1>
        <p class="lead opacity-75" data-aos="fade-up" data-aos-delay="200">Crafting happiness, one chocolate at a time since 2024</p>
    </div>
</section>

<!-- Our Story -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1481391319762-47dff72954d9?w=600" alt="Chocolate Making" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="badge badge-chocolate mb-3">Our Journey</span>
                <h2 class="mb-4" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                    A Passion for Perfect Chocolate
                </h2>
                <p class="mb-4" style="line-height: 1.8;">
                    ChocoLuxe was born from a simple belief: everyone deserves to experience the joy of truly exceptional chocolate. What started as a small kitchen experiment has grown into a beloved artisanal chocolate brand, cherished by connoisseurs across Indonesia.
                </p>
                <p class="mb-4" style="line-height: 1.8;">
                    Our founder, inspired by the rich chocolate traditions of Belgium and Switzerland, combined these techniques with the finest Indonesian cocoa to create something uniquely special. Every piece we create is a testament to our dedication to quality and craftsmanship.
                </p>
                <div class="row g-4">
                    <div class="col-6">
                        <div class="text-center p-3 rounded-4" style="background: var(--chocolate-cream);">
                            <h3 class="fw-bold mb-0" style="color: var(--chocolate-gold);">2024</h3>
                            <small class="text-muted">Founded</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 rounded-4" style="background: var(--chocolate-cream);">
                            <h3 class="fw-bold mb-0" style="color: var(--chocolate-gold);">50+</h3>
                            <small class="text-muted">Products</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="section-padding" style="background: var(--chocolate-cream);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge badge-chocolate mb-3">What We Stand For</span>
            <h2 class="section-title">Our Values</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4" style="width: 80px; height: 80px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-gem text-dark fs-3"></i>
                        </div>
                        <h4>Quality First</h4>
                        <p class="text-muted">We never compromise on ingredients. Only the finest cocoa beans, pure cocoa butter, and natural flavors make it into our chocolates.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4" style="width: 80px; height: 80px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-globe-asia-australia text-dark fs-3"></i>
                        </div>
                        <h4>Sustainability</h4>
                        <p class="text-muted">We support sustainable farming practices and work directly with cocoa farmers to ensure fair wages and environmental responsibility.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-chocolate h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4" style="width: 80px; height: 80px; background: var(--chocolate-gold); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-heart text-dark fs-3"></i>
                        </div>
                        <h4>Made with Love</h4>
                        <p class="text-muted">Each piece is handcrafted by our skilled chocolatiers who pour their passion into every creation.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Process -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge badge-chocolate mb-3">From Bean to Bar</span>
            <h2 class="section-title">Our Process</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="position-relative d-inline-block mb-4">
                        <div style="width: 100px; height: 100px; background: var(--chocolate-dark); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <span class="text-white fs-2 fw-bold">1</span>
                        </div>
                    </div>
                    <h5>Sourcing</h5>
                    <p class="text-muted small">Premium cocoa beans sourced from ethical farms around the world</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="position-relative d-inline-block mb-4">
                        <div style="width: 100px; height: 100px; background: var(--chocolate-medium); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <span class="text-white fs-2 fw-bold">2</span>
                        </div>
                    </div>
                    <h5>Roasting</h5>
                    <p class="text-muted small">Carefully roasted to bring out unique flavor profiles</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="position-relative d-inline-block mb-4">
                        <div style="width: 100px; height: 100px; background: var(--chocolate-light); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <span class="text-white fs-2 fw-bold">3</span>
                        </div>
                    </div>
                    <h5>Crafting</h5>
                    <p class="text-muted small">Hand-molded and decorated by our expert chocolatiers</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center">
                    <div class="position-relative d-inline-block mb-4">
                        <div style="width: 100px; height: 100px; background: var(--chocolate-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <span class="text-dark fs-2 fw-bold">4</span>
                        </div>
                    </div>
                    <h5>Delivery</h5>
                    <p class="text-muted small">Temperature-controlled shipping to preserve perfect taste</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5" style="background: linear-gradient(135deg, var(--chocolate-medium) 0%, var(--chocolate-dark) 100%);">
    <div class="container text-center">
        <h2 class="text-white mb-4" style="font-family: 'Playfair Display', serif;">Ready to Experience ChocoLuxe?</h2>
        <a href="{{ route('products.index') }}" class="btn btn-gold btn-lg">
            <i class="bi bi-bag me-2"></i>Shop Our Collection
        </a>
    </div>
</section>
@endsection
