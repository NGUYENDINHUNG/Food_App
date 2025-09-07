<div>
    <div class="d-flex justify-content-between align-items-center my-3">
        <h4 class="mb-0">Quản lý món ăn</h4>
        <button class="btn btn-primary btn-sm" wire:click="create">
            <i class="fas fa-plus"></i> Thêm món ăn
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Bảng món ăn --}}
    @include('livewire.admin.foods.table', ['foods' => $foods])

    {{-- Form thêm/sửa --}}
    @if ($showModal)
        @include('livewire.admin.foods.form')
    @endif
</div>