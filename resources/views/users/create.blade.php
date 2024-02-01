@extends('layout.app')
@section('title',__('users.users'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('users')}}" class="text-muted">{{__('users.users')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{__('general.add')}}</span>
    </li>
@endsection

@section('content')
    <h4>{{__('users.add_user')}}</h4>
    {!! BootForm::open()
        ->action(route('users.store'))
        ->post()
        ->id('user-create')
    !!}
    <div class="row">
        <div class="col-md-4">
             {!!BootForm::text(__('users.name'), 'name')->required() !!}
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4">
             {!!BootForm::email(__('users.email'), 'email')->required() !!}
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4">
             {!!BootForm::select(__('roles.role'), 'role_id')->id('role')->class('form-control')->options($roles)->required() !!}
        </div>
        <div class="col-md-8"></div>
    </div>



    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">
            <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
        </a>
        <button class="btn btn-outline-primary" type="submit">
            <i class="fa fa-save"></i> {{__('general.add')}}
        </button>
    </div>
    {!! BootForm::close() !!}


@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function(){
            set_select2('role');
        })
    </script>

@endsection
