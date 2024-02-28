@extends('layout.app')
@section('title',trans_choice('production.work',2))
@section('page_name',trans_choice('production.work',2))
@section('content')

        <div class="card">
             <div class="card-header">
                  <h3 class="card-title float-left"><i class="flaticon-cogwheel"></i> {{trans_choice('production.work',2)}}</h3>
                  <div class="btn-group float-right">
                    <button class="btn btn-outline-primary btn-sm " data-target="#Modal-Filter" data-toggle="modal"><i class="fa fa-search"></i> {{ trans_choice('general.filter',1) }}</button>
                  </div>
             </div>
              <div class="card-body">
                  <div class=" text-lead">
                      {{ __('production.work_info_box')}}
                      <hr />
                  </div>
                  <div class="mb-10" id="filters"></div>

                  <div class="table-responsive">
                      <table id="works" class="table  table-hover datatable">
                          <thead class="thead-light">
                          <tr>
                              <th>{{__('general.updated_at')}}</th>
                              <th>{{ trans_choice('production.machine',1)}}</th>
                              <th>{{ trans_choice('production.machine_type',1)}}</th>
                              <th>{{trans_choice('general.order',1)}}</th>
                              <th>{{trans_choice('production.process',2)}}</th>
                              <th class="no-sort"></th>
                          </tr>
                          </thead>
                          <tbody>
                          </tbody>
                    </table>
                 </div>
                <hr />

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a class="btn btn-outline-success float-right" href="{{ route('works.create')}}"><i class="fa fa-plus-circle"></i> {{__('general.add')}}</a>
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
        var url = "{{ url('allworks') }}";
        $(document).ready(function(){
            DataTableSrv('works',url,Columns,'',0,'DESC');
        });
    </script>

    <!--start:Modal Filter-->
    @include('production.works.shared.modal_filter')
    <!-- end: Modal Filter-->






@endsection
