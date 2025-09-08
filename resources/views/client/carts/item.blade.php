@use('Illuminate\Support\Facades\Storage')
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top">
        <h5 class="mb-0">
            <i class="fas fa-shopping-cart me-2"></i> Sản phẩm trong giỏ
        </h5>
        <button class="btn btn-light btn-sm text-danger fw-bold" wire:click="clearCart"
            wire:confirm="Bạn có chắc muốn xóa toàn bộ giỏ hàng?">
            <i class="fas fa-trash me-1"></i> Xóa tất cả
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="70">Ảnh</th>
                        <th>Tên món</th>
                        <th width="130">Đơn giá</th>
                        <th width="160">Số lượng</th>
                        <th width="140">Thành tiền</th>
                        <th width="90">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($cart->cartDetails as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->food->image_url }}" alt="{{ $item->food->name }}"
                                    class="rounded shadow-sm" width="55" height="55" style="object-fit: cover;">
                            </td>
                            <td class="text-start">
                                <h6 class="mb-1 fw-semibold">{{ $item->food->name }}</h6>
                                <small class="text-muted d-block">{{ $item->food->description }}</small>
                                <small class="badge mt-1 {{ $item->food->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                    Còn {{ $item->food->quantity }} sp
                                </small>
                            </td>
                            <td>
                                <span class="fw-bold text-primary">
                                    {{ number_format($item->unit_price) }}đ
                                </span>
                            </td>
                            <td>
                                <div class="input-group input-group-sm quantity-group" style="width: 120px;">
                                    <button class="btn btn-outline-secondary" type="button"
                                        wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input type="number" class="form-control text-center" value="{{ $item->quantity }}"
                                        min="1" max="{{ $item->food->quantity }}"
                                        wire:change="updateQuantity({{ $item->id }}, $event.target.value)">

                                    <button class="btn btn-outline-secondary" type="button"
                                        wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-success fs-6">
                                    {{ number_format($item->quantity * $item->unit_price) }}đ
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger btn-sm rounded-circle"
                                    wire:click="removeFromCart({{ $item->id }})"
                                    wire:confirm="Bạn có chắc muốn xóa sản phẩm này?" title="Xóa khỏi giỏ hàng">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
