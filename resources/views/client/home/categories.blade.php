@use('Illuminate\Support\Facades\Storage')
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Danh mục nổi bật</h2>
            <p class="text-muted lead">Khám phá các danh mục ẩm thực phong phú</p>
        </div>
        <div class="row g-4">
            @forelse(\App\Models\Category::take(6)->get() as $category)
                <div class="col-lg-4 col-md-6">
                    <div class="category-card h-100 bg-white rounded-4 shadow-sm overflow-hidden border-0">
                        @if ($category->image)
                            <div class="category-image position-relative">
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="img-fluid w-100"
                                    style="height: 200px; object-fit: cover;">
                                <div
                                    class="category-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                    <div class="text-center text-white">
                                        <h5 class="fw-bold mb-2">{{ $category->name }}</h5>
                                        <p class="mb-0">{{ $category->foods->count() }} món ăn</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="category-content p-4">
                            <h5 class="fw-bold mb-2">{{ $category->name }}</h5>
                            <p class="text-muted small mb-3">{{ Str::limit($category->description, 80) }}</p>
                            <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-primary btn-sm">
                                Xem món ăn <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Chưa có danh mục nào</p>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('categories.index') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                Xem tất cả danh mục <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
