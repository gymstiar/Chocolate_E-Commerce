@extends('layouts.app')

@section('title', '403 - Access Denied')

@section('content')
<section class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, var(--chocolate-cream) 0%, var(--chocolate-white) 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <!-- Chocolate Lock Icon -->
                <div class="mb-4 position-relative d-inline-block">
                    <div class="error-icon-wrapper">
                        <i class="bi bi-shield-lock-fill error-icon"></i>
                    </div>
                    <div class="floating-chocolate chocolate-1"><i class="bi bi-star-fill"></i></div>
                    <div class="floating-chocolate chocolate-2"><i class="bi bi-star-fill"></i></div>
                    <div class="floating-chocolate chocolate-3"><i class="bi bi-star-fill"></i></div>
                </div>

                <!-- Error Code -->
                <h1 class="display-1 fw-bold mb-2" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark); text-shadow: 3px 3px 0 var(--chocolate-gold);">
                    403
                </h1>

                <!-- Error Title -->
                <h2 class="mb-3" style="font-family: 'Playfair Display', serif; color: var(--chocolate-medium);">
                    <i class="bi bi-lock me-2" style="color: var(--chocolate-gold);"></i>
                    Access Denied
                </h2>

                <!-- Error Message -->
                <div class="card card-chocolate mx-auto mb-4" style="max-width: 500px;">
                    <div class="card-body py-4">
                        <p class="text-muted mb-0 fs-5">
                            <i class="bi bi-info-circle me-2" style="color: var(--chocolate-gold);"></i>
                            {{ $exception->getMessage() ?: 'You don\'t have permission to access this page.' }}
                        </p>
                    </div>
                </div>

                <!-- Helpful Message -->
                <p class="text-muted mb-4">
                    This area might be restricted to specific users. Please make sure you're logged in with the correct account type.
                </p>

                <!-- Action Buttons -->
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ url('/') }}" class="btn btn-chocolate btn-lg">
                        <i class="bi bi-house me-2"></i>Back to Home
                    </a>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-chocolate btn-lg">
                        <i class="bi bi-arrow-left me-2"></i>Go Back
                    </a>
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-gold btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </a>
                    @endguest
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
    animation: pulse 2s ease-in-out infinite;
}

.error-icon {
    font-size: 4rem;
    color: var(--chocolate-gold);
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.floating-chocolate {
    position: absolute;
    color: var(--chocolate-gold);
    font-size: 1.5rem;
    animation: float 3s ease-in-out infinite;
    opacity: 0.7;
}

.chocolate-1 {
    top: -10px;
    right: -20px;
    animation-delay: 0s;
}

.chocolate-2 {
    top: 50%;
    left: -30px;
    animation-delay: 1s;
    font-size: 1rem;
}

.chocolate-3 {
    bottom: 0;
    right: -10px;
    animation-delay: 2s;
    font-size: 1.2rem;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(10deg); }
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
</style>
@endsection
