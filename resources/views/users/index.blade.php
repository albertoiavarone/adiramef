@extends('layout.app')
@section('title',__('users.users'))
@section('page_name',__('users.users'))

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{__('users.users')}}</span>
    </li>
@endsection

@section('content')
        <div class="card">
              <div class="card-body">
                  <h3 class="card-title">{{__('users.users')}}</h3>
                  <table id="users" class="table  table-hover datatable">
                      <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>{{__('users.name')}}</th>
                        <th>{{__('roles.role')}}</th>
                        <th>{{__('general.language')}}</th>
                        <th>{{__('general.timezone')}}</th>
                        <th>{{__('general.created_at')}}</th>
                        <th class="no-sort"></th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <p class="text-right"><a class="btn btn-primary" href="{{ route('users.create') }}"><i class="fa fa-plus-circle"></i> {{__('general.new')}}</a> </p>
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
    @include('layout.basic.js.datatable_srv')
    <script>
        var Columns = {!! json_encode($columnConfig) !!};
        var url = "{{ url('allusers') }}";
        $(document).ready(function(){
            DataTableSrv('users',url,Columns);
        });
    </script>

@endsection
