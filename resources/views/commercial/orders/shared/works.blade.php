<div class="row">

    <h4 class="mt-5 mb-5">Lavorazioni collegate all'Ordine</h4>
    <hr class="mb-5"/>
    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-hover datatable">
          <thead class="thead-light">
          <tr>
            <th>{{__('general.date')}}</th>
            <th>{{__('general.code')}}</th>
            <th>{{ trans_choice('production.machine',1)}}</th>
            <th>{{ trans_choice('production.program',1)}}</th>
            <th>{{ trans_choice('production.lot',1)}}</th>
            <th>{{ trans_choice('production.piece',2)}}</th>
            <th>{{ __('production.prd_label')}}</th>
            <th class="no-sort"></th>
          </tr>
          </thead>
          <tbody>
              @forelse($order->works as $work)
                <tr>
                    <td>{{ $work->date_start->format('d/m/Y') }}</td>
                    <td>{{ $work->code }}</td>
                    <td>{{ $work->machine->name }}</td>
                    <td>{{ $work->program_name }}</td>
                    <td>{{ $work->processes }}</td>
                    <td>{!! view('production.works.shared.erp_link', compact('work'))!!}</td>
                    <td>{!! view('production.works.tds.buttons', compact('work'))!!}</td>
                </tr>
              @endforeach
          </tbody>
        </table>


  </div>
</div>

@section('script')
    @parent
    <!-- DataTable init  -->
    @include('layout.basic.js.datatable')
@endsection
