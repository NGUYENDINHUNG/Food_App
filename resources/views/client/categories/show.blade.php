@extends('layouts.client')
@section('title', $category->name)

@section('content')
    <h4 class="mb-3 fw-bold text-primary">{{ $category->name }}</h4>
    <p class="text-muted">{{ $category->description }}</p>

    <div class="row g-3 mt-3">
        @forelse($foods as $f)
            <div class="col-6 col-md-3">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                    <div class="ratio ratio-4x3">
                        <img src="{{ $f->image_url }}" class="card-img-top" alt="{{ $f->name }}"
                            style="object-fit: cover;">
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-semibold mb-1 text-truncate" title="{{ $f->name }}">
                            {{ $f->name }}
                        </h6>

                        <small class="text-muted d-block mb-2">
                            {{ number_format($f->price, 0, ',', '.') }}đ
                        </small>

                        <span class="badge {{ $f->quantity > 0 ? 'bg-success' : 'bg-danger' }} mb-3">
                            {{ $f->quantity > 0 ? 'Còn ' . $f->quantity . ' sản phẩm' : 'Hết hàng' }}
                        </span>

                        @livewire('client.add-to-cart', ['food' => $f])
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center shadow-sm rounded-3">
                    <i class="fas fa-info-circle me-2"></i>Danh mục chưa có món.
                </div>
            </div>
        @endforelse
    </div>
@endsection
