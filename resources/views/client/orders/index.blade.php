<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-credit-card me-2"></i>
                Thanh toán đơn hàng
            </h2>
        </div>
    </div>


    @if ($cart && $cart->cartDetails->count() > 0)
        <div class="row">
            <div class="col-lg-8">
                @include('client.carts.item', ['cart' => $cart])
                @include('client.orders.shipping')
            </div>
            <div class="col-lg-4">
                @include('client.orders.summary')
            </div>
        </div>
    @else
    @endif
</div>
