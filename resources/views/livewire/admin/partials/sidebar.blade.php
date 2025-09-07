<nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse min-vh-100 shadow">
    <div class="d-flex flex-column h-100 position-sticky pt-3">

        {{-- Logo / Brand --}}
        <div class="text-center mb-4">
            <i class="bi bi-shop text-white fs-1"></i>
            <h5 class="text-white mt-2">Admin Panel</h5>
            <small class="text-muted">Quản lý hệ thống</small>
        </div>

        {{-- Menu --}}
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : 'hover-link' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.categories') ? 'active bg-primary' : 'hover-link' }}"
                    href="{{ route('admin.categories') }}">
                    <i class="bi bi-tags me-2"></i> Danh mục
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('admin.foods') ? 'active bg-primary' : 'hover-link' }}"
                    href="{{ route('admin.foods') }}">
                    <i class="bi bi-egg-fried me-2"></i> Món ăn
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white hover-link" href="#">
                    <i class="bi bi-receipt me-2"></i> Đơn hàng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white hover-link" href="#">
                    <i class="bi bi-people me-2"></i> Người dùng
                </a>
            </li>
        </ul>

        <hr class="text-white">

        {{-- Bottom Menu --}}
        <ul class="nav flex-column mt-auto">
            <li class="nav-item">
                <a class="nav-link text-white hover-link" href="{{ route('home') }}">
                    <i class="bi bi-house me-2"></i> Về trang chủ
                </a>
            </li>
            <li class="nav-item">
                <form method="post" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-white btn btn-link p-0 text-start w-100 hover-link">
                        <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
