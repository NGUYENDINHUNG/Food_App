@extends('layouts.client')
@section('title','Login')

@section('content')
<section class="min-vh-100 d-flex align-items-center bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-7 col-lg-5">
				<div class="card border-0 shadow-sm rounded-4">
					<div class="card-body p-4 p-md-5">
						<div class="text-center mb-4">
							<div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width:64px;height:64px;">
								<i class="bi bi-shield-lock fs-3 text-primary"></i>
							</div>
							<h1 class="h4 fw-semibold mt-3 mb-1">Đăng nhập</h1>
							<p class="text-muted m-0">Vui lòng nhập email và mật khẩu</p>
						</div>

						<form method="post" action="{{ route('auth.login.store') }}" novalidate>
							@csrf
							<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<input type="email" id="email" name="email" value="{{ old('email') }}"
									class="form-control form-control-lg @error('email') is-invalid @enderror"
									placeholder="you@example.com" required autofocus>
								@error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
							</div>

							<div class="mb-2">
								<label for="password" class="form-label">Mật khẩu</label>
								<input type="password" id="password" name="password"
									class="form-control form-control-lg @error('password') is-invalid @enderror"
									placeholder="••••••••" required>
								@error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
							</div>

							<div class="d-flex justify-content-between align-items-center mb-4">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="remember" name="remember">
									<label class="form-check-label" for="remember">Ghi nhớ</label>
								</div>
								<a href="#" class="link-primary small">Quên mật khẩu?</a>
							</div>

							<button class="btn btn-primary btn-lg w-100" type="submit">
								<i class="bi bi-box-arrow-in-right me-1"></i> Login
							</button>
						</form>

						<p class="text-center text-muted mt-4 mb-0">
							Chưa có tài khoản?
							<a href="{{ route('auth.register') }}" class="link-primary fw-semibold">Đăng ký</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection