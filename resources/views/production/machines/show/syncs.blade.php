<div class="row">
    <div class="col-md-4">
        {!! view('production.syncs.shared.last_sync', compact('machine')) !!}

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
              <h3 class="card-title">{{ trans_choice('production.sync',2) }}</h3>
              <table id="machine-syncs" class="table  table-hover datatable">

                  <thead class="thead-light">
                  <tr>
                    <th>{{__('general.created_at')}}</th>
                    <th>{{__('general.date')}}</th>
                    <th>{{__('general.type')}}</th>
                    <th>{{__('general.status')}}</th>
                    <th>{{__('production.inserted_rows')}}</th>
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
    var url = "{{ url('machine/allsyncs') }}";

    $(document).ready(function(){
        DataTableSrv('machine-syncs',url,Columns,'{{$machine->uuid}}',0,'DESC',true);
        getMachineData();
    });





</script>
