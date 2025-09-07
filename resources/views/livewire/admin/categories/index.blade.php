<div>
    <div class="d-flex justify-content-between align-items-center my-3">
        <h4 class="mb-0">Danh mục</h4>
        <button class="btn btn-primary btn-sm" wire:click="create">Thêm danh mục</button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Bảng danh mục --}}
    @include('livewire.admin.categories.table', ['categories' => $categories])

    {{-- Form thêm/sửa --}}
    @if ($showModal)
        @include('livewire.admin.categories.form')
    @endif
</div>
