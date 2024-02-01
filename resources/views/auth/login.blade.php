@extends('layout.app')
@section('title',__('auth.login'))
@section('content')
<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class=" flex-column flex-lg-row-auto w-xl-600px positon-xl-relative d-none d-lg-block" style="background-color: #cccccc">
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
							<!--begin::Form-->
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
							<form class="form w-100" method="POST"  action="{{ route('login') }}">
                				@csrf
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">{{ __('auth.login') }}</h1>
									<!--end::Title-->
                					<!--begin::Link-->
					                @if (Route::has('register'))
									  <div class="text-gray-400 fw-bold fs-4">{{ __('auth.new_here') }}
										  <a href="{{ route('register') }}" class="link-primary fw-bolder">{{ __('auth.register') }}</a>
									  </div>
                  					@endif
									<!--end::Link-->
								</div>
								<!--begin::Heading-->

								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="form-label fs-6 fw-bolder text-dark">Email</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" type="text" name="email" id="email" autocomplete="off"  placeholder="{{__('auth.placeholder_email')}}" required/>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
										<!--end::Label-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" type="password" name="password" id="password" autocomplete="off" required/>
									<!--end::Input-->
									<!--begin::Link-->
									@if (Route::has('password.request'))
									<a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder float-right mt-3 mb-3">{{ __('auth.forgot_password') }}</a>
									@endif
									<!--end::Link-->
								</div>
								<!--end::Input group-->
				                @if ($errors->any())
				                   @foreach ($errors->all() as $error)
				                       <div class="alert text-danger">{{$error}}</div>
				                   @endforeach
				                @endif
								<!--begin::Actions-->
								<div class="text-center">
									<!--begin::Submit button-->
									<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">{{ __('auth.login') }}</span>
									</button>
									<!--end::Submit button-->
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
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Main-->
@endsection
