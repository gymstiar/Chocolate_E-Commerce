@extends('layouts.app')

@section('title', 'Contact Us - ChocoLuxe')

@section('content')
<!-- Hero Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%); min-height: 30vh; display: flex; align-items: center;">
    <div class="container text-center text-white">
        <span class="badge badge-gold mb-3" data-aos="fade-up">Get in Touch</span>
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100" style="font-family: 'Playfair Display', serif;">
            Contact Us
        </h1>
        <p class="lead opacity-75" data-aos="fade-up" data-aos-delay="200">We'd love to hear from you</p>
    </div>
</section>

<!-- Contact Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-7" data-aos="fade-right">
                <div class="card card-chocolate">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="mb-4" style="font-family: 'Playfair Display', serif;">Send us a Message</h3>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" name="name" class="form-control form-control-chocolate @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control form-control-chocolate @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject" class="form-control form-control-chocolate @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" rows="5" class="form-control form-control-chocolate @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-chocolate btn-lg">
                                        <i class="bi bi-send me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5" data-aos="fade-left">
                <h3 class="mb-4" style="font-family: 'Playfair Display', serif;">Contact Information</h3>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div style="width: 60px; height: 60px; background: var(--chocolate-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-geo-alt fs-4 text-dark"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Our Location</h5>
                        <p class="text-muted mb-0">123 Chocolate Lane<br>Sweet City, SC 12345<br>Indonesia</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div style="width: 60px; height: 60px; background: var(--chocolate-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-telephone fs-4 text-dark"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Phone Number</h5>
                        <p class="text-muted mb-0">+62 812 3456 7890<br>+62 21 1234 5678</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div style="width: 60px; height: 60px; background: var(--chocolate-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-envelope fs-4 text-dark"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Email Address</h5>
                        <p class="text-muted mb-0">hello@chocoluxe.com<br>support@chocoluxe.com</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div style="width: 60px; height: 60px; background: var(--chocolate-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-clock fs-4 text-dark"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Business Hours</h5>
                        <p class="text-muted mb-0">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                    </div>
                </div>

                <!-- Social Media -->
                <h5 class="mt-5 mb-3">Follow Us</h5>
                <div class="d-flex gap-2">
                    <a href="#" class="btn rounded-circle" style="width: 50px; height: 50px; background: #3b5998; color: white; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>
                    <a href="#" class="btn rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); color: white; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>
                    <a href="#" class="btn rounded-circle" style="width: 50px; height: 50px; background: #1da1f2; color: white; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-twitter-x fs-5"></i>
                    </a>
                    <a href="#" class="btn rounded-circle" style="width: 50px; height: 50px; background: #25d366; color: white; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-whatsapp fs-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section style="height: 400px; background: var(--chocolate-cream);">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091242803!2d106.68942998076056!3d-6.229386738628052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1702476532000!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
@endsection
