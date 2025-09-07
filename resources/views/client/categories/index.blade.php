@extends('layouts.client')
@section('title', 'Danh mục')

@section('content')
    <h5 class="mb-3 fw-bold text-primary">Danh Muc Thực Đơn</h5>
    <div class="row g-3">
        @forelse($categories as $c)
            <div class="col-6 col-md-3">
                <a class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden text-decoration-none text-dark 
                          hover-shadow" 
                   href="{{ route('categories.show', $c) }}">
                    <div class="ratio ratio-4x3">
                        <img src="{{ $c->image }}" class="card-img-top" alt="{{ $c->name }}" style="object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <div class="fw-semibold text-truncate" title="{{ $c->name }}">{{ $c->name }}</div>
                        <small class="text-muted d-block text-truncate">{{ $c->description }}</small>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center shadow-sm rounded-3">
                    <i class="fas fa-info-circle me-2"></i>Chưa có danh mục.
                </div>
            </div>
        @endforelse
    </div>
@endsection
