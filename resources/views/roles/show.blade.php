@extends('layout.app')
@section('title',__('roles.role'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('roles')}}" class="text-muted">{{__('roles.roles')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{$role->name}}</span>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">{{ __('roles.role').': '.$role->name }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-4">{{__('roles.name')}}</dt>
                        <dd class="col-md-8">{{ $role->name }}</dd>
                        <dt class="col-md-4">{{__('roles.guard_name')}}</dt>
                        <dd class="col-md-8">{{ $role->guard_name }}</dd>
                        <dt class="col-md-4">Default</dt>
                        <dd class="col-md-8"><i class="fa fa-{{ $role->default==1 ? 'check' : 'times' }}-circle"></i></dd>
                        <dt class="col-md-4">{{__('general.created_at')}}</dt>
                        <dd class="col-md-8">{{ $role->created_at }}</dd>
                        <dt class="col-md-4">{{__('general.updated_at')}}</dt>
                        <dd class="col-md-8">{{ $role->updated_at }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <h4>{{__('roles.role_permissions')}}</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('permissions.group')}}</th>
                                    <th>{{__('permissions.name')}}</th>
                                    <th>{{__('permissions.description')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($role->permissions as $permission)
                                <tr>
                                    <td>{{$permission->group}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->description}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>



        </div>
        <div class="card-footer">
            <a class="btn btn-secondary" href="{{ route('roles.index') }}"><i class="fa fa-arrow-circle-left"></i> {{__('general.back')}}</a>
        </div>
    </div>
@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent

@endsection
