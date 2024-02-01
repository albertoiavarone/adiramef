@extends('layout.app')
@section('title',__('roles.roles'))
@section('page_name',__('roles.roles'))
@section('content')
@php
  $default = 0;
@endphp
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{__('roles.roles')}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="alert alert-danger" id="error_no_default" style="display:none">
                     {{__('roles.no_default')}}
                 </div>
                <table id="example1" class="table  table-hover datatable">
                  <thead class="thead-light">
                  <tr>
                    <th>{{__('roles.rank')}}</th>
                    <th>{{__('roles.name')}}</th>
                    <th>Guard name</th>
                    <th>Default</th>
                    <th class="no-sort"></th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse($roles as $role)
                        @php
                            $default+=$role->default;
                        @endphp
                        <tr>
                            <td>{{ $role->rank }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->guard_name }}</td>
                            <td>{!! $role->default==1?'<i class="fa fa-check-circle text-success"></i>':'' !!}</td>
                            <td class="text-right">
                                <a href="{{ route('roles.show', $role->id ) }}" class="btn btn-sm btn-secondary btn-icon"><i class="fa fa-info-circle"></i></a>
                                @can('roles_u')
                                  <a href="{{ route('roles.edit', $role->id ) }}" class="btn btn-sm btn-info btn-icon"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('roles_d')
                                <button class="btn btn-sm btn-danger btn-icon" onclick="show_confirm_delete('role-delete-{{$role->id}}')"><i class="fa fa-trash"></i></button>
                                <form method="post" id="role-delete-{{$role->id}}" action="{{ route('roles.destroy',$role->id) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                </form>
                                @endcan
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
                <hr />

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                @can('roles_c')
                  <p class="text-right"><a class="btn btn-primary" href="{{ route('roles.create') }}"><i class="fa fa-plus-circle"></i> {{__('general.new')}}</a> </p>
                @endcan
              </div>
            </div>
            <!-- /.card -->
@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent
    <!-- DataTable init  -->
    {{--- @include('layout.basic.js.datatable') ---}}
    @if($default == 0)
        <script>
            $(function(){
                $('#error_no_default').show();
            });
        </script>
    @endif
@endsection
