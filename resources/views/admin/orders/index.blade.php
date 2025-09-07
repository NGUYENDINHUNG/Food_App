<div>
    @include('admin.orders.header')

    <div class="card">
        <div class="card-body p-0">
            @include('admin.orders.table', ['orders' => $orders])
        </div>

        @if ($orders->hasPages())
            <div class="card-footer">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
