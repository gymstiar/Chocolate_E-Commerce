<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="ChocoLuxe Seller Dashboard">

    <title>@yield('title', 'Seller Dashboard - ChocoLuxe')</title>

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
            background-color: #f8f9fa;
            color: var(--chocolate-dark);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Cards */
        .card-chocolate {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px var(--chocolate-shadow);
            transition: all 0.3s ease;
        }
        
        .card-chocolate:hover {
            box-shadow: 0 10px 30px var(--chocolate-shadow);
        }

        /* Form Controls */
        .form-control-chocolate {
            border: 2px solid var(--chocolate-cream);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control-chocolate:focus {
            border-color: var(--chocolate-gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        }

        /* Buttons */
        .btn-chocolate {
            background: linear-gradient(135deg, var(--chocolate-dark), var(--chocolate-medium));
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-chocolate:hover {
            background: linear-gradient(135deg, var(--chocolate-medium), var(--chocolate-light));
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(44, 24, 16, 0.3);
            color: white;
        }

        .btn-outline-chocolate {
            border: 2px solid var(--chocolate-dark);
            color: var(--chocolate-dark);
            background: transparent;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-chocolate:hover {
            background: var(--chocolate-dark);
            color: white;
        }

        /* Badges */
        .badge-gold {
            background: linear-gradient(135deg, var(--chocolate-gold), #C5A028);
            color: var(--chocolate-dark);
        }

        /* Section Padding */
        .section-padding {
            padding: 40px 0;
        }

        /* Table Style */
        .table th {
            background: var(--chocolate-cream);
            color: var(--chocolate-dark);
            font-weight: 600;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <!-- Seller Navigation -->
        @include('components.seller-navbar')
        
        <!-- Alert Messages -->
        <main class="flex-grow-1">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </main>

        <!-- Enhanced Footer -->
        <footer class="seller-footer">
            <div class="footer-main py-4">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <div class="d-flex align-items-center">
                                <span class="fs-4 fw-bold" style="color: var(--chocolate-gold); font-family: 'Playfair Display', serif;">
                                    🍫 ChocoLuxe
                                </span>
                                <span class="badge ms-2" style="background: rgba(212, 175, 55, 0.2); color: var(--chocolate-gold); font-size: 0.7rem;">
                                    SELLER
                                </span>
                            </div>
                            <p class="text-white-50 small mb-0 mt-2">
                                Your premium chocolate selling dashboard
                            </p>
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <div class="d-flex justify-content-lg-center gap-4">
                                <a href="{{ route('seller.dashboard') }}" class="footer-link text-white-50 text-decoration-none small">
                                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                                </a>
                                <a href="{{ route('seller.products.index') }}" class="footer-link text-white-50 text-decoration-none small">
                                    <i class="bi bi-box-seam me-1"></i>Products
                                </a>
                                <a href="{{ route('seller.orders.index') }}" class="footer-link text-white-50 text-decoration-none small">
                                    <i class="bi bi-receipt me-1"></i>Orders
                                </a>
                                <a href="{{ route('seller.reports.index') }}" class="footer-link text-white-50 text-decoration-none small">
                                    <i class="bi bi-graph-up me-1"></i>Reports
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="{{ route('home') }}" class="btn btn-sm" style="background: var(--chocolate-gold); color: var(--chocolate-dark);">
                                <i class="bi bi-shop me-1"></i>View Store
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom py-3" style="background: rgba(0,0,0,0.2);">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <small class="text-white-50">
                                &copy; {{ date('Y') }} ChocoLuxe. All rights reserved.
                            </small>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <small class="text-white-50">
                                Made with <i class="bi bi-heart-fill text-danger"></i> for chocolate lovers
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    
    <style>
        .seller-footer {
            background: linear-gradient(135deg, var(--chocolate-dark) 0%, #1a0f0a 100%);
            margin-top: auto;
        }
        .seller-footer .footer-link:hover {
            color: var(--chocolate-gold) !important;
        }
    </style>
    
    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;" id="notificationToasts"></div>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true,
            offset: 50
        });

        // Notification System
        let lastNotificationCount = 0;
        let lastNotificationIds = [];

        function fetchNotifications() {
            fetch('{{ route("notifications.index") }}')
                .then(response => response.json())
                .then(data => {
                    updateNotificationUI(data.notifications, data.unread_count);
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }

        function updateNotificationUI(notifications, unreadCount) {
            const countBadge = document.getElementById('notificationCount');
            const notificationList = document.getElementById('notificationList');
            const markAllBtn = document.getElementById('markAllBtn');

            // Update badge
            if (unreadCount > 0) {
                countBadge.textContent = unreadCount > 99 ? '99+' : unreadCount;
                countBadge.style.display = 'inline-block';
                markAllBtn.style.display = 'inline-block';
            } else {
                countBadge.style.display = 'none';
                markAllBtn.style.display = 'none';
            }

            // Check for new notifications and show toast
            if (unreadCount > lastNotificationCount && lastNotificationCount > 0) {
                const newNotifications = notifications.filter(n => !n.is_read && !lastNotificationIds.includes(n.id));
                newNotifications.forEach(n => showToast(n));
            }

            lastNotificationCount = unreadCount;
            lastNotificationIds = notifications.filter(n => !n.is_read).map(n => n.id);

            // Update list
            if (notifications.length === 0) {
                notificationList.innerHTML = `
                    <li class="text-center py-4 text-muted">
                        <i class="bi bi-bell-slash fs-3 d-block mb-2"></i>
                        No notifications yet
                    </li>
                `;
            } else {
                notificationList.innerHTML = notifications.map(n => `
                    <li>
                        <a class="dropdown-item d-flex py-3 ${n.is_read ? 'bg-light' : ''}" href="${n.link}" onclick="markAsRead(${n.id})">
                            <div class="flex-shrink-0">
                                <i class="bi ${n.icon} fs-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <strong class="d-block small">${n.title}</strong>
                                <p class="mb-1 small text-muted" style="line-height: 1.3;">${n.message.substring(0, 80)}${n.message.length > 80 ? '...' : ''}</p>
                                <small class="text-muted">${n.time_ago}</small>
                            </div>
                            ${!n.is_read ? '<span class="badge bg-primary rounded-pill ms-2">New</span>' : ''}
                        </a>
                    </li>
                `).join('');
            }
        }

        function showToast(notification) {
            const toastContainer = document.getElementById('notificationToasts');
            const toastId = 'toast-' + notification.id;
            const toastHtml = `
                <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="8000">
                    <div class="toast-header" style="background: var(--chocolate-gold); color: var(--chocolate-dark);">
                        <i class="bi ${notification.icon} me-2"></i>
                        <strong class="me-auto">${notification.title}</strong>
                        <small>Just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        ${notification.message}
                        <div class="mt-2 pt-2 border-top">
                            <a href="${notification.link}" class="btn btn-sm btn-chocolate">View</a>
                        </div>
                    </div>
                </div>
            `;
            toastContainer.insertAdjacentHTML('beforeend', toastHtml);
            const toastEl = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
            
            // Play notification sound (optional)
            // const audio = new Audio('/sounds/notification.mp3');
            // audio.play();
        }

        function markAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            });
        }

        function markAllRead() {
            fetch('{{ route("notifications.mark-all-read") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            }).then(() => fetchNotifications());
        }

        // Initial fetch and polling every 30 seconds
        document.addEventListener('DOMContentLoaded', function() {
            fetchNotifications();
            setInterval(fetchNotifications, 30000);
        });
    </script>
    @stack('scripts')
</body>
</html>


