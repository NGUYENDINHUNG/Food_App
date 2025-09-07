<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th class="border-0">Mã đơn</th>
                <th class="border-0">Khách hàng</th>
                <th class="border-0">Tổng tiền</th>
                <th class="border-0">Trạng thái</th>
                <th class="border-0">Ngày đặt</th>
                <th class="border-0 text-center">Thao tác</th>
                <th class="border-0 text-center">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>
                        <div class="fw-medium">#{{ $order->id }}</div>
                        <small class="text-muted">{{ $order->orderDetails->count() }} sản phẩm</small>
                    </td>
                    <td>
                        <div class="fw-medium">{{ $order->user->name }}</div>
                        <small class="text-muted">{{ $order->user->email }}</small>
                    </td>
                    <td>
                        <div class="fw-bold text-primary">{{ number_format($order->total_amount) }}đ</div>
                    </td>
                    <td>
                        <span class="badge bg-{{ $this->getStatusColor($order->status) }}">
                            {{ $this->getStatusText($order->status) }}
                        </span>
                    </td>
                    <td>
                        <div>{{ $order->created_at->format('d/m/Y') }}</div>
                        <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                    </td>
                    <td class="text-center">
                        @if ($order->status === 'pending')
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-success" wire:click="confirmOrder({{ $order->id }})"
                                    wire:confirm="Xác nhận đơn hàng này?">
                                    <i class="fas fa-check me-1"></i>
                                    Xác nhận
                                </button>
                                <button class="btn btn-sm btn-danger" wire:click="cancelOrder({{ $order->id }})"
                                    wire:confirm="Hủy đơn hàng này?">
                                    <i class="fas fa-times me-1"></i>
                                    Hủy
                                </button>
                            </div>
                        @else
                            <span class="text-muted">Đã xử lý</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $order->id }})"
                            wire:confirm="Xóa đơn hàng này?">
                            <i class="fas fa-trash me-1"></i>
                            Xóa
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <div class="text-muted">
                            <i class="fas fa-inbox fa-2x mb-3"></i>
                            <div>Không có đơn hàng nào</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
