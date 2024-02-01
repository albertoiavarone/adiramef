@extends('layout.app')

@section('content')

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

<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - New password -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #99cfd5">
					<!--begin::Wrapper-->
					@include('auth.shared.wrapper')
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-550px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100"  method="POST" action="{{ route('password.update') }}">
								@csrf
								<input type="hidden" name="token" value="{{ request()->token }}">
								<!--begin::Heading-->
								<div class="text-center mb-10">
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
									<!--begin::Title-->
									<h1 class="text-dark mb-3">{{__('auth.set_new_password')}}</h1>
									<!--end::Title-->
									<!--begin::Link-->
									<div class="text-gray-400 fw-bold fs-4">{{__('auth.already_reset')}}
									<a href="{{route('login')}}" class="link-primary fw-bolder">{{__('auth.sign_in')}}</a></div>
									<!--end::Link-->
								</div>
								<!--begin::Heading-->
								<!--begin::Input group=-->
								<div class="fv-row mb-10">
									<label class="form-label fw-bolder text-dark fs-6">Email</label>
									<input class="form-control form-control-lg form-control-solid" id="email" type="email" placeholder="{{__('auth.email_placeholder')}}" name="email" autocomplete="off" value="{{ app('request')->input('email') }}" required />
									@error('email')
											<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
											</span>
									@enderror
								</div>
								<!--end::Input group=-->
								<!--begin::Input group-->
								<div class="mb-10 fv-row" data-kt-password-meter="true">
									<!--begin::Wrapper-->
									<div class="mb-1">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6">Password</label>
										<!--end::Label-->
										<!--begin::Input wrapper-->
										<div class="position-relative mb-3">
											<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" id="password" autocomplete="off" required />
											<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="bi bi-eye-slash fs-2"></i>
												<i class="bi bi-eye fs-2 d-none"></i>
											</span>
										</div>
										<!--end::Input wrapper-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Hint-->
									<div class="text-muted">{{ __('auth.password_rules') }}</div>
									@error('password')
											<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
											</span>
									@enderror
									<!--end::Hint-->
								</div>
								<!--end::Input group=-->
								<!--begin::Input group=-->
								<div class="fv-row mb-10">
									<label class="form-label fw-bolder text-dark fs-6">{{__('auth.confirm')}} Password</label>
									<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" id="password-confirm" autocomplete="off" required />
								</div>
								<!--end::Input group=-->
								<!--begin::Action-->
								<div class="text-center">
									<button type="submit"  class="btn btn-lg btn-primary fw-bolder">
										<span class="indicator-label">{{__('auth.continue')}}</span>
									</button>
								</div>
								<!--end::Action-->
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
			<!--end::Authentication - New password-->
		</div>
		<!--end::Main-->
@endsection
