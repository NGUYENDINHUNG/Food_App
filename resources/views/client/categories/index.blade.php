@extends('layouts.client')
@section('title', 'Danh mục')

@section('content')
    <h5 class="mb-3">Danh mục</h5>
    <div class="row g-3">
        @forelse($categories as $c)
            <div class="col-6 col-md-3">
                <a class="card h-100 text-decoration-none text-dark" href="{{ route('categories.show', $c) }}">
                    <img src="{{ $c->image }}" class="card-img-top" alt="{{ $c->name }}">
                    <div class="card-body">
                        <div class="fw-semibold">{{ $c->name }}</div>
                        <small class="text-muted">{{ $c->description }}</small>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Chưa có danh mục.</div>
            </div>
        @endforelse
    </div>
@endsection
