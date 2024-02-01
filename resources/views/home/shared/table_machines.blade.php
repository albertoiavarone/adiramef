<div class="table-responsive">
  <table id="example1" class="table table-bordered table-hover datatable">
    <thead>

      <th>{{ __('general.type')}}</th>
      <th>{{ trans_choice('production.builder',1)}}</th>
      <th>{{ __('general.name')}}</th>
      <th>{{ __('production.serial_number')}}</th>
      <th></th>
    </thead>
    <tbody>
      @forelse($machines as $machine)
      <tr>
        <td>{{ $machine->type->name}}</td>
        <td><img src="{{ asset( !is_null($machine->builder->logo_path) ? 'storage/'.$machine->builder->logo_path : '') }}" style="max-height:20px" alt="{{ $machine->builder->name}}"></td>
        <td>{{ $machine->name}}</td>
        <td>{{ $machine->serial_number}}</td>
        <td>
          <div class="btn-group">
            @if($machine->gps)
              <button class="btn btn-sm btn-outline-light btn-icon mr-1" onclick="map_machine('{{$machine->uuid}}')"><i class="fa fa-map"></i></button>
            @endif
            <a class="btn btn-sm btn-outline-secondary btn-icon" href="{{ route('machines.show', $machine->uuid)}}"><i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@section('script')
    @parent
    <!-- DataTable init  -->
    @include('layout.basic.js.datatable')
    <script>
      $(document).ready(function(){
        $('.datatable').DataTable().page.len(25).draw();
      });
    </script>
@endsection
