<div class="row">
    <div class="col-md-4">
        <div class="card mb-5 ">
            <div class="card-header  bg-light">Log Diagnostics</div>
            <div class="card-body">
                {!! loremIpsum('primary',1) !!}
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
              <h3 class="card-title">{{ __('production.diagnostics') }}</h3>
              <table id="machine-diagnostics" class="table  table-hover datatable">
                  <thead class="thead-light">
                  <tr>
                    <th>{{__('general.date')}}</th>
                    <th>{{__('general.type')}}</th>
                    <th>{{__('general.action')}}</th>
                    <th>{{ trans_choice('general.message',1)}}</th>
                    <th>{{__('general.time')}}</th>
                    <th class="no-sort"></th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
          </div>
        </div>
    <!-- /.card -->
    </div>
</div>

<!--end::Card-->
@include('layout.basic.js.graphs')
<script>

    var Columns = {!! json_encode($columnConfig) !!};
    var url = "{{ url('machine/alldiagnostics') }}";

    $(document).ready(function(){
        DataTableSrv('machine-diagnostics',url,Columns,'{{ $machine->uuid }}',0,'DESC',true);
        getMachineData();
    });





</script>
