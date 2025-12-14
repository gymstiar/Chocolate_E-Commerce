<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="ChocoLuxe - Premium Artisan Chocolate E-Commerce">

    <title>@yield('title', config('app.name', 'ChocoLuxe'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!-- Custom Chocolate Theme -->
    <style>
        :root {
            --chocolate-dark: #2C1810;
            --chocolate-medium: #4A3728;
            --chocolate-light: #6B4423;
            --chocolate-cream: #F5E6D3;
            --chocolate-gold: #D4AF37;
            --chocolate-white: #FFF8F0;
            --chocolate-accent: #8B4513;
            --chocolate-shadow: rgba(44, 24, 16, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--chocolate-white);
            color: var(--chocolate-dark);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--chocolate-cream);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--chocolate-light);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--chocolate-medium);
        }

        /* Navbar Styles */
        .navbar-chocolate {
            background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);
            padding: 1rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px var(--chocolate-shadow);
        }

        .navbar-chocolate.scrolled {
            padding: 0.5rem 0;
            background: var(--chocolate-dark);
        }

        .navbar-chocolate .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--chocolate-gold) !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .navbar-chocolate .navbar-brand:hover {
            color: var(--chocolate-cream) !important;
        }

        .navbar-chocolate .nav-link {
            color: var(--chocolate-cream) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .navbar-chocolate .nav-link:hover {
            color: var(--chocolate-gold) !important;
            background: rgba(255,255,255,0.1);
        }

        .navbar-chocolate .nav-link.active {
            color: var(--chocolate-dark) !important;
            background: var(--chocolate-gold);
        }

        /* Button Styles */
        .btn-chocolate {
            background: linear-gradient(135deg, var(--chocolate-light) 0%, var(--chocolate-medium) 100%);
            color: var(--chocolate-cream);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px var(--chocolate-shadow);
        }

        .btn-chocolate:hover {
            background: linear-gradient(135deg, var(--chocolate-medium) 0%, var(--chocolate-dark) 100%);
            color: var(--chocolate-gold);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px var(--chocolate-shadow);
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--chocolate-gold) 0%, #B8960F 100%);
            color: var(--chocolate-dark);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #B8960F 0%, var(--chocolate-gold) 100%);
            color: var(--chocolate-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }

        .btn-outline-chocolate {
            background: transparent;
            color: var(--chocolate-medium);
            border: 2px solid var(--chocolate-medium);
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-chocolate:hover {
            background: var(--chocolate-medium);
            color: var(--chocolate-cream);
        }

        /* Card Styles */
        .card-chocolate {
            background: white;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px var(--chocolate-shadow);
            transition: all 0.3s ease;
        }

        .card-chocolate:hover {
            box-shadow: 0 20px 60px var(--chocolate-shadow);
        }

        .card-chocolate .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card-chocolate:hover .card-img-top {
            transform: scale(1.1);
        }

        .card-chocolate .card-body {
            padding: 1.5rem;
        }

        .card-chocolate .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--chocolate-dark);
            margin-bottom: 0.5rem;
        }

        .card-chocolate .price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--chocolate-gold);
        }

        .card-chocolate .price-old {
            font-size: 1rem;
            color: #999;
            text-decoration: line-through;
        }

        /* Section Styles */
        .section-padding {
            padding: 5rem 0;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--chocolate-dark);
            margin-bottom: 1rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--chocolate-gold), var(--chocolate-light));
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--chocolate-light);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Footer Styles */
        .footer-chocolate {
            background: linear-gradient(135deg, var(--chocolate-dark) 0%, var(--chocolate-medium) 100%);
            color: var(--chocolate-cream);
            padding: 4rem 0 2rem;
        }

        .footer-chocolate h5 {
            color: var(--chocolate-gold);
            font-family: 'Playfair Display', serif;
            margin-bottom: 1.5rem;
        }

        .footer-chocolate a {
            color: var(--chocolate-cream);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-chocolate a:hover {
            color: var(--chocolate-gold);
        }

        .footer-chocolate .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .footer-chocolate .social-icons a:hover {
            background: var(--chocolate-gold);
            color: var(--chocolate-dark);
        }

        /* Badge Styles */
        .badge-chocolate {
            background: var(--chocolate-light);
            color: var(--chocolate-cream);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-gold {
            background: var(--chocolate-gold);
            color: var(--chocolate-dark);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }

        /* Form Styles */
        .form-control-chocolate {
            border: 2px solid var(--chocolate-cream);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control-chocolate:focus {
            border-color: var(--chocolate-gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }

            .navbar-chocolate .navbar-brand {
                font-size: 1.5rem;
            }
        }

        /* Alert Styles */
        .alert-chocolate {
            background: var(--chocolate-cream);
            border: 1px solid var(--chocolate-light);
            color: var(--chocolate-dark);
            border-radius: 10px;
        }

        /* Product Card Overlay */
        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(44, 24, 16, 0.8), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1rem;
        }

        .card-chocolate:hover .product-overlay {
            opacity: 1;
        }

        /* Wishlist Heart */
        .wishlist-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 10;
        }

        .wishlist-btn:hover {
            background: var(--chocolate-gold);
            color: white;
        }

        .wishlist-btn.active {
            background: #e74c3c;
            color: white;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-chocolate sticky-top" id="mainNavbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-stars"></i> ChocoLuxe
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false">
                    <i class="bi bi-list text-white fs-4"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right"></i> Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-gold btn-sm ms-2" href="{{ route('register') }}">
                                    Register
                                </a>
                            </li>
                        @else
                            @if(Auth::user()->isBuyer())
                                <li class="nav-item">
                                    <a class="nav-link position-relative" href="{{ route('buyer.cart') }}">
                                        <i class="bi bi-cart3"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                                            {{ Auth::user()->cartItems->count() }}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('buyer.wishlist') }}">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                </li>
                                <!-- Notification Bell for Buyers -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="buyerNotificationBell">
                                        <i class="bi bi-bell"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="buyerNotificationCount" style="display: none;">
                                            0
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end shadow" style="width: 320px; max-height: 400px; overflow-y: auto;">
                                        <li class="dropdown-header d-flex justify-content-between align-items-center py-2 px-3" style="background: var(--chocolate-cream);">
                                            <strong><i class="bi bi-bell me-2"></i>Notifications</strong>
                                            <button class="btn btn-sm btn-link text-decoration-none p-0" onclick="markAllBuyerRead()" id="markAllBuyerBtn" style="display: none;">
                                                Mark all read
                                            </button>
                                        </li>
                                        <li><hr class="dropdown-divider m-0"></li>
                                        <div id="buyerNotificationList">
                                            <li class="text-center py-4 text-muted">
                                                <i class="bi bi-bell-slash fs-3 d-block mb-2"></i>
                                                No notifications yet
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->isSeller())
                                        <li><a class="dropdown-item" href="{{ route('seller.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('seller.products.index') }}"><i class="bi bi-box me-2"></i>Products</a></li>
                                        <li><a class="dropdown-item" href="{{ route('seller.orders.index') }}"><i class="bi bi-receipt me-2"></i>Orders</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('buyer.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('buyer.orders') }}"><i class="bi bi-bag me-2"></i>My Orders</a></li>
                                        <li><a class="dropdown-item" href="{{ route('buyer.wishlist') }}"><i class="bi bi-heart me-2"></i>Wishlist</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer-chocolate">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <h5><i class="bi bi-stars"></i> ChocoLuxe</h5>
                        <p class="mb-3">Premium artisanal chocolates crafted with passion and the finest cocoa from around the world.</p>
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-twitter-x"></i></a>
                            <a href="#"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-4">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ url('/') }}">Home</a></li>
                            <li class="mb-2"><a href="{{ route('products.index') }}">Shop</a></li>
                            <li class="mb-2"><a href="{{ route('about') }}">About Us</a></li>
                            <li class="mb-2"><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5>Customer Service</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#">FAQ</a></li>
                            <li class="mb-2"><a href="#">Shipping Info</a></li>
                            <li class="mb-2"><a href="#">Returns Policy</a></li>
                            <li class="mb-2"><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5>Contact Us</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>123 Chocolate Lane, Sweet City</li>
                            <li class="mb-2"><i class="bi bi-phone me-2"></i>+62 812 3456 7890</li>
                            <li class="mb-2"><i class="bi bi-envelope me-2"></i>hello@chocoluxe.com</li>
                            <li class="mb-2"><i class="bi bi-clock me-2"></i>Mon - Sat: 9:00 AM - 6:00 PM</li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">&copy; {{ date('Y') }} ChocoLuxe. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <img src="https://via.placeholder.com/200x30?text=Payment+Methods" alt="Payment Methods" class="img-fluid" style="max-height: 30px; filter: grayscale(100%) brightness(2);">
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        @auth
        @if(Auth::user()->isBuyer())
        // Buyer Notification System
        let lastBuyerNotificationCount = 0;
        let lastBuyerNotificationIds = [];

        function fetchBuyerNotifications() {
            fetch('{{ route("notifications.index") }}')
                .then(response => response.json())
                .then(data => {
                    updateBuyerNotificationUI(data.notifications, data.unread_count);
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }

        function updateBuyerNotificationUI(notifications, unreadCount) {
            const countBadge = document.getElementById('buyerNotificationCount');
            const notificationList = document.getElementById('buyerNotificationList');
            const markAllBtn = document.getElementById('markAllBuyerBtn');

            if (!countBadge || !notificationList) return;

            // Update badge
            if (unreadCount > 0) {
                countBadge.textContent = unreadCount > 99 ? '99+' : unreadCount;
                countBadge.style.display = 'inline-block';
                if (markAllBtn) markAllBtn.style.display = 'inline-block';
            } else {
                countBadge.style.display = 'none';
                if (markAllBtn) markAllBtn.style.display = 'none';
            }

            // Check for new notifications and show toast
            if (unreadCount > lastBuyerNotificationCount && lastBuyerNotificationCount > 0) {
                const newNotifications = notifications.filter(n => !n.is_read && !lastBuyerNotificationIds.includes(n.id));
                newNotifications.forEach(n => showBuyerToast(n));
            }

            lastBuyerNotificationCount = unreadCount;
            lastBuyerNotificationIds = notifications.filter(n => !n.is_read).map(n => n.id);

            // Update list
            if (notifications.length === 0) {
                notificationList.innerHTML = `
                    <li class="text-center py-4 text-muted">
                        <i class="bi bi-bell-slash fs-3 d-block mb-2"></i>
                        No notifications yet
                    </li>
                `;
            } else {
                notificationList.innerHTML = notifications.slice(0, 10).map(n => `
                    <li>
                        <a class="dropdown-item d-flex py-2 ${n.is_read ? 'bg-light' : ''}" href="${n.link}" onclick="markBuyerAsRead(${n.id})">
                            <div class="flex-shrink-0">
                                <i class="bi ${n.icon} fs-5"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <strong class="d-block small">${n.title}</strong>
                                <p class="mb-0 small text-muted">${n.message.substring(0, 60)}${n.message.length > 60 ? '...' : ''}</p>
                                <small class="text-muted">${n.time_ago}</small>
                            </div>
                        </a>
                    </li>
                `).join('');
            }
        }

        function showBuyerToast(notification) {
            const toastHtml = `
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                    <div class="toast-header" style="background: var(--chocolate-gold); color: var(--chocolate-dark);">
                        <i class="bi ${notification.icon} me-2"></i>
                        <strong class="me-auto">${notification.title}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        ${notification.message}
                        <div class="mt-2"><a href="${notification.link}" class="btn btn-sm btn-chocolate">View</a></div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', toastHtml);
            const toastEl = document.body.lastElementChild;
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }

        function markBuyerAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            });
        }

        function markAllBuyerRead() {
            fetch('{{ route("notifications.mark-all-read") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            }).then(() => fetchBuyerNotifications());
        }

        // Initial fetch and polling every 30 seconds
        document.addEventListener('DOMContentLoaded', function() {
            fetchBuyerNotifications();
            setInterval(fetchBuyerNotifications, 30000);
        });
        @endif
        @endauth
    </script>
    
    @stack('scripts')
</body>
</html>

