@extends('layouts.app')

@section('title', 'Confirm Password - ChocoLuxe')

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
                    <p class="text-white-50">Security verification required</p>
                </div>

                <div class="card card-chocolate border-0 shadow-lg" data-aos="fade-up">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="text-center mb-4" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                            <i class="bi bi-shield-lock me-2" style="color: var(--chocolate-gold);"></i>Confirm Password
                        </h4>

                        <p class="text-muted text-center mb-4">
                            Please confirm your password before continuing.
                        </p>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-lock me-1" style="color: var(--chocolate-gold);"></i>Password
                                </label>
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control form-control-lg form-control-chocolate @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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

                            <button type="submit" class="btn btn-chocolate btn-lg w-100 mb-4">
                                <i class="bi bi-check-circle me-2"></i>Confirm Password
                            </button>

                            @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: var(--chocolate-gold);">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            @endif
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
