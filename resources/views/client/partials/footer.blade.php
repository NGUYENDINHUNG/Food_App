<footer class="bg-dark text-light py-5 mt-5" id="footer" style="min-height: 320px;">
    <div class="container">
      <div class="row gy-4">
        <!-- Trái -->
        <div class="col-lg-6 d-flex flex-column align-items-start gap-3">
          <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="max-width: 180px" />
          <p class="small">
            FoodApp mang đến các món ăn chất lượng, giao hàng nhanh chóng và trải nghiệm đặt món tiện lợi.
            Rất hân hạnh được phục vụ bạn mỗi ngày!
          </p>
        </div>

        <!-- Giữa -->
        <div class="col-lg-3 col-6 d-flex flex-column gap-2">
          <h5 class="text-white">CÔNG TY</h5>
          <ul class="list-unstyled small">
            <li><a href="{{ route('home') }}" class="link-light text-decoration-none">Trang chủ</a></li>
            <li><a href="#" class="link-light text-decoration-none">Giới thiệu</a></li>
            <li><a href="#" class="link-light text-decoration-none">Vận chuyển</a></li>
            <li><a href="#" class="link-light text-decoration-none">Chính sách bảo mật</a></li>
          </ul>
        </div>

        <!-- Phải -->
        <div class="col-lg-3 col-6 d-flex flex-column gap-2">
          <h5 class="text-white">LIÊN HỆ</h5>
          <ul class="list-unstyled small">
            <li><a href="tel:+84901234567" class="link-light text-decoration-none">+84 90 123 4567</a></li>
            <li><a href="mailto:lienhe@foodapp.vn" class="link-light text-decoration-none">lienhe@foodapp.vn</a></li>
            <li><a href="#" class="link-light text-decoration-none">Hỗ trợ khách hàng</a></li>
          </ul>
        </div>
      </div>

      <hr class="border-secondary my-4" />

      <p class="small text-center mb-0">
        © {{ date('Y') }} FoodApp - Mọi quyền được bảo lưu.
      </p>
    </div>
</footer>