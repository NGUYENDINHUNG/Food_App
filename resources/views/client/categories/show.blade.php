@extends('layouts.client')
@section('title', $category->name)

@section('content')
    <h4 class="mb-3 fw-bold">{{ $category->name }}</h4>
    <p class="text-muted">{{ $category->description }}</p>

    <div class="row g-3 mt-3">
        @forelse($foods as $f)
            <div class="col-6 col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $f->image }}" class="card-img-top" alt="{{ $f->name }}"
                        style="height:200px;object-fit:cover;">

                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-semibold mb-1">{{ $f->name }}</h6>
                        <small class="text-muted d-block mb-2">
                            {{ number_format($f->price, 0, ',', '.') }}đ
                        </small>

                        <span class="badge {{ $f->quantity > 0 ? 'bg-success' : 'bg-danger' }} mb-2">
                            {{ $f->quantity > 0 ? 'Còn ' . $f->quantity . ' sản phẩm' : 'Hết hàng' }}
                        </span>

                        <div class="mt-auto">
                            @if ($f->quantity > 0)
                                @livewire('client.add-to-cart', ['food' => $f])
                            @else
                                <button class="btn btn-secondary w-100" disabled>
                                    <i class="fas fa-times me-1"></i> Hết hàng
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Danh mục chưa có món.</div>
            </div>
        @endforelse
    </div>
@endsection
