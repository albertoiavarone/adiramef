@extends('layout.app')
@section('title',__('auth.forgot_password'))
@section('content')

<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Password reset -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class=" flex-column flex-lg-row-auto w-xl-600px positon-xl-relative d-none d-lg-block" style="background-color: #{{config('values.ASSET_COLOR')}}">
					<!--begin::Wrapper-->
					@include('auth.shared.wrapper')
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<div class="text-right mr-10">
						@include('layout.basic.topbar.languages')
					</div>
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							@if (session('status'))
				                <div class="alert alert-success" role="alert">
				                    {{ session('status') }}
				                </div>
				            @endif
							@if ($errors->any())
								 @foreach ($errors->all() as $error)
										 <div class="alert text-danger">{{$error}}</div>
								 @endforeach
							@endif
							<!--begin::Form-->
							<form class="form w-100" method="POST" action="{{ route('password.email') }}">
								@csrf
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">{{__('auth.forgot_password')}}</h1>
									<!--end::Title-->
									<!--begin::Link-->
									<div class="text-gray-400 fw-bold fs-4">{{__('auth.enter_email')}}</div>
									<!--end::Link-->
								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
									<input class="form-control form-control-solid" type="email" placeholder="" name="email" autocomplete="off" required />
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="d-flex flex-wrap justify-content-center pb-lg-0">
									<button type="submit"  class="btn btn-lg btn-primary fw-bolder me-4">
										<span class="indicator-label">{{ __('auth.send_link_reset') }}</span>
									</button>
									@if (Route::has('login'))
									<a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bolder ml-3">{{ __('auth.login') }}</a>
									@endif
								</div>

								<!--end::Actions-->
							</form>
							<!--end::Form-->

						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						@include('layout.basic.footer_links')
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Password reset-->
		</div>
		<!--end::Main-->

@endsection
