<div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Success Header -->
            <div class="text-center mb-5">
                <div class="mb-4">
                    <div class="success-icon mx-auto d-flex align-items-center justify-content-center rounded-circle bg-success text-white mb-3" 
                         style="width: 80px; height: 80px; font-size: 2.5rem;">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                <h1 class="display-6 fw-bold text-success mb-3">Đặt hàng thành công!</h1>
                <p class="lead text-muted">Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.</p>
            </div>

            <!-- Order Summary Card -->
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-receipt me-2"></i>
                        Thông tin đơn hàng #{{ $order->id }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Thông tin đơn hàng
                            </h6>
                            <div class="mb-2">
                                <strong>Mã đơn hàng:</strong> 
                                <span class="badge bg-primary fs-6">#{{ $order->id }}</span>
                            </div>
                            <div class="mb-2">
                                <strong>Ngày đặt:</strong> 
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </div>
                            <div class="mb-2">
                                <strong>Trạng thái:</strong> 
                                <span class="badge bg-warning fs-6">Chờ xử lý</span>
                            </div>
                            <div class="mb-2">
                                <strong>Phương thức thanh toán:</strong> 
                                @if($order->payment_method === 'cod')
                                    <i class="fas fa-money-bill-wave text-success me-1"></i>
                                    Thanh toán khi nhận hàng
                                @else
                                    <i class="fas fa-university text-primary me-1"></i>
                                    Chuyển khoản ngân hàng
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                Địa chỉ giao hàng
                            </h6>
                            <p class="mb-0">{{ $order->shipping_address }}</p>
                            @if($order->note)
                                <hr>
                                <h6 class="fw-bold text-primary mb-2">
                                    <i class="fas fa-sticky-note me-2"></i>
                                    Ghi chú
                                </h6>
                                <p class="mb-0">{{ $order->note }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-shopping-bag me-2"></i>
                        Sản phẩm đã đặt
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">Sản phẩm</th>
                                    <th class="border-0 text-center">Số lượng</th>
                                    <th class="border-0 text-end">Đơn giá</th>
                                    <th class="border-0 text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $detail)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($detail->food->image)
                                                    <img src="{{ asset('storage/' . $detail->food->image) }}" 
                                                         class="rounded me-3" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-utensils text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-medium">{{ $detail->food->name }}</div>
                                                    @if($detail->note)
                                                        <small class="text-muted">{{ $detail->note }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary fs-6">{{ $detail->quantity }}</span>
                                        </td>
                                        <td class="text-end">{{ number_format($detail->unit_price) }}đ</td>
                                        <td class="text-end fw-bold text-primary">{{ number_format($detail->total_price) }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
                        <i class="fas fa-history me-2"></i>
                        Xem lịch sử đơn hàng
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-home me-2"></i>
                        Về trang chủ
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-success btn-lg">
                        <i class="fas fa-utensils me-2"></i>
                        Tiếp tục mua sắm
                    </a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="text-center mt-5">
                <div class="card border-0 bg-light">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-headset me-2"></i>
                            Cần hỗ trợ?
                        </h6>
                        <p class="text-muted mb-0">
                            Nếu bạn có bất kỳ câu hỏi nào về đơn hàng, vui lòng liên hệ với chúng tôi qua hotline: 
                            <strong class="text-primary">1900-xxxx</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.success-icon {
    animation: bounceIn 0.6s ease-out;
}

@keyframes bounceIn {
    0% {
        transform: scale(0.3);
        opacity: 0;
    }
    50% {
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
</style>
</div>