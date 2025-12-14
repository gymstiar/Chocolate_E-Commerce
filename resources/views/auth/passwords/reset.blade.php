@extends('layouts.app')

@section('title', 'Reset Password - ChocoLuxe')

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
                    <p class="text-white-50">Create a new password</p>
                </div>

                <div class="card card-chocolate border-0 shadow-lg" data-aos="fade-up">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="text-center mb-4" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                            <i class="bi bi-shield-lock me-2" style="color: var(--chocolate-gold);"></i>Reset Password
                        </h4>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope me-1" style="color: var(--chocolate-gold);"></i>Email Address
                                </label>
                                <input id="email" type="email" class="form-control form-control-lg form-control-chocolate @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-lock me-1" style="color: var(--chocolate-gold);"></i>New Password
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

                            <div class="mb-4">
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

                            <button type="submit" class="btn btn-chocolate btn-lg w-100 mb-4">
                                <i class="bi bi-check-circle me-2"></i>Reset Password
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
