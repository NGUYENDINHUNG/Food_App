@extends('layouts.client')
@section('title','Register')

@section('content')
<section class="min-vh-100 d-flex align-items-center bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-7">
				<div class="card border-0 shadow-sm rounded-4">
					<div class="card-body p-4 p-md-5">
						<div class="text-center mb-4">
							<div class="rounded-circle bg-warning bg-opacity-25 d-inline-flex align-items-center justify-content-center" style="width:64px;height:64px;">
								<i class="bi bi-person-plus fs-3 text-warning"></i>
							</div>
							<h1 class="h4 fw-semibold mt-3 mb-1">Tạo tài khoản</h1>
							<p class="text-muted m-0">Điền thông tin bên dưới để đăng ký</p>
						</div>

						<form method="post" action="{{ route('auth.register.store') }}" novalidate>
							@csrf
							<div class="row g-3">
								<div class="col-12">
									<label class="form-label" for="name">Họ tên</label>
									<input id="name" name="name" value="{{ old('name') }}" class="form-control form-control-lg @error('name') is-invalid @enderror" required>
									@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="col-12">
									<label class="form-label" for="email">Email</label>
									<input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg @error('email') is-invalid @enderror" required>
									@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="col-md-6">
									<label class="form-label" for="address">Địa chỉ</label>
									<input id="address" name="address" value="{{ old('address') }}" class="form-control form-control-lg @error('address') is-invalid @enderror">
									@error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="col-md-6">
									<label class="form-label" for="phone">Số điện thoại</label>
									<input id="phone" name="phone" value="{{ old('phone') }}" class="form-control form-control-lg @error('phone') is-invalid @enderror">
									@error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="col-md-6">
									<label class="form-label" for="password">Mật khẩu</label>
									<input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required>
									@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="col-md-6">
									<label class="form-label" for="password_confirmation">Xác nhận mật khẩu</label>
									<input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" required>
								</div>
							</div>

							<button class="btn btn-warning btn-lg w-100 mt-4">
								<i class="bi bi-person-check me-1"></i> Tạo tài khoản
							</button>
						</form>

						<p class="text-center text-muted mt-4 mb-0">
							Đã có tài khoản? <a href="{{ route('auth.login') }}" class="link-primary fw-semibold">Đăng nhập</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection