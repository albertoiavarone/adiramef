@extends('layout.app_blank')

@section('content')
<div class="container text-center">
    <div class="" style="margin-top:5%">
        <img src="{{asset('assets/media/img/email-verification.png')}}">
    </div>
    @if (session('resent'))
        <div class="alert alert-success" role="alert" style="margin-top:5%">
            {{ __('auth.verify_email_msg') }}
        </div>
    @endif
    <h1 class="text-muted" style="margin-top:5%">{{ __('auth.verify_email') }}</h1>
    <h4 class="text-muted" style="margin-top:2%">{!! __('auth.chek_email') !!}</h4>
    {{ __('auth.not_received') }},
    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.verify_resend') }}</button>.
    </form>


</div>
@endsection
