@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<section class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, var(--chocolate-cream) 0%, var(--chocolate-white) 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <!-- Broken Chocolate Icon -->
                <div class="mb-4 position-relative d-inline-block">
                    <div class="error-icon-wrapper">
                        <i class="bi bi-emoji-frown error-icon"></i>
                    </div>
                    <div class="floating-chocolate chocolate-1"><i class="bi bi-heart-fill"></i></div>
                    <div class="floating-chocolate chocolate-2"><i class="bi bi-star-fill"></i></div>
                    <div class="floating-chocolate chocolate-3"><i class="bi bi-diamond-fill"></i></div>
                    <div class="floating-chocolate chocolate-4"><i class="bi bi-stars"></i></div>
                </div>

                <!-- Error Code with Animation -->
                <div class="error-code-wrapper mb-3">
                    <span class="error-code-digit">4</span>
                    <span class="error-code-digit error-code-middle">
                        <i class="bi bi-cup-hot-fill"></i>
                    </span>
                    <span class="error-code-digit">4</span>
                </div>

                <!-- Error Title -->
                <h2 class="mb-3" style="font-family: 'Playfair Display', serif; color: var(--chocolate-medium);">
                    <i class="bi bi-search me-2" style="color: var(--chocolate-gold);"></i>
                    Oops! Page Not Found
                </h2>

                <!-- Error Message -->
                <div class="card card-chocolate mx-auto mb-4" style="max-width: 550px;">
                    <div class="card-body py-4">
                        <p class="text-muted mb-3 fs-5">
                            <i class="bi bi-box-seam me-2" style="color: var(--chocolate-gold);"></i>
                            The chocolate you're looking for seems to have melted away...
                        </p>
                        <p class="text-muted mb-0 small">
                            The page might have been moved, deleted, or perhaps never existed in the first place.
                        </p>
                    </div>
                </div>

                <!-- Search Box -->
                <div class="mx-auto mb-4" style="max-width: 400px;">
                    <form action="{{ route('products.index') }}" method="GET" class="input-group">
                        <input type="text" name="search" class="form-control form-control-chocolate" placeholder="Search for chocolates...">
                        <button class="btn btn-chocolate" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex flex-wrap gap-3 justify-content-center mb-4">
                    <a href="{{ url('/') }}" class="btn btn-chocolate btn-lg">
                        <i class="bi bi-house me-2"></i>Back to Home
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-gold btn-lg">
                        <i class="bi bi-bag me-2"></i>Browse Shop
                    </a>
                </div>

                <!-- Suggested Links -->
                <div class="suggested-links">
                    <p class="text-muted mb-2">Or try these popular pages:</p>
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <a href="{{ route('products.index') }}" class="badge badge-chocolate text-decoration-none">
                            <i class="bi bi-box me-1"></i>All Products
                        </a>
                        <a href="{{ route('about') }}" class="badge badge-chocolate text-decoration-none">
                            <i class="bi bi-info-circle me-1"></i>About Us
                        </a>
                        <a href="{{ route('contact') }}" class="badge badge-chocolate text-decoration-none">
                            <i class="bi bi-envelope me-1"></i>Contact
                        </a>
                    </div>
                </div>

                <!-- Decorative Bottom -->
                <div class="mt-5">
                    <div class="d-flex justify-content-center gap-2">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.error-icon-wrapper {
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 20px 60px rgba(44, 24, 16, 0.3);
    animation: bounce 2s ease-in-out infinite;
}

.error-icon {
    font-size: 4rem;
    color: var(--chocolate-gold);
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.error-code-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.error-code-digit {
    font-family: 'Playfair Display', serif;
    font-size: 5rem;
    font-weight: 700;
    color: var(--chocolate-dark);
    text-shadow: 3px 3px 0 var(--chocolate-gold);
    line-height: 1;
}

.error-code-middle {
    color: var(--chocolate-gold);
    animation: spin 4s ease-in-out infinite;
}

.error-code-middle i {
    font-size: 4rem;
}

@keyframes spin {
    0%, 100% { transform: rotate(0deg) scale(1); }
    25% { transform: rotate(15deg) scale(1.1); }
    75% { transform: rotate(-15deg) scale(1.1); }
}

.floating-chocolate {
    position: absolute;
    color: var(--chocolate-gold);
    animation: float 3s ease-in-out infinite;
    opacity: 0.6;
}

.chocolate-1 {
    top: -15px;
    right: -25px;
    font-size: 1.5rem;
    animation-delay: 0s;
}

.chocolate-2 {
    top: 30%;
    left: -35px;
    font-size: 1rem;
    animation-delay: 0.5s;
}

.chocolate-3 {
    bottom: 10px;
    right: -15px;
    font-size: 1.2rem;
    animation-delay: 1s;
}

.chocolate-4 {
    bottom: 40%;
    left: -25px;
    font-size: 1.3rem;
    animation-delay: 1.5s;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(15deg); }
}

.dot {
    width: 10px;
    height: 10px;
    background: var(--chocolate-gold);
    border-radius: 50%;
    animation: dotPulse 1.5s ease-in-out infinite;
}

.dot:nth-child(2) { animation-delay: 0.3s; }
.dot:nth-child(3) { animation-delay: 0.6s; }

@keyframes dotPulse {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.2); }
}

.suggested-links .badge {
    padding: 0.6rem 1rem;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.suggested-links .badge:hover {
    background: var(--chocolate-gold) !important;
    color: var(--chocolate-dark) !important;
    transform: translateY(-2px);
}
</style>
@endsection
