<div class="card mb-5 ">
    <div class="card-header  bg-light">{{ trans_choice('production.last_log',1)}}</div>
    <div class="card-body">
      <ul>
      @if($machine->last_position())
        <li class="font-weight-normal mb-1" ><i class="fas fa-barcode font-size-sm"></i> Serial: {{$machine->serial_number}} </li>
        <li class="font-size-sm mb-1 text-{{ $machine->status['class'] }}"><i class="fas fa-power-off font-size-sm "></i> {!! $machine->status['label'] !!} </li>
        <li class="font-size-xs mb-1"><i class="fa fa-map-marker-alt font-size-sm"></i> {{ $machine->last_position()->address}}</li>
        <li class="font-size-sm mb-1"><i class="fas fa-clock font-size-sm "></i> {!! $machine->last_position()->timestamp ? convertToLocal($machine->last_position()->timestamp) : 'n.d.' !!} </li>
      @else
        <li class="font-size-sm mb-1"><i class="fa fa-map-marker-alt text-danger"></i> {{__('general.data_not_found')}}</li>
      @endif
      </ul>
    </div>
</div>
