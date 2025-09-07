<div class="card sticky-top" style="top: 20px;">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-calculator me-2"></i>
            Tổng kết đơn hàng
        </h5>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <span>Tạm tính:</span>
            <span>{{ number_format($totalAmount) }}đ</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span>Phí vận chuyển:</span>
            <span class="text-success">Miễn phí</span>
        </div>
        <hr>
        <div class="d-flex justify-content-between mb-3">
            <strong>Tổng cộng:</strong>
            <strong class="text-primary fs-5">{{ number_format($totalAmount) }}đ</strong>
        </div>

        <div class="d-grid gap-2">
            <button wire:click="placeOrder" 
                    wire:loading.attr="disabled" 
                    class="btn btn-primary btn-lg" 
                    @if($isProcessing) disabled @endif>
                <span wire:loading.remove wire:target="placeOrder">
                    <i class="fas fa-credit-card me-2"></i>
                    Đặt hàng
                </span>
                <span wire:loading wire:target="placeOrder">
                    <i class="fas fa-spinner fa-spin me-2"></i>
                    Đang xử lý...
                </span>
            </button>
            
            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Quay lại giỏ hàng
            </a>
            
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="fas fa-home me-2"></i>
                Tiếp tục mua sắm
            </a>
        </div>

        @if($paymentMethod === 'bank_transfer')
            <div class="mt-3 p-3 bg-light rounded">
                <h6 class="text-primary mb-2">
                    <i class="fas fa-info-circle me-2"></i>
                    Thông tin chuyển khoản
                </h6>
                <small class="text-muted">
                    Sau khi đặt hàng, bạn sẽ nhận được thông tin chuyển khoản qua email.
                </small>
            </div>
        @endif
    </div>
</div>
