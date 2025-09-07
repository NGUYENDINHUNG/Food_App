<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-shopping-cart me-2"></i>
                Giỏ hàng của bạn
            </h2>
        </div>
    </div>

    @if ($cart && $cart->cartDetails->count() > 0)
        <div class="row">
            <div class="col-lg-8">
                @include('livewire.client.carts.item', ['cart' => $cart])
            </div>
            <div class="col-lg-4">
                @include('livewire.client.carts.summary', ['cart' => $cart])
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <h4>Giỏ hàng trống</h4>
            <p>Bạn chưa có sản phẩm nào trong giỏ hàng</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Bắt đầu mua sắm</a>
        </div>
    @endif
</div>
