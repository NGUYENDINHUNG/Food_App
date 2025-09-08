
<table class="table table-hover align-middle">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Ảnh</th>
            <th class="text-end">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->name }}</td>
                <td>
                    <img src="{{ $c->image_url }}" width="60" alt="{{ $c->name }}">
                </td>
                <td class="text-end">
                    <button class="btn btn-outline-secondary btn-sm" wire:click="edit({{ $c->id }})">Sửa</button>
                    <button class="btn btn-outline-danger btn-sm" wire:click="delete({{ $c->id }})"
                        onclick="return confirm('Xóa danh mục?')">Xóa</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">Chưa có danh mục nào.</td>
            </tr>
        @endforelse
    </tbody>
</table>
