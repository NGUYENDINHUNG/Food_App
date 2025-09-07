<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tổng kết đơn hàng</h5>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <span>Tạm tính:</span>
            <span>{{ number_format($cart->cartDetails->sum(fn($item) => $item->quantity * $item->unit_price)) }}đ</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span>Phí vận chuyển:</span>
            <span class="text-success">Miễn phí</span>
        </div>
        <hr>
        <div class="d-flex justify-content-between mb-3">
            <strong>Tổng cộng:</strong>
            <strong class="text-primary fs-5">
                {{ number_format($cart->cartDetails->sum(fn($item) => $item->quantity * $item->unit_price)) }}đ
            </strong>

        </div>

        <div class="d-grid gap-2">
            <a href="{{ route('orders.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-credit-card me-2"></i>
                Thanh toán
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
</div>
