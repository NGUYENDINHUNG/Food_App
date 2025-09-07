<div>
    <div class="row">
        @include('admin.dashboard.stats', [
            'totalCategories' => $totalCategories,
            'totalFoods' => $totalFoods,
            'totalOrders' => $totalOrders,
        ])
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('admin.dashboard.recent-orders', ['recentOrders' => $recentOrders])
        </div>
    </div>
</div>
