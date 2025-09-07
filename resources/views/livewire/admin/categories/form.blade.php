<div class="card p-3">
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Tên</label>
            <input type="text" class="form-control" wire:model.defer="name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- <div class="col-md-6">
            <label class="form-label">Ảnh</label>
            <input type="file" class="form-control" wire:model="image">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div> --}}

        <div class="col-md-6">
            <label class="form-label">Ảnh</label>
            <input type="file" class="form-control" wire:model="image">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            {{-- Hiện ảnh cũ khi đang edit và chưa chọn ảnh mới --}}
            @if ($currentImage && !$image)
                <div class="mt-2">
                    <img src="{{ $currentImage }}" alt="Ảnh hiện tại" class="rounded border" width="120">
                </div>
            @endif

            {{-- Preview ảnh mới khi người dùng chọn file --}}
            @if ($image)
                <div class="mt-2">
                    <img src="{{ $image->temporaryUrl() }}" alt="Ảnh mới" class="rounded border" width="120">
                </div>
            @endif
        </div>
        <div class="col-12">
            <label class="form-label">Mô tả</label>
            <textarea class="form-control" rows="3" wire:model.defer="description"></textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" wire:click="save">Lưu</button>
            <button class="btn btn-light" wire:click="resetForm">Hủy</button>
        </div>
    </div>
</div>
