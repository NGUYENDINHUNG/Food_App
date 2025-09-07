<div class="container py-4">
    <div class="row">
        <div class="col-12">

            {{-- Header --}}
            @include('client.ordersHistory.header')

            {{-- Filter --}}
            @include('client.ordersHistory.filter')

            {{-- Orders List --}}
            @include('client.ordersHistory.list', ['orders' => $orders])

        </div>
    </div>
</div>
