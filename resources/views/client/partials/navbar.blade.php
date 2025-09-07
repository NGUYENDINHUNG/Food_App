<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="140">
        </a>

        <!-- Nút thu gọn (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="Chuyển đổi điều hướng">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto gap-3">
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">Thực đơn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#footer">Liên hệ</a>
                </li>
            </ul>

            <!-- Khu vực bên phải -->
            <div class="d-flex align-items-center gap-3">
                <!-- Giỏ hàng -->
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-sm position-relative"
                    aria-label="Giỏ hàng">
                    <i class="bi bi-bag"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        @php
                            $count = 0;
                            if (Auth::check()) {
                                $count =
                                    optional(
                                        \App\Models\Cart::withCount('cartDetails')
                                            ->where('user_id', Auth::id())
                                            ->first(),
                                    )->cart_details_count ?? 0;
                            }
                        @endphp
                        {{ $count }}
                    </span>
                </a>

                @guest
                    <a href="{{ route('auth.login') }}" class="btn btn-outline-primary btn-sm">Đăng nhập</a>
                    <a href="{{ route('auth.register') }}" class="btn btn-primary btn-sm">Đăng ký</a>
                @endguest

                @auth
                    <div class="dropdown">
                        <a class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center gap-2" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-sm-inline">{{ Str::limit(Auth::user()->name, 16) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2"
                                    href="{{ route('ordersHistory.index') }}">
                                    <i class="bi bi-bag"></i> Đơn hàng của tôi
                                </a>
                            </li>
                            @if (Auth::user()->role === 'Admin')
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('/admin') }}">
                                        <i class="bi bi-speedometer2"></i> Quản trị
                                    </a>
                                </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="post" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <button class="dropdown-item d-flex align-items-center gap-2">
                                        <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
