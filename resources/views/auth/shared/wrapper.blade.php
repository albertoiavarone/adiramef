<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
    <!--begin::Content-->
    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
        @include('auth.check_language')

        <!--begin::Logo-->
        @include('auth.shared.logo')
        <!--end::Logo-->
        <!--begin::Title-->
        <h1 class="fw-bolder fs-2qx mt-25  " style="color: #fff;">{{ __('general.brand') }}</h1>
        <!--end::Title-->
        <!--begin::Description-->
        <p class="fw-bold fs-2" style="color: #fff;">{{ __('general.brand_claim') }}</p>
        <!--end::Description-->
    </div>
    <!--end::Content-->
    <!--begin::Illustration-->
    @include('auth.shared.illustration')
    <!--end::Illustration-->
</div>
