@extends('layouts.seller')

@section('title', 'Settings - ChocoLuxe Seller')

@section('content')
<section class="py-4" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);">
    <div class="container">
        <h2 class="text-white mb-0" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-gear me-2" style="color: var(--chocolate-gold);"></i>Website Settings
        </h2>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <form action="{{ route('seller.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <!-- General Settings -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2" style="color: var(--chocolate-gold);"></i>General</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="site_name" class="form-control form-control-chocolate" value="{{ $settings['site_name'] ?? 'ChocoLuxe' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Site Description</label>
                                <textarea name="site_description" class="form-control form-control-chocolate" rows="3">{{ $settings['site_description'] ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Logo</label>
                                @if(isset($settings['logo']))
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $settings['logo']) }}" class="img-fluid" style="max-height: 60px;">
                                </div>
                                @endif
                                <input type="file" name="logo" class="form-control form-control-chocolate" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-telephone me-2" style="color: var(--chocolate-gold);"></i>Contact Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="contact_email" class="form-control form-control-chocolate" value="{{ $settings['contact_email'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="contact_phone" class="form-control form-control-chocolate" value="{{ $settings['contact_phone'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">WhatsApp</label>
                                <input type="tel" name="contact_whatsapp" class="form-control form-control-chocolate" value="{{ $settings['contact_whatsapp'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="contact_address" class="form-control form-control-chocolate" rows="2">{{ $settings['contact_address'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <!-- Social Media -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-share me-2" style="color: var(--chocolate-gold);"></i>Social Media</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-facebook me-1"></i>Facebook</label>
                                <input type="url" name="social_facebook" class="form-control form-control-chocolate" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-instagram me-1"></i>Instagram</label>
                                <input type="url" name="social_instagram" class="form-control form-control-chocolate" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-twitter me-1"></i>Twitter</label>
                                <input type="url" name="social_twitter" class="form-control form-control-chocolate" value="{{ $settings['social_twitter'] ?? '' }}" placeholder="https://twitter.com/...">
                            </div>
                        </div>
                    </div>

                    <!-- Bank Account -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-bank me-2" style="color: var(--chocolate-gold);"></i>Bank Account</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control form-control-chocolate" value="{{ $settings['bank_name'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Account Name</label>
                                <input type="text" name="bank_account_name" class="form-control form-control-chocolate" value="{{ $settings['bank_account_name'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Account Number</label>
                                <input type="text" name="bank_account_number" class="form-control form-control-chocolate" value="{{ $settings['bank_account_number'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Shipping -->
                    <div class="card card-chocolate mb-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="bi bi-truck me-2" style="color: var(--chocolate-gold);"></i>Shipping</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Regular Shipping (Rp)</label>
                                    <input type="number" name="shipping_regular" class="form-control form-control-chocolate" value="{{ $settings['shipping_regular'] ?? 15000 }}">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Express Shipping (Rp)</label>
                                    <input type="number" name="shipping_express" class="form-control form-control-chocolate" value="{{ $settings['shipping_express'] ?? 25000 }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-chocolate btn-lg">
                            <i class="bi bi-check-circle me-2"></i>Save Settings
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
