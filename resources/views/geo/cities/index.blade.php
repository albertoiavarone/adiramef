@extends('layout.app')
@section('title',__('geo.cities'))
@section('page_name',__('geo.cities'))
@section('content')

        <div class="card">
              <div class="card-body">
                  <h3 class="card-title">{{__('geo.cities')}}</h3>
                  <table id="cities" class="table  table-hover datatable">
                      <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>{{__('general.name')}}</th>
                        <th>{{__('geo.province')}}</th>
                        <th>{{__('general.abbreviation')}}</th>
                        <th>{{__('geo.nation')}}</th>
                        <th>{{__('geo.city_code')}}</th>
                        <th>{{__('general.created_at')}}</th>
                        <th class="no-sort"></th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                </table>
                <hr />

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <p class="text-right"><a class="btn btn-primary" href="{{ route('cities.create') }}"><i class="fa fa-plus-circle"></i> {{__('general.new')}}</a> </p>
              </div>
            </div>
            <!-- /.card -->
@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent

    @include('layout.basic.js.datatable_srv')
    <script>
        var Columns = {!! json_encode($columnConfig) !!};
        var url = "{{ url('allcities') }}";
        $(document).ready(function(){
            DataTableSrv('cities',url,Columns);
        });
    </script>


@endsection
