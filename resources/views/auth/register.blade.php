@extends('layout.app')
@section('title',__('auth.register'))
@section('content')
<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-up -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class=" flex-column flex-lg-row-auto w-xl-600px positon-xl-relative d-none d-lg-block" style="background-color: #70869d">
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
						<div class="w-lg-600px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
				              <form method="POST" action="{{ route('register') }}">
				                  @csrf
								<!--begin::Heading-->
								<div class="mb-10 text-center">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">{{__('auth.create_account')}}</h1>
									<!--end::Title-->
									<!--begin::Link-->
					                  @if (Route::has('login'))
										<div class="text-gray-400 fw-bold fs-4">{{ __('auth.already_member') }}
										<a href="{{ route('login') }}" class="link-primary fw-bolder">{{ __('auth.sign_in') }}</a></div>
					                  @endif
									<!--end::Link-->
								</div>
								<!--end::Heading-->
								<!--begin::Action-->
					                <!--begin::Google link-->
					                <a href="{{url('login/google')}}" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
					                <img alt="Logo" src="{{ asset('assets/media/svg/logos/google-icon.svg') }}" class="h-20px me-3" /> {{ __('auth.log_with') }} Google</a>
					                <!--end::Google link-->
					                <!--begin::facebook link-->
					                <a href="{{url('login/facebook')}}" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
					                <img alt="Logo" src="{{ asset('assets/media/svg/logos/facebook-3.svg') }}" class="h-20px me-3" /> {{ __('auth.log_with') }} Facebook</a>
					                <!--end::facebook link-->
								<!--end::Action-->
								<!--begin::Separator-->
								<div class="d-flex align-items-center mb-10">
									<div class="border-bottom border-gray-300 mw-50 w-100"></div>
									<span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
									<div class="border-bottom border-gray-300 mw-50 w-100"></div>
								</div>
								<!--end::Separator-->
								<!--begin::Input group-->
				                <div class="fv-row mb-7">
	  								<label class="form-label fw-bolder text-dark fs-6">{{ __('auth.name') }}</label>
	  								<input class="form-control form-control-lg form-control-solid" type="text" name="name" autocomplete="off"  placeholder="{{__('auth.placeholder_name')}}" required />
				                  @error('name')
				                      <span class="invalid-feedback" role="alert">
				                          <strong>{{ $message }}</strong>
				                      </span>
				                  @enderror
				                </div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<label class="form-label fw-bolder text-dark fs-6">Email</label>
									<input class="form-control form-control-lg form-control-solid" type="email"  name="email" autocomplete="off"  placeholder="{{__('auth.placeholder_email')}}" required/>
				                  @error('email')
				                      <span class="invalid-feedback" role="alert">
				                          <strong>{{ $message }}</strong>
				                      </span>
				                  @enderror
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="mb-10 fv-row" data-kt-password-meter="true">
									<!--begin::Wrapper-->
									<div class="mb-1">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6">Password</label>
										<!--end::Label-->
										<!--begin::Input wrapper-->
										<div class="position-relative mb-3">
											<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" required />
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
									<!--end::Hint-->
					                  @error('password')
					                      <span class="invalid-feedback" role="alert">
					                          <strong>{{ $message }}</strong>
					                      </span>
					                  @enderror
								</div>
								<!--end::Input group=-->
								<!--begin::Input group-->
								<div class="fv-row mb-5">
									<label class="form-label fw-bolder text-dark fs-6">{{ __('auth.confirm') }} Password</label>
									<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" autocomplete="off" required />
								</div>
								<!--end::Input group-->
								@php 
								  $register_roles = \App\Models\Role\Role::register()->get();
								@endphp
								{!! view('roles.shared.radio_roles', [ 'roles' => $register_roles ]) !!}
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<label class="form-check form-check-custom form-check-solid form-check-inline">
										<input class="form-check-input" type="checkbox" name="terms" id="agreeTerms" value="1" {{ old('terms') ? 'checked' : '' }} required/>
										<span class="form-check-label fw-bold text-gray-700 fs-6">{{__('auth.agreeTerms')}}
										<a href="#" class="ms-1 link-primary">{{__('auth.terms')}}</a>.</span>
									</label>
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
										<span class="indicator-label">{{__('auth.register')}}</span>
									</button>
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
			<!--end::Authentication - Sign-up-->
		</div>
		<!--end::Main-->
@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent

	@if(app('request')->input('token_invite'))
		@php
			session()->put('token_invite', app('request')->input('token_invite') );
		@endphp
		<script>
			$(document).ready(function(){
				$.ajax({
				   type:'POST',
				   url:"{{ route('confirm.invitation') }}",
				   data:{
					   		_token: "{{csrf_token()}}",
					   		uuid:'{{ session('token_invite') }}'
						},
				   success:function(data){
					  //
				   }
				});
			});
		</script>
	@endif

@endsection
