@extends('layout.app')
@section('title',__('permissions.permission'))

@section('content')
    <div class="card">
        <div class="card-header">{{ __('permissions.permission').': '.$permission->name }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-4">{{__('permissions.name')}}</dt>
                        <dd class="col-md-8">{{ $permission->name }}</dd>
                        <dt class="col-md-4">{{__('permissions.group')}}</dt>
                        <dd class="col-md-8">{{ $permission->group }}</dd>
                        <dt class="col-md-4">{{__('permissions.description')}}</dt>
                        <dd class="col-md-8">{{ $permission->description }}</dd>
                        <dt class="col-md-4">{{__('permissions.guard_name')}}</dt>
                        <dd class="col-md-8">{{ $permission->guard_name }}</dd>
                        <dt class="col-md-4">{{__('general.created_at')}}</dt>
                        <dd class="col-md-8">{{ $permission->created_at }}</dd>
                        <dt class="col-md-4">{{__('general.updated_at')}}</dt>
                        <dd class="col-md-8">{{ $permission->updated_at }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <h4>{{__('roles.roles')}}</h4>
                    <ul>
                        @forelse($permission->roles as $role)
                            <li>{{$role->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-secondary" href="{{ route('permissions.index') }}"><i class="fa fa-arrow-circle-left"></i> {{__('general.back')}}</a>
        </div>
    </div>
@endsection

@section('head') 
    @parent
    
@endsection

@section('script') 
    @parent 
    
@endsection
