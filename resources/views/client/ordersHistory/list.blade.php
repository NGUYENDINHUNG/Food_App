@if ($orders->count() > 0)
<div class="row">
    @foreach ($orders as $order)
        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">
                                <i class="fas fa-receipt text-primary me-2"></i>
                                Đơn hàng #{{ $order->id }}
                            </h5>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <div class="col-md-6 text-end">
                            <span
                                class="badge fs-6 px-3 py-2
                                @if ($order->status === 'pending') bg-warning
                                @elseif($order->status === 'processing') bg-info
                                @elseif($order->status === 'shipped') bg-primary
                                @elseif($order->status === 'delivered') bg-success
                                @elseif($order->status === 'cancelled') bg-danger
                                @else bg-secondary @endif">
                                @switch($order->status)
                                    @case('pending')
                                        Chờ xử lý
                                    @break

                                    @case('processing')
                                        Đang xử lý
                                    @break

                                    @case('shipped')
                                        Đã giao
                                    @break

                                    @case('delivered')
                                        Hoàn thành
                                    @break

                                    @case('cancelled')
                                        Đã hủy
                                    @break

                                    @default
                                        {{ $order->status }}
                                @endswitch
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Order Items -->
                    <div class="table-responsive mb-3">
                        <table class="table table-sm">
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
                                                <img src="{{ $detail->food->image}}" 
                                                        class="rounded me-2"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-utensils text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-medium">{{ $detail->food->name }}
                                                    </div>
                                                    @if ($detail->note)
                                                        <small
                                                            class="text-muted">{{ $detail->note }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $detail->quantity }}</td>
                                        <td class="text-end">{{ number_format($detail->unit_price) }}đ
                                        </td>
                                        <td class="text-end fw-bold">
                                            {{ number_format($detail->total_price) }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Order Summary -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <strong>Địa chỉ giao hàng:</strong>
                                    <p class="text-muted mb-1">{{ $order->shipping_address }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <strong>Phương thức thanh toán:</strong>
                                    <p class="text-muted mb-1">
                                        @if ($order->payment_method === 'cod')
                                            <i class="fas fa-money-bill-wave text-success me-1"></i>
                                            Thanh toán khi nhận hàng
                                        @else
                                            <i class="fas fa-university text-primary me-1"></i>
                                            Chuyển khoản ngân hàng
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if ($order->note)
                                <div class="mt-2">
                                    <strong>Ghi chú:</strong>
                                    <p class="text-muted mb-0">{{ $order->note }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tạm tính:</span>
                                    <span>{{ number_format($order->total_amount) }}đ</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Phí vận chuyển:</span>
                                    <span>0đ</span>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between">
                                    <strong>Tổng cộng:</strong>
                                    <strong
                                        class="text-primary fs-5">{{ number_format($order->total_amount) }}đ</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                <i class="fas fa-credit-card me-1"></i>
                                Trạng thái thanh toán:
                                <span
                                    class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $order->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                </span>
                            </small>
                        </div>
                        <div>
                            @if ($order->status === 'pending')
                                <button class="btn btn-sm btn-outline-danger"
                                    wire:click="cancelOrder({{ $order->id }})"
                                    wire:confirm="Bạn có chắc muốn hủy đơn hàng này?">
                                    <i class="fas fa-times me-1"></i>
                                    Hủy đơn hàng
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center">
    {{ $orders->links() }}
</div>
@else
<div class="text-center py-5">
    <div class="mb-4">
        <i class="fas fa-shopping-bag text-muted" style="font-size: 4rem;"></i>
    </div>
    <h4 class="text-muted">Chưa có đơn hàng nào</h4>
    <p class="text-muted mb-4">Bạn chưa có đơn hàng nào trong lịch sử</p>
    <a href="{{ route('home') }}" class="btn btn-primary">
        <i class="fas fa-shopping-cart me-2"></i>
        Bắt đầu mua sắm
    </a>
</div>
@endif