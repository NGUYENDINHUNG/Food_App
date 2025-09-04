<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'FoodApp')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
                <span class="me-2">🍽️</span> FoodApp
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}"
                            href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('foods*') ? 'active fw-semibold' : '' }}"
                            href="">Món ăn</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('orders*') ? 'active fw-semibold' : '' }}"
                                href="">Đơn của tôi</a>
                        </li>
                    @endauth
                </ul>
                @auth
                    <ul class="navbar-nav align-items-center ms-auto gap-2">
                        <li class="nav-item">
                            <a class="btn btn-outline-light btn-sm position-relative" href=""
                                title="Giỏ hàng">
                                <i class="bi bi-bag"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                    {{ session('cart') ? count(session('cart')) : 0 }}
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="btn btn-outline-light btn-sm" href="" title="Thông báo">
                                <i class="bi bi-bell"></i>
                            </a>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item dropdown list-unstyled">
                            <a class="btn btn-outline-light btn-sm d-flex align-items-center gap-2 dropdown-toggle"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                title="Tài khoản">
                                <i class="bi bi-person"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('auth.login') }}">
                                
                                        <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2"
                                        href="{{ route('auth.register') }}">
                                        <i class="bi bi-person-plus"></i> Đăng ký
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown list-unstyled">
                            <a class="btn btn-outline-light btn-sm d-flex align-items-center gap-2 dropdown-toggle"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <span
                                    class="d-none d-sm-inline">{{ Str::limit(Auth::user()->name, 16) }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li><a class="dropdown-item d-flex align-items-center gap-2"
                                        href="{{ url('/profile') }}"><i class="bi bi-gear"></i> Hồ sơ</a></li>
                                @if (Auth::user()->isadmin ?? false)
                                    <li><a class="dropdown-item d-flex align-items-center gap-2"
                                            href="{{ url('/admin') }}"><i class="bi bi-speedometer2"></i> Quản trị</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="post" action="{{ route('auth.logout') }}" class="px-3">@csrf
                                        <button
                                            class="btn btn-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                                            <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-white border-bottom">

    </header>

    <main class="container my-4 flex-grow-1">

        @yield('content')
    </main>

    <footer class="bg-white border-top">
        <div class="container py-3 d-flex justify-content-between">
            <small class="text-muted">© {{ date('Y') }} FoodApp</small>
            <div class="d-flex gap-3 small"><a class="link-secondary" href="#">Điều khoản</a><a
                    class="link-secondary" href="#">Bảo mật</a><a class="link-secondary" href="#">Liên
                    hệ</a></div>
        </div>
    </footer>
    @stack('scripts')
</body>

</html>
