@extends('layouts.client')
@section('title','Trang chủ')

@section('content')
    @include('client.partials.header')

    <section class="py-5 text-center">
        <h2 class="fw-semibold mb-2">Chào mừng đến FoodApp</h2>
        <p class="text-muted mb-4">Thưởng thức ẩm thực, thư giãn cùng ưu đãi mỗi ngày.</p>
        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-lg rounded-pill">Khám phá thực đơn</a>
    </section>

    <section class="py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://picsum.photos/600/360?food1" class="card-img-top" alt="">
                    <div class="card-body">
                        <h6 class="fw-semibold">Góc ẩm thực</h6>
                        <small class="text-muted">Mẹo nấu ăn, câu chuyện món ngon.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://picsum.photos/600/360?food2" class="card-img-top" alt="">
                    <div class="card-body">
                        <h6 class="fw-semibold">Mini game</h6>
                        <small class="text-muted">Chơi vui – nhận mã giảm giá.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://picsum.photos/600/360?food3" class="card-img-top" alt="">
                    <div class="card-body">
                        <h6 class="fw-semibold">Ưu đãi hôm nay</h6>
                        <small class="text-muted">Săn deal hấp dẫn mỗi ngày.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection