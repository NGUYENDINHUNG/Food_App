<!-- Total Amount -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="alert alert-info mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Lưu ý:</strong> Chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng trong vòng 30 phút.
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="bg-light p-3 rounded">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính:</span>
                        <span>{{ number_format($order->total_amount) }}đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển:</span>
                        <span class="text-success">Miễn phí</span>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between">
                        <strong>Tổng cộng:</strong>
                        <strong class="text-success fs-4">{{ number_format($order->total_amount) }}đ</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="text-center">
    <div class="d-flex gap-3 justify-content-center flex-wrap">
        <a href="{{ route('ordersHistory.index') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-history me-2"></i>Xem lịch sử đơn hàng
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
            <i class="fas fa-home me-2"></i>Về trang chủ
        </a>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-success btn-lg">
            <i class="fas fa-utensils me-2"></i>Tiếp tục mua sắm
        </a>
    </div>
</div>
