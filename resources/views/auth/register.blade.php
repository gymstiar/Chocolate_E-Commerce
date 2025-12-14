@extends('layouts.app')

@section('title', 'Register - ChocoLuxe')

@section('content')
<section class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 50%, var(--chocolate-light) 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="text-center mb-4" data-aos="fade-down">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <h2 class="fw-bold" style="font-family: 'Playfair Display', serif; color: var(--chocolate-gold);">
                            <i class="bi bi-gem me-2"></i>ChocoLuxe
                        </h2>
                    </a>
                    <p class="text-white-50">Create your account and start shopping</p>
                </div>

                <div class="card card-chocolate border-0 shadow-lg" data-aos="fade-up">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="text-center mb-4" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                            <i class="bi bi-person-plus me-2" style="color: var(--chocolate-gold);"></i>Create Account
                        </h4>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Role Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-person-badge me-1" style="color: var(--chocolate-gold);"></i>I want to
                                </label>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="role" id="role_buyer" value="buyer" {{ old('role', 'buyer') === 'buyer' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-chocolate w-100 py-3" for="role_buyer">
                                            <i class="bi bi-bag-heart fs-3 d-block mb-2"></i>
                                            <strong>Buy Chocolates</strong>
                                            <small class="d-block text-muted">Shop & enjoy premium chocolates</small>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="role" id="role_seller" value="seller" {{ old('role') === 'seller' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-chocolate w-100 py-3" for="role_seller">
                                            <i class="bi bi-shop fs-3 d-block mb-2"></i>
                                            <strong>Sell Chocolates</strong>
                                            <small class="d-block text-muted">Manage your chocolate store</small>
                                        </label>
                                    </div>
                                </div>
                                @error('role')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1" style="color: var(--chocolate-gold);"></i>Full Name
                                </label>
                                <input id="name" type="text" class="form-control form-control-lg form-control-chocolate @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your full name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope me-1" style="color: var(--chocolate-gold);"></i>Email Address
                                </label>
                                <input id="email" type="email" class="form-control form-control-lg form-control-chocolate @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold">
                                    <i class="bi bi-phone me-1" style="color: var(--chocolate-gold);"></i>Phone Number <small class="text-muted">(Optional)</small>
                                </label>
                                <input id="phone" type="tel" class="form-control form-control-lg form-control-chocolate @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="tel" placeholder="e.g. 08123456789">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="bi bi-lock me-1" style="color: var(--chocolate-gold);"></i>Password
                                    </label>
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control form-control-lg form-control-chocolate @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Min. 8 characters">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                            <i class="bi bi-eye" id="password-icon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password-confirm" class="form-label fw-semibold">
                                        <i class="bi bi-lock-fill me-1" style="color: var(--chocolate-gold);"></i>Confirm Password
                                    </label>
                                    <div class="input-group">
                                        <input id="password-confirm" type="password" class="form-control form-control-lg form-control-chocolate" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat password">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password-confirm')">
                                            <i class="bi bi-eye" id="password-confirm-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-decoration-none" style="color: var(--chocolate-gold);">Terms of Service</a> and <a href="#" class="text-decoration-none" style="color: var(--chocolate-gold);">Privacy Policy</a>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-chocolate btn-lg w-100 mb-4">
                                <i class="bi bi-person-plus me-2"></i>Create Account
                            </button>

                            <div class="text-center">
                                <p class="mb-0 text-muted">
                                    Already have an account? 
                                    <a href="{{ route('login') }}" class="fw-semibold text-decoration-none" style="color: var(--chocolate-gold);">
                                        Sign In
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.btn-check:checked + .btn-outline-chocolate {
    background-color: var(--chocolate-medium);
    border-color: var(--chocolate-medium);
    color: white;
}
.btn-check:checked + .btn-outline-chocolate small {
    color: rgba(255,255,255,0.8) !important;
}
</style>

@push('scripts')
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + '-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
@endpush
@endsection
