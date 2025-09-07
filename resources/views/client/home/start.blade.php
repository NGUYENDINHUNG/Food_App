<section class="py-5 bg-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-item">
                    <div class="stat-number text-primary fw-bold fs-1">{{ \App\Models\Category::count() }}</div>
                    <div class="stat-label text-muted">Danh mục</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-item">
                    <div class="stat-number text-success fw-bold fs-1">{{ \App\Models\Food::count() }}</div>
                    <div class="stat-label text-muted">Món ăn</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-item">
                    <div class="stat-number text-warning fw-bold fs-1">{{ \App\Models\Order::count() }}</div>
                    <div class="stat-label text-muted">Đơn hàng</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-item">
                    <div class="stat-number text-info fw-bold fs-1">{{ \App\Models\User::count() }}</div>
                    <div class="stat-label text-muted">Khách hàng</div>
                </div>
            </div>
        </div>
    </div>
</section>