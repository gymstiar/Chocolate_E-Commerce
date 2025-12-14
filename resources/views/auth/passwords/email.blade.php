@extends('layouts.app')

@section('title', 'Forgot Password - ChocoLuxe')

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
                    <p class="text-white-50">Reset your password</p>
                </div>

                <div class="card card-chocolate border-0 shadow-lg" data-aos="fade-up">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="text-center mb-4" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                            <i class="bi bi-key me-2" style="color: var(--chocolate-gold);"></i>Forgot Password
                        </h4>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
                            </div>
                        @endif

                        <p class="text-muted text-center mb-4">
                            Enter your email address and we'll send you a link to reset your password.
                        </p>

                        <form method="POST" action="{{ route('password.email') }}">
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

                            <button type="submit" class="btn btn-chocolate btn-lg w-100 mb-4">
                                <i class="bi bi-envelope-arrow-up me-2"></i>Send Reset Link
                            </button>

                            <div class="text-center">
                                <p class="mb-0 text-muted">
                                    Remember your password? 
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
@endsection
