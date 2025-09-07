<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Tìm theo mã đơn hàng..."
                        wire:model.live.debounce.300ms="searchTerm">
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-2 flex-wrap">
                    <button
                        class="btn btn-sm {{ $statusFilter === '' ? 'btn-primary' : 'btn-outline-primary' }}"
                        wire:click="clearFilter">
                        Tất cả
                    </button>
                    <button
                        class="btn btn-sm {{ $statusFilter === 'pending' ? 'btn-warning' : 'btn-outline-warning' }}"
                        wire:click="filterByStatus('pending')">
                        Chờ xử lý
                    </button>
                    <button
                        class="btn btn-sm {{ $statusFilter === 'processing' ? 'btn-info' : 'btn-outline-info' }}"
                        wire:click="filterByStatus('processing')">
                        Đang xử lý
                    </button>
                    <button
                        class="btn btn-sm {{ $statusFilter === 'shipped' ? 'btn-primary' : 'btn-outline-primary' }}"
                        wire:click="filterByStatus('shipped')">
                        Đã giao
                    </button>
                    <button
                        class="btn btn-sm {{ $statusFilter === 'delivered' ? 'btn-success' : 'btn-outline-success' }}"
                        wire:click="filterByStatus('delivered')">
                        Hoàn thành
                    </button>
                    <button
                        class="btn btn-sm {{ $statusFilter === 'cancelled' ? 'btn-danger' : 'btn-outline-danger' }}"
                        wire:click="filterByStatus('cancelled')">
                        Đã hủy
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
