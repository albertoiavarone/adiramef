@extends('layout.app')
@section('title','password' )
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('auth.change_password') }}</div>
                <div class="card-body">
                    <p class="text-center mt-5 mb-15"><i class="fa fa-info-circle"></i> {{__('auth.password_rules')}}</p>

                    <form method="POST" action="{{ route('user-password.update') }}">
                        @csrf
                        @method('PUT')
                        @if (session('status') == "password-updated")
                            <div class="alert alert-success">
                                Password updated successfully.
                            </div>
                        @endif
                        @if(auth()->user()->provider)
                            <h5  class="alert alert-primary mb-15"><i class="fa fa-info-circle"></i> {{ str_replace( '##provider##' , auth()->user()->provider,  __('auth.update_password_oauth') )}}</h5>
                        @endif
                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('auth.current_password') }}</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required autofocus>

                                @error('current_password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('general.confirm') }} Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="mb-0 form-group row mt-15">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('general.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <div class="col-md-6 text-center">
            <img src="{{asset('assets/media/img/reset-password.png')}}" class="img-fluid" />
        </div>
    </div>
</div>
@endsection
