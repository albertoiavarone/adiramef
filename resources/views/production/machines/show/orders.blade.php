
        <div class="card">
          <div class="card-body">
              <h3 class="card-title">{{ trans_choice('commercial.order',2) }}</h3>
              <div class="table-responsive">
                <table id="machine-orders" class="table  table-hover datatable">
                    <thead class="thead-light">
                    <tr>
                      <th>{{__('general.created_at')}}</th>
                      <th>{{ trans_choice('commercial.order',1)}}</th>
                      <th>{{__('general.status')}}</th>
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
    var url = "{{ url('machine/allorders') }}";

    $(document).ready(function(){
        DataTableSrv('machine-orders',url,Columns,'{{$machine->uuid}}',0,'DESC',true);
    });





</script>
