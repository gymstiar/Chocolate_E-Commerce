@extends('layouts.app')

@section('title', 'My Profile - ChocoLuxe')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-person-circle me-2" style="color: var(--chocolate-gold);"></i>My Profile
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4" data-aos="fade-right">
                <!-- Avatar Card -->
                <div class="card card-chocolate mb-4">
                    <div class="card-body text-center">
                        <div class="position-relative d-inline-block mb-3">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: var(--chocolate-light); color: white; font-size: 3rem; margin: 0 auto;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <h5 class="mb-1">{{ $user->name }}</h5>
                        <p class="text-muted mb-3">{{ $user->email }}</p>
                        <span class="badge badge-gold">{{ ucfirst($user->role) }}</span>

                        <hr>

                        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-outline-chocolate btn-sm">
                                <i class="bi bi-camera me-1"></i>Update Avatar
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent">
                        <h6 class="mb-0">Quick Links</h6>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('buyer.dashboard') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-speedometer2 me-2" style="color: var(--chocolate-gold);"></i>Dashboard
                        </a>
                        <a href="{{ route('buyer.orders') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-bag me-2" style="color: var(--chocolate-gold);"></i>My Orders
                        </a>
                        <a href="{{ route('buyer.wishlist') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-heart me-2" style="color: var(--chocolate-gold);"></i>Wishlist
                        </a>
                        <a href="{{ route('buyer.addresses') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-geo-alt me-2" style="color: var(--chocolate-gold);"></i>Addresses
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-left">
                <!-- Profile Info -->
                <div class="card card-chocolate mb-4">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-person me-2" style="color: var(--chocolate-gold);"></i>Profile Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control form-control-chocolate @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control form-control-chocolate @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control form-control-chocolate @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Member Since</label>
                                    <input type="text" class="form-control" value="{{ $user->created_at->format('d M Y') }}" disabled>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-chocolate">
                                <i class="bi bi-check-circle me-2"></i>Save Changes
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="card card-chocolate">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0"><i class="bi bi-lock me-2" style="color: var(--chocolate-gold);"></i>Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" name="current_password" class="form-control form-control-chocolate @error('current_password') is-invalid @enderror" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control form-control-chocolate @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control form-control-chocolate" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-chocolate">
                                <i class="bi bi-shield-lock me-2"></i>Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
