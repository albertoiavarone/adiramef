@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><i class="fa fa-lock"></i> {{ __('auth.mf_auth') }}</div>
                <div class="card-body">
                    @if (session('status') == "two-factor-authentication-disabled")
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.mf_disabled') }}
                        </div>
                    @endif
                    @if (session('status') == "two-factor-authentication-enabled")
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.mf_enabled') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                        @csrf
                        @if (auth()->user()->two_factor_secret)
                            @method('DElETE')
                            <p class="text mb-15">{!! __('auth.mf_enabled')!!}</p>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                </div>
                                <div class="col-md-6">
                                    <h4>{{__('auth.mf_codes')}}</h4>
                                    <ul>
                                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                            <li>{{ $code }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <p class="text-primary mt-5">{{__('auth.mf_codes_instructions')}}</p>
                            <button class="btn btn-outline-secondary  mt-5"><i class="fa fa-power-off"></i> {{__('auth.mf_disable').' '.__('auth.mf_auth')}}</button>
                        @else
                            <h4 class="text-danger">{{__('auth.mf_not_enabled')}}</h4>
                            <div class="mt-5">{!! __('auth.mf_instructions') !!}</div>
                            <button class="btn btn-outline-primary mt-5"><i class="fa fa-power-off"></i> {{__('auth.mf_enable').' '.__('auth.mf_auth')}}</button>
                        @endif
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <img src="{{asset('assets/media/img/2fa.png')}}" class="img-fluid" / />
        </div>
    </div>

</div>
@endsection
