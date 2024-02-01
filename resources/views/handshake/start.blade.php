@extends('layout.app')
@section('title','Home')
@section('content')
    @if(session('login-success'))
        <div class="alert alert-success" role="alert">
            {{ session('login-success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <h1 class="text-bold my-5"><i class="far fa-address-card"></i> {{__('users.complete_profile_label')}}</h1>
            <p class="mt-15">{{__('users.complete_profile_info')}}</p>
            <hr>
            <button type="button"  class="btn btn-light-primary btn-sm mt-10 mb-7" data-toggle="modal" data-target="#addUserDetail">
                <i class="fa fa-plus"></i> {{__('general.add')}}
            </button>
        </div>
        <div class="col-md-6">
            <img class="img-fluid mt-15" src="{{ asset('assets/media/svg/illustrations/working.svg')}}">
        </div>
    </div>




@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent

    {!! view('users.modals.add_user_detail', ['user' => auth()->user(),'route_callback' => 'home']) !!}

@endsection
