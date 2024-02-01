@extends('layout.app')
@section('title',trans_choice('production.schedule',2))
@section('page_name',trans_choice('production.schedule',2))
@section('content')

        <div class="card">
             <div class="card-header">
                  <h3 class="card-title float-left"><i class="flaticon-cogwheel"></i> {{trans_choice('production.schedule',2)}}</h3>
                  <button class="btn btn-outline-primary btn-sm float-right" data-target="#Modal-Filter" data-toggle="modal"><i class="fa fa-search"></i> {{ trans_choice('general.filter',1) }}</button>
             </div>
              <div class="card-body">
                  <div class=" text-lead">
                      {{ __('production.schedule_info_box')}}
                      <hr />
                  </div>
                  <div class="mb-10" id="filters"></div>

                  <div class="table-responsive">
                      <table id="schedules" class="table  table-hover datatable">
                          <thead class="thead-light">
                          <tr>
                              <th>{{__('general.created_at')}}</th>
                              <th>{{ trans_choice('production.machine',1)}}</th>
                              <th>{{ __('general.name')}}</th>
                              <th>{{__('production.date_start')}}</th>
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
        var url = "{{ url('allschedules') }}";
        $(document).ready(function(){
            DataTableSrv('schedules',url,Columns,'',0,'DESC');
        });
    </script>

    <!--start:Modal Filter-->
    @include('production.schedules.shared.modal_filter')
    <!-- end: Modal Filter-->






@endsection
