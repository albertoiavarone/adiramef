
        <div class="card">
          <div class="card-body">
              <h3 class="card-title">
                {{ trans_choice('production.manteinance',2) }}
                <button class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#Modal-Add-Manteinance">
                  <i class="fa fa-plus"></i> {{ __('general.add')}}
                </button>
              </h3>
              <div class="table-responsive">
                <table id="machine-manteinances" class="table  table-hover datatable">
                    <thead class="thead-light">
                      <tr>
                          <th>{{__('general.expire_date')}}</th>
                          <th>{{ trans_choice('production.manteinance_type',1)}}</th>
                          <th>{{ trans_choice('general.title',1) }}</th>
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
@include('production.machines.shared.modal_add_manteinance')
<script>

    var Columns = {!! json_encode($columnConfig) !!};
    var url = "{{ url('machine/allmanteinances') }}";

    $(document).ready(function(){
        DataTableSrv('machine-manteinances',url,Columns,'{{$machine->uuid}}',0,'DESC',true);
    });
</script>
