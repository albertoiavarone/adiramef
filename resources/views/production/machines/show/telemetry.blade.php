
        <div class="card">
          <div class="card-body">
              <h3 class="card-title">{{ __('production.telemetry') }}</h3>
              <div class="table-responsive">
                <table id="machine-telemetry" class="table  table-hover datatable">
                    <thead class="thead-light">
                    <tr>
                      <th>{{__('general.date')}}</th>
                      <th>Latitudine</th>
                      <th>Longitudine</th>
                      <th>Indirizzo</th>
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


<!--end::Card-->
@include('layout.basic.js.graphs')
<script>

    var Columns = {!! json_encode($columnConfig) !!};
    var url = "{{ url('machine/alltelemetry') }}";

    $(document).ready(function(){
        DataTableSrv('machine-telemetry',url,Columns,'{{$machine->uuid}}',0,'DESC',true);
    });





</script>
