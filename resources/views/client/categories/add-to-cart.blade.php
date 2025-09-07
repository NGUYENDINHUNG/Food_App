@auth
    <div class="mt-2">
        <div class="row align-items-center g-2">
            <div class="col-5">
                <label class="form-label small mb-1">Số lượng:</label>
                <input type="number" class="form-control form-control-sm"
                       wire:model="quantity" min="1" max="{{ $food->quantity ?? 0 }}">
            </div>
            <div class="col-7">
                <button class="btn btn-success btn-sm w-100 rounded-pill"
                        wire:click="addToCart">
                    <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                </button>
            </div>
        </div>
    </div>
@else
    <a href="{{ route('auth.login') }}"
       class="btn btn-primary btn-sm w-100 rounded-pill d-flex justify-content-center align-items-center">
        <i class="fas fa-sign-in-alt me-1"></i> Đăng nhập
    </a>
@endauth