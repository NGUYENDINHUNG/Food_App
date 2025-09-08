<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên món</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($foods as $food)
                        <tr>
                            <td>{{ $food->id }}</td>
                            <td>
                                @if ($food->image)
                                    <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="img-thumbnail"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $food->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $food->slug }}</small>
                            </td>
                            <td>
                                @if ($food->category)
                                    <span class="badge bg-info">{{ $food->category->name }}</span>
                                @else
                                    <span class="text-muted">Chưa phân loại</span>
                                @endif
                            </td>
                            <td>
                                <strong class="text-success">{{ number_format($food->price, 0, ',', '.') }}đ</strong>
                            </td>
                            <td>
                                <span class="badge {{ $food->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $food->quantity ?? 0 }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit($food->description, 50) }}</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-outline-primary" wire:click="edit({{ $food->id }})"
                                        title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" wire:click="delete({{ $food->id }})"
                                        wire:confirm="Bạn có chắc chắn muốn xóa món ăn này?" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-utensils fa-2x mb-2"></i>
                                <br>
                                Chưa có món ăn nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
