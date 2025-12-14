<!-- Buyer Navbar Component -->
<nav class="buyer-nav sticky-top" style="background: linear-gradient(90deg, var(--chocolate-dark) 0%, #3D2A1E 100%); border-bottom: 3px solid var(--chocolate-gold);">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between py-2">
            <!-- Logo/Brand -->
            <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center">
                <span class="fs-4 fw-bold" style="color: var(--chocolate-gold); font-family: 'Playfair Display', serif;">
                    🍫 ChocoLuxe
                </span>
            </a>

            <!-- Desktop Navigation -->
            <ul class="nav d-none d-lg-flex align-items-center mb-0">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link px-3 text-white {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="bi bi-house me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link px-3 text-white {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="bi bi-grid me-1"></i>Products
                    </a>
                </li>
                @auth
                    @if(auth()->user()->role === 'buyer')
                    <li class="nav-item">
                        <a href="{{ route('buyer.dashboard') }}" class="nav-link px-3 text-white {{ request()->routeIs('buyer.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('buyer.orders') }}" class="nav-link px-3 text-white {{ request()->routeIs('buyer.orders*') ? 'active' : '' }}">
                            <i class="bi bi-receipt me-1"></i>My Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('buyer.wishlist') }}" class="nav-link px-3 text-white {{ request()->routeIs('buyer.wishlist') ? 'active' : '' }}">
                            <i class="bi bi-heart me-1"></i>Wishlist
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('buyer.cart') }}" class="nav-link px-3 text-white position-relative {{ request()->routeIs('buyer.cart') ? 'active' : '' }}">
                            <i class="bi bi-cart3 me-1"></i>Cart
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                            @endphp
                            @if($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background: var(--chocolate-gold); color: var(--chocolate-dark); font-size: 0.7rem;">
                                {{ $cartCount > 9 ? '9+' : $cartCount }}
                            </span>
                            @endif
                        </a>
                    </li>
                    @endif
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('buyer.addresses') }}">
                                    <i class="bi bi-geo-alt me-2"></i>Addresses
                                </a>
                            </li>
                            @if(auth()->user()->role === 'seller')
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('seller.dashboard') }}">
                                    <i class="bi bi-shop me-2"></i>Seller Dashboard
                                </a>
                            </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form-buyer').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                                <form id="logout-form-buyer" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link px-3 text-white">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-sm ms-2" style="background: var(--chocolate-gold); color: var(--chocolate-dark);">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                    </li>
                @endauth
            </ul>

            <!-- Mobile Toggle -->
            <button class="btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#buyerMobileMenu" style="color: var(--chocolate-gold);">
                <i class="bi bi-list fs-3"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Offcanvas Menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="buyerMobileMenu" style="background: var(--chocolate-dark);">
    <div class="offcanvas-header border-bottom" style="border-color: var(--chocolate-gold) !important;">
        <h5 class="offcanvas-title" style="color: var(--chocolate-gold); font-family: 'Playfair Display', serif;">
            🍫 ChocoLuxe
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <nav class="nav flex-column">
            <a href="{{ route('home') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('home') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-house me-2"></i>Home
            </a>
            <a href="{{ route('products.index') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('products.*') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-grid me-2"></i>Products
            </a>
            @auth
                @if(auth()->user()->role === 'buyer')
                <a href="{{ route('buyer.dashboard') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('buyer.dashboard') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
                <a href="{{ route('buyer.orders') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('buyer.orders*') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                    <i class="bi bi-receipt me-2"></i>My Orders
                </a>
                <a href="{{ route('buyer.wishlist') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('buyer.wishlist') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                    <i class="bi bi-heart me-2"></i>Wishlist
                </a>
                <a href="{{ route('buyer.cart') }}" class="nav-link py-3 px-4 text-white border-bottom {{ request()->routeIs('buyer.cart') ? 'active' : '' }}" style="border-color: rgba(255,255,255,0.1) !important;">
                    <i class="bi bi-cart3 me-2"></i>Cart
                </a>
                @endif
                <a href="{{ route('profile') }}" class="nav-link py-3 px-4 text-white border-bottom" style="border-color: rgba(255,255,255,0.1) !important;">
                    <i class="bi bi-person me-2"></i>Profile
                </a>
                <a href="{{ route('buyer.addresses') }}" class="nav-link py-3 px-4 text-white border-bottom" style="border-color: rgba(255,255,255,0.1) !important;">
                    <i class="bi bi-geo-alt me-2"></i>Addresses
                </a>
                @if(auth()->user()->role === 'seller')
                <a href="{{ route('seller.dashboard') }}" class="nav-link py-3 px-4 text-white border-bottom" style="border-color: rgba(255,255,255,0.1) !important;">
                    <i class="bi bi-shop me-2"></i>Seller Dashboard
                </a>
                @endif
            @endauth
            <div class="p-3 mt-auto">
                @auth
                <a href="{{ route('logout') }}" class="btn btn-danger w-100"
                   onclick="event.preventDefault(); document.getElementById('logout-form-buyer').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline-light w-100 mb-2">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </a>
                <a href="{{ route('register') }}" class="btn w-100" style="background: var(--chocolate-gold); color: var(--chocolate-dark);">
                    <i class="bi bi-person-plus me-2"></i>Register
                </a>
                @endauth
            </div>
        </nav>
    </div>
</div>

<style>
    .buyer-nav .nav-link {
        position: relative;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .buyer-nav .nav-link:hover {
        color: var(--chocolate-gold) !important;
    }
    .buyer-nav .nav-link.active {
        color: var(--chocolate-gold) !important;
        font-weight: 600;
    }
    .buyer-nav .nav-link.active::after {
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
    #buyerMobileMenu .nav-link.active {
        background: rgba(212, 175, 55, 0.2);
        color: var(--chocolate-gold) !important;
        border-left: 4px solid var(--chocolate-gold) !important;
    }
    #buyerMobileMenu .nav-link:hover {
        background: rgba(255, 255, 255, 0.05);
    }
</style>
