@extends('layouts.app')

@section('title', 'Login - ChocoLuxe')

@section('content')
<section class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 50%, var(--chocolate-light) 100%);">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4" data-aos="fade-down">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <h2 class="fw-bold" style="font-family: 'Playfair Display', serif; color: var(--chocolate-gold);">
                            <i class="bi bi-gem me-2"></i>ChocoLuxe
                        </h2>
                    </a>
                    <p class="text-white-50">Welcome back! Sign in to continue</p>
                </div>

                <div class="card card-chocolate border-0 shadow-lg" data-aos="fade-up">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="text-center mb-4" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                            <i class="bi bi-box-arrow-in-right me-2" style="color: var(--chocolate-gold);"></i>Sign In
                        </h4>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope me-1" style="color: var(--chocolate-gold);"></i>Email Address
                                </label>
                                <input id="email" type="email" class="form-control form-control-lg form-control-chocolate @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-lock me-1" style="color: var(--chocolate-gold);"></i>Password
                                </label>
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control form-control-lg form-control-chocolate @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
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

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: var(--chocolate-gold);">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-chocolate btn-lg w-100 mb-4">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                            </button>

                            <div class="text-center">
                                <p class="mb-0 text-muted">
                                    Don't have an account? 
                                    <a href="{{ route('register') }}" class="fw-semibold text-decoration-none" style="color: var(--chocolate-gold);">
                                        Create Account
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
