<!--begin::Separator-->
<div class="text-center text-muted text-uppercase fw-bolder mb-5">{{ __('auth.or') }}</div>
<!--end::Separator-->
<!--begin::Google link-->
<a href="{{url('login/google')}}" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
<img alt="Logo" src="{{ asset('assets/media/svg/logos/google-icon.svg') }}" class="h-20px me-3" /> {{ __('auth.log_with') }} Google</a>
<!--end::Google link-->
<!--begin::Google link-->
<a href="{{url('login/facebook')}}" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
<img alt="Logo" src="{{ asset('assets/media/svg/logos/facebook-3.svg') }}" class="h-20px me-3" /> {{ __('auth.log_with') }} Facebook</a>
<!--end::Google link-->
