<!-- Seller Navbar Component -->
<nav class="seller-nav sticky-top" style="background: linear-gradient(90deg, var(--chocolate-dark) 0%, #3D2A1E 100%); border-bottom: 3px solid var(--chocolate-gold);">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between py-2">
            <!-- Logo/Brand -->
            <a href="{{ route('seller.dashboard') }}" class="text-decoration-none d-flex align-items-center">
                <span class="fs-4 fw-bold" style="color: var(--chocolate-gold); font-family: 'Playfair Display', serif;">
                    🍫 ChocoLuxe
                </span>
                <span class="badge ms-2" style="background: var(--chocolate-gold); color: var(--chocolate-dark); font-size: 0.7rem;">
                    SELLER
                </span>
            </a>

            <!-- Desktop Navigation -->
            <ul class="nav d-none d-lg-flex align-items-center mb-0">
                <li class="nav-item">
                    <a href="{{ route('seller.dashboard') }}" class="nav-link px-3 text-white {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('seller.products.index') }}" class="nav-link px-3 text-white {{ request()->routeIs('seller.products.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam me-1"></i>Products
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('seller.orders.index') }}" class="nav-link px-3 text-white {{ request()->routeIs('seller.orders.*') ? 'active' : '' }}">
                        <i class="bi bi-receipt me-1"></i>Orders
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('seller.categories.index') }}" class="nav-link px-3 text-white {{ request()->routeIs('seller.categories.*') ? 'active' : '' }}">
                        <i class="bi bi-grid me-1"></i>Categories
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('seller.customers.index') }}" class="nav-link px-3 text-white {{ request()->routeIs('seller.customers.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-1"></i>Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('seller.promos.index') }}" class="nav-link px-3 text-white {{ request()->routeIs('seller.promos.*') ? 'active' : '' }}">
                        <i class="bi bi-tag me-1"></i>Promos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('seller.reports.index') }}" class="nav-link px-3 text-white {{ request()->routeIs('seller.reports.*') ? 'active' : '' }}">
                        <i class="bi bi-graph-up me-1"></i>Reports
                    </a>
                </li>
                <!-- Notification Bell -->
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="notificationBell">
                        <i class="bi bi-bell-fill text-white fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge" id="notificationCount" style="display: none;">
                            0
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow notification-dropdown" style="width: 350px; max-height: 400px; overflow-y: auto;">
                        <li class="dropdown-header d-flex justify-content-between align-items-center py-2 px-3" style="background: var(--chocolate-cream);">
                            <strong><i class="bi bi-bell me-2"></i>Notifications</strong>
                            <button class="btn btn-sm btn-link text-decoration-none p-0" onclick="markAllRead()" id="markAllBtn" style="display: none;">
                                Mark all read
                            </button>
                        </li>
                        <li><hr class="dropdown-divider m-0"></li>
                        <div id="notificationList">
                            <li class="text-center py-4 text-muted">
                                <i class="bi bi-bell-slash fs-3 d-block mb-2"></i>
                                No notifications yet
                            </li>
                        </div>
                    </ul>
                </li>
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name ?? 'Seller' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="{{ route('seller.settings.index') }}">
                                <i class="bi bi-gear me-2"></i>Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                <i class="bi bi-shop me-2"></i>View Store
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form-seller').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                            <form id="logout-form-seller" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Mobile Toggle -->
            <button class="btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sellerMobileMenu" style="color: var(--chocolate-gold);">
                <i class="bi bi-list fs-3"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Offcanvas Menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sellerMobileMenu" style="background: var(--chocolate-dark);">
    <div class="offcanvas-header border-bottom" style="border-color: var(--chocolate-gold) !important;">
        <h5 class="offcanvas-title" style="color: var(--chocolate-gold); font-family: 'Playfair Display', serif;">
            🍫 ChocoLuxe Seller
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <nav class="nav flex-column">
            <a href="{{ route('seller.dashboard') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
            <a href="{{ route('seller.products.index') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('seller.products.*') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-box-seam me-2"></i>Products
            </a>
            <a href="{{ route('seller.orders.index') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('seller.orders.*') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-receipt me-2"></i>Orders
            </a>
            <a href="{{ route('seller.categories.index') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('seller.categories.*') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-grid me-2"></i>Categories
            </a>
            <a href="{{ route('seller.customers.index') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('seller.customers.*') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-people me-2"></i>Customers
            </a>
            <a href="{{ route('seller.promos.index') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('seller.promos.*') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-tag me-2"></i>Promos
            </a>
            <a href="{{ route('seller.reports.index') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('seller.reports.*') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-graph-up me-2"></i>Reports
            </a>
            <a href="{{ route('seller.settings.index') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('seller.settings.*') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-gear me-2"></i>Settings
            </a>
            <div class="p-3 mt-auto">
                <a href="{{ route('home') }}" class="btn btn-outline-light w-100 mb-2">
                    <i class="bi bi-shop me-2"></i>View Store
                </a>
                <a href="{{ route('logout') }}" class="btn btn-danger w-100"
                   onclick="event.preventDefault(); document.getElementById('logout-form-seller').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
            </div>
        </nav>
    </div>
</div>

<style>
    .seller-nav .nav-link {
        position: relative;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .seller-nav .nav-link:hover {
        color: var(--chocolate-gold) !important;
    }
    .seller-nav .nav-link.active {
        color: var(--chocolate-gold) !important;
        font-weight: 600;
    }
    .seller-nav .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 3px;
        background: var(--chocolate-gold);
        border-radius: 2px;
    }
    #sellerMobileMenu .nav-link.active {
        background: rgba(212, 175, 55, 0.2);
        color: var(--chocolate-gold) !important;
        border-left: 4px solid var(--chocolate-gold) !important;
    }
    #sellerMobileMenu .nav-link:hover {
        background: rgba(255, 255, 255, 0.05);
    }
</style>
