@extends('layout.app')
@section('title',__('roles.roles'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('roles')}}" class="text-muted">{{__('roles.roles')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{__('roles.add_role')}}</span>
    </li>
@endsection

@section('content')
    <h4>{{__('roles.add_role')}}</h4>
    {!! BootForm::open()
        ->action(route('roles.store'))
        ->post()
        ->id('role-create')
    !!}
            <div class="row">
                <div class="col-md-3">
                     {!!BootForm::text(__('roles.name'), 'name')->required() !!}
                </div>
                <div class="col-md-3">
                     {!!BootForm::text(__('roles.guard_name'), 'guard_name')->value('web')->required() !!}
                </div>
                <div class="col-md-3">
                     {!!BootForm::text(__('roles.rank'), 'rank')->required() !!}
                </div>
                <div class="col-md-3 mt-10">
                     {!!BootForm::checkbox('Default', 'default',1) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h5 class="alert alert-light mt-5">{{__('permissions.permissions')}}</h5>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div class="accordion accordion-solid accordion-toggle-arrow" id="accordionRole">
                        @php
                            $group = '';
                        @endphp
                        @forelse($permissions as $key => $permission)
                            @if($group!=$permission->group)
                                @if($key>0)

                                </div> <!-- close card-->
                                @endif
                                <!-- open card-->
                                <div class="card">
                                    <div class="card-header" id="heading{{$key}}">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="false">
                                            {{ $permission->group}}
                                        </div>
                                    </div>
                                    <div id="collapse{{$key}}" class="collapse" data-parent="#accordionRole" style="">
                            @endif
                                    <div class="card-body">
                                        <div class="form-group">
        									<div class="checkbox-list">
        										<label class="checkbox checkbox-square">
                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                                <span></span>{{ $permission->description}} [{{ $permission->name}}]
                            </label>
        									</div>
        								</div>
                                    </div>
                                @php
                                    $group = $permission->group;
                                @endphp
                        @endforeach
                            </div>
                        </div>
                        <!-- close card-->
                    </div>
                    <!-- close accordion-->
                </div>
            </div>
        </div>

    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('roles.index') }}">
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

@endsection
