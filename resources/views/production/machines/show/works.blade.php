<div class="row">
    <div class="col-md-4">
        <div class="card mb-5 ">
            <div class="card-header  bg-light">{{__('production.last_work')}}</div>
            <div class="card-body">
                @php
                    $last_work = $machine->last_work();
                @endphp
                @if($last_work)
                    <p class="float-left">
                        <strong>{{ trans_choice('production.order',1)}}:</strong>&nbsp;{{ data_get($last_work, 'order.code')}}
                        <br><strong>{{ __('production.date_start')}}:</strong>&nbsp;{{ convertToLocal($last_work['date_start']) }}
                        <br><strong>{{ __('production.total_time')}}:</strong>&nbsp;{{ $last_work['total_time'] }}
                    </p>
                    <a class="btn btn-sm btn-outline-secondary float-right" href="#"
                        onclick="ajax_req('{{ route('work.details') }}','{{ $last_work['uuid'] }}','{{ trans_choice('production.work',1)}}')"
                        <i class="fa fa-info-circle"></i> Info
                    </a>
                    @else
                    <p><i class="fa fa-times-circle"></i> {{ __('general.data_not_found')}}</p>
                @endif
            </div>
        </div>
        <!--begin::Chart-->
        <div id="machine-data-chart" style="min-height: 365px;">
        </div>
        <!--end::Chart-->
        <div class="resize-triggers">
            <div class="expand-trigger">
                <div style="width: 634px; height: 418px;"></div>
            </div>
            <div class="contract-trigger"></div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="card">
          <div class="card-body">
              <h3 class="card-title">{{ trans_choice('production.work',2) }}</h3>
              <div class="table-responsive">
                <table id="machine-works" class="table  table-hover datatable">
                    <thead class="thead-light">
                    <tr>
                      <th>{{__('production.date_start')}}</th>
                      <th>{{ trans_choice('general.order',1)}}</th>
                      <th>{{ trans_choice('production.lot',1)}}</th>
                      <th>{{ trans_choice('production.program',1)}}</th>
                      <th>{{__('production.total_time')}}</th>
                      <th class="no-sort"></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
          </div>
        </div>
    <!-- /.card -->
    </div>
</div>

<!--end::Card-->
@include('layout.basic.js.graphs')
<script>

    var Columns = {!! json_encode($columnConfig) !!};
    var url = "{{ url('machine/allworks') }}";

    $(document).ready(function(){
        DataTableSrv('machine-works',url,Columns,'{{$machine->uuid}}',0,'DESC',true);
        getMachineData();
    });





</script>
