@extends('layout.app')
@section('title',trans_choice('general.order',2))
@section('page_name',trans_choice('general.order',2))
@section('content')

        <div class="card">
             <div class="card-header">
                  <h3 class="card-title float-left"><i class="flaticon-cart"></i> {{trans_choice('general.order',2)}}</h3>
                  <button class="btn btn-outline-primary btn-sm float-right" data-target="#Modal-Filter" data-toggle="modal"><i class="fa fa-search"></i> {{ trans_choice('general.filter',1) }}</button>
            </div>
              <div class="card-body">
                  <div class=" text-lead">
                      {{ trans_choice('general.order',2)}}
                      <hr />
                  </div>

                  <div class="mb-10" id="filters"></div>
                   <div class="table-responsive">
                      <table id="Orders" class="table  table-hover datatable">
                          <thead class="thead-light">
                          <tr>
                              <th>{{__('general.created_at')}}</th>
                              <th>{{trans_choice('commercial.ref_code',1)}}</th>
                              <th>{{trans_choice('commercial.ref_date',1)}}</th>
                              <th>{{__('general.name')}}</th>
                              <th>{{__('general.status')}}</th>
                              <th>{{__('general.updated_at')}}</th>
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
                  <p class="text-right"><a class="btn btn-primary" href="{{ route('orders.create') }}"><i class="fa fa-plus-circle"></i> {{__('general.add')}}</a> </p>
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
        var url = "{{ url('allorders') }}";
        $(document).ready(function(){
            DataTableSrv('Orders',url,Columns,'',0,'DESC');
        });
    </script>

    <!--start:Modal Filter-->
    @include('commercial.orders.shared.modal_filter')
    <!-- end: Modal Filter-->



@endsection
