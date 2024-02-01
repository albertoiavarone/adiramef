@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p class="text-center">
                        {{ __('auth.digit_password') }}
                    </p>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 ">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button type="submit" class="btn btn-primary btn-block mt-4">
                                    {{ __('auth.confirm') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="alert alert-light mt-5 p-6">
                <h4>{{__('auth.mf_question')}}</h4>
                <p>{!!__('auth.mf_answer')!!}</p>
            </div>

        </div>
        <div class="col-md-6">
            <img src="{{asset('assets/media/img/2fa.png')}}" class="img-fluid" / />
        </div>
    </div>
</div>
@endsection
