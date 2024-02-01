@extends('layout.app')
@section('title',__('permissions.permissions'))

@section('content')
        <div class="card">
            <div class="card-header"><h3 class="card-title">{{__('permissions.permissions')}}</h3></div>
              <div class="card-body">

                <table id="example1" class="table table-bordered table-hover datatable">
                  <thead>
                  <tr>
                    <th>{{__('permissions.group')}}</th>
                    <th>{{__('permissions.name')}}</th>
                    <th>{{__('permissions.description')}}</th>
                    <th>Guard</th>
                    <th class="no-sort"></th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse($permissions as $permission)

                        <tr>
                            <td>{{ $permission->group }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>
                                <a href="{{ route('permissions.show', $permission->id ) }}" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-info-circle"></i></a>
                                @can('permissions_u') 
                                <button class="btn btn-sm btn-icon btn-danger" onclick="show_confirm_delete('permission-delete-{{$permission->id}}')"><i class="fa fa-trash"></i></button>
                                <form method="post" id="permission-delete-{{$permission->id}}" action="{{ route('permissions.destroy',$permission->id) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                </form>
                                @endcan
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                @can('permissions_r')
                  <p class="text-right"><a class="btn btn-primary" href="{{ route('permissions.create') }}"><i class="fa fa-plus-circle"></i> Aggiungi</a> </p>
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
    @include('layout.basic.js.datatable')
@endsection
