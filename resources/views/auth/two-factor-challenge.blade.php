@extends('layout.app')

@section('content')
<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Two-stes -->
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
						<div class="w-lg-600px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100 mb-10"  method="POST" id="kt_sing_in_two_steps_form" action="{{ route('two-factor.login') }}">
                				@csrf
								<!--begin::Icon-->
								<div class="text-center mb-10">
									<img alt="Logo" class="mh-125px" src="{{ asset('dist/media/svg/misc/smartphone.svg') }} " />
								</div>
								<!--end::Icon-->
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">{{__('auth.mf_verification')}}</h1>
									<!--end::Title-->
									<!--begin::Sub-title-->
									<div class="text-muted fw-bold fs-5 mb-5">{{ __('auth.mf_enter_code') }}</div>
									<!--end::Sub-title-->
									<!--begin::Mobile no-->
									<div class="fw-bolder text-dark fs-3">Google Authenticator, Authy, HENNGE OTP, FreeOTP,andOTP</div>
									<!--end::Mobile no-->
								</div>
								<!--end::Heading-->
								<!--begin::Section-->
								<div class="mb-10 px-md-10">
									<!--begin::Label-->
									<div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">{{__('auth.mf_type_code')}}</div>
									<!--end::Label-->
									<!--begin::Input group-->
									<div class="d-flex flex-wrap flex-stack">
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(2)" value="" required/>
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code2" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(3)" value="" required/>
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code3" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(4)" value="" required/>
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code4" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(5)" value="" required/>
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code5" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(6)" value="" required/>
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code6" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(7)" value="" required/>
									</div>
									<!--begin::Input group-->
				                  @error('recovery_code')
				                      <span class="invalid-feedback" role="alert">
				                          <strong>{{ $message }}</strong>
				                      </span>
				                  @enderror
								</div>
								<!--end::Section-->
								<!--begin::Submit-->
								<div class="d-flex flex-center">
									<button type="button" id="kt_sing_in_two_steps_submit" class="btn btn-lg btn-primary fw-bolder">
										<span class="indicator-label">{{ __('auth.login') }}</span>
									</button>
								</div>
								<!--end::Submit-->
                				<input id="code" type="hidden"  name="code" >
							</form>
							<!--end::Form-->
							<!--begin::Notice-->
							<div class="text-center fw-bold fs-5">
								<span class="text-muted me-1">{{__('auth.mf_no_code')}}</span>
								<!--<a href="#" class="link-primary fw-bolder fs-5 me-1">Resend</a>
								<span class="text-muted me-1">or</span>-->
								<a onclick="$('#box_recovery').slideToggle()" class="link-primary fw-bolder fs-5">{{__('auth.mf_type_recovery_code')}}</a>
				                  <div class="mt-3 card" id="box_recovery" style="display:none">
				                      <div class="card-body">
				                          <p class="text-center">
				                              {{__('auth.mf_enter_recovery_code')}}
				                          </p>
				                          <form method="POST" action="{{ route('two-factor.login') }}">
				                              @csrf
				                              <div class="form-group ">
				                                  <input id="recovery_code" type="recovery_code" class="form-control form-control-solid" name="recovery_code" required autocomplete="current-recovery_code">
				                                  @error('recovery_code')
				                                      <span class="invalid-feedback" role="alert">
				                                          <strong>{{ $message }}</strong>
				                                      </span>
				                                  @enderror
				                              </div>
				                              <!--begin::Submit-->
				                              <div class="d-flex flex-center my-2">
				                                <button type="submit" class="btn btn-lg btn-primary fw-bolder">
				                                  <span class="indicator-label">{{ __('auth.login') }}</span>
				                                </button>
				                              </div>
				                              <!--end::Submit-->
				                          </form>
				                      </div>
				                  </div>
				                  <!--begin::Link-->
				                  @if (Route::has('login'))
				                  <div class="text-gray-400 fw-bold fs-4">{{ __('auth.already_member') }}
				                  <a href="{{ route('login') }}" class="link-primary fw-bolder">{{ __('auth.sign_in') }}</a></div>
				                  @endif
				                  <!--end::Link-->
							</div>
							<!--end::Notice-->
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
			<!--end::Authentication - Two-stes-->
		</div>
		<!--end::Main-->



@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent
    <!-- DataTable init  -->
    <script>
      $('#kt_sing_in_two_steps_submit').click(function(){
        var code = '';
        for(i=1;i<=6;i++){
          code+=parseInt($('#code'+i).val());
        }
        $('#code').val(code);
        $('#kt_sing_in_two_steps_form').submit();
      });

      function focus_to(index){
        if(index<=6){
          $('#code'+index).focus();
        } else {
          $('#kt_sing_in_two_steps_submit').focus();
        }
      }
    </script>
@endsection
