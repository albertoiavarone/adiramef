@extends('layout.app')

@section('content')
    <div class="d-flex flex-column flex-root">
        <!--begin::Error-->
        <div class="error error-6 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url({{ asset('assets/media/error/bg6.jpg')}} );">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-row-fluid text-center">
                <h1 class="error-title font-weight-boldest text-white mb-12" style="margin-top: 12rem;">Oops...</h1>
                <p class="display-4 font-weight-bold text-white">{!! $message !!}</p>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Error-->
    </div>
@endsection
