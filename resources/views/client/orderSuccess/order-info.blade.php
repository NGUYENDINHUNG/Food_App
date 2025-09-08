@use('Illuminate\Support\Facades\Storage')
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
                    <i class="fas fa-info-circle me-2"></i>Thông tin đơn hàng
                </h6>
                <div class="mb-2"><strong>Mã đơn hàng:</strong>
                    <span class="badge bg-primary fs-6">#{{ $order->id }}</span>
                </div>
                <div class="mb-2"><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</div>
                <div class="mb-2"><strong>Trạng thái:</strong>
                    <span class="badge bg-warning fs-6">Chờ xử lý</span>
                </div>
                <div class="mb-2"><strong>Phương thức thanh toán:</strong>
                    @if ($order->payment_method === 'cod')
                        <i class="fas fa-money-bill-wave text-success me-1"></i>Thanh toán khi nhận hàng
                    @else
                        <i class="fas fa-university text-primary me-1"></i>Chuyển khoản ngân hàng
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold text-primary mb-3">
                    <i class="fas fa-map-marker-alt me-2"></i>Địa chỉ giao hàng
                </h6>
                <p class="mb-0">{{ $order->shipping_address }}</p>
                @if ($order->note)
                    <hr>
                    <h6 class="fw-bold text-primary mb-2">
                        <i class="fas fa-sticky-note me-2"></i>Ghi chú
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
        <h5 class="mb-0"><i class="fas fa-shopping-bag me-2"></i>Sản phẩm đã đặt</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-end">Đơn giá</th>
                        <th class="text-end">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($detail->food->image)
                                        <img src="{{ $detail->food->image_url }}" class="rounded me-3"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-utensils text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-medium">{{ $detail->food->name }}</div>
                                        @if ($detail->note)
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
