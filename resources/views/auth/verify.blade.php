@extends('layouts.app')

@section('title', 'Verify Email - ChocoLuxe')

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
                </div>

                <div class="card card-chocolate border-0 shadow-lg" data-aos="fade-up">
                    <div class="card-body p-4 p-lg-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-envelope-check display-1" style="color: var(--chocolate-gold);"></i>
                        </div>
                        
                        <h4 class="mb-4" style="font-family: 'Playfair Display', serif; color: var(--chocolate-dark);">
                            Verify Your Email Address
                        </h4>

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                <i class="bi bi-check-circle me-2"></i>A fresh verification link has been sent to your email address.
                            </div>
                        @endif

                        <p class="text-muted mb-4">
                            Before proceeding, please check your email for a verification link. If you did not receive the email, click below to request another.
                        </p>

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-chocolate btn-lg">
                                <i class="bi bi-envelope-arrow-up me-2"></i>Resend Verification Email
                            </button>
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
