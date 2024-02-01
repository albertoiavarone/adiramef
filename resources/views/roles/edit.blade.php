@extends('layout.app')
@section('title',__('roles.role').': '.$role->name)
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('roles')}}" class="text-muted">{{__('roles.roles')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{$role->name}}</span>
    </li>
@endsection
@section('content')

        <h3 class="card-title">{{__('roles.edit_role')}}</h3>

      {!! BootForm::open()
          ->action(route('roles.update',$role->id))
          ->put()
          ->id('role-update')
      !!}
    {!! BootForm::bind($role) !!}

        <div class="row">
            <div class="col-md-3">
                 {!!BootForm::text(__('roles.name'), 'name')->required() !!}
            </div>
            <div class="col-md-3">
                 {!!BootForm::text(__('roles.guard_name'), 'guard_name')->required() !!}
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
                            </div>
                            @endif
                            <div class="card">
                                <div class="card-header" id="heading{{$key}}">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="false">
                                        {{ $permission->group}} <span class="badge badge-secondary mx-5" id="group_{{$permission->id}}_cont">0</span>
                                    </div>
                                </div>
                                <div id="collapse{{$key}}" class="collapse" data-parent="#accordionRole" style="">
                        @endif

                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="checkbox-list">
                                                <label class="checkbox checkbox-square">
                                                    <input type="checkbox" class="group_{{$permission->group}}" name="permissions[]" value="{{$permission->id}}" {{ in_array($permission->id,$perm_assigned)?'checked':''}} >
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
                    </div><!-- close card-->
                </div><!-- close accordion-->
            </div>
        </div>
        <hr class="mt-10">
        <div class="btn-group float-right mt-10">
            <a class="btn btn-outline-secondary" href="{{ route('roles.index') }}">
                <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
            </a>
            <button class="btn btn-outline-success" type="submit">
                <i class="fa fa-save"></i> {{__('general.save')}}
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
        $(function(){
            @forelse($permissions as $permission)
                $('#group_{{$permission->id}}_cont').html( $('.group_{{$permission->group}}:checkbox:checked').length );
            @endforeach
        });
    </script>

@endsection
