<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-truck me-2"></i>
            Thông tin giao hàng
        </h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="placeOrder">
            <div class="mb-3">
                <label for="shippingAddress" class="form-label">
                    Địa chỉ giao hàng <span class="text-danger">*</span>
                </label>
                <textarea wire:model="shippingAddress" 
                          id="shippingAddress" 
                          class="form-control @error('shippingAddress') is-invalid @enderror" 
                          rows="3" 
                          placeholder="Nhập địa chỉ giao hàng chi tiết..."></textarea>
                @error('shippingAddress')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Phương thức thanh toán <span class="text-danger">*</span>
                </label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input wire:model="paymentMethod" 
                                   class="form-check-input" 
                                   type="radio" 
                                   value="cod" 
                                   id="cod">
                            <label class="form-check-label" for="cod">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input wire:model="paymentMethod" 
                                   class="form-check-input" 
                                   type="radio" 
                                   value="bank_transfer" 
                                   id="bank_transfer">
                            <label class="form-check-label" for="bank_transfer">
                                <i class="fas fa-university me-2"></i>
                                Chuyển khoản ngân hàng
                            </label>
                        </div>
                    </div>
                </div>
                @error('paymentMethod')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Ghi chú đơn hàng</label>
                <textarea wire:model="note" 
                          id="note" 
                          class="form-control @error('note') is-invalid @enderror" 
                          rows="2" 
                          placeholder="Ghi chú thêm cho đơn hàng (tùy chọn)..."></textarea>
                @error('note')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </form>
    </div>
</div>
