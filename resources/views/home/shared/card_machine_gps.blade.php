<div class="card mb-3 shadow-sm"  style="width: 100%;">
  <div class="card-header bg-light-primary">
    <a class="font-weight-bolder" href="{{ route('machines.show', $machine->uuid)}}">
     {{ $machine->name }}
    </a>
    <span class="float-right">
      <i class="fas fa-power-off font-size-sm float-right text-{{ $machine->status ? $machine->status['class'] : '' }}"></i>
    </span>
  </div>
    <div class="card-body p-1">
        <div class="card-body p-3">
            <div class="d-flex">
                <!--begin::Item-->
                <div class="d-flex align-items-center justify-content-between ">
                  <div class="symbol symbol-20 symbol-lg-45 float-left mr-3">
                      <img class="img-fluid" src="{{ asset( !is_null($machine->type->logo_path) ? 'storage/'.$machine->type->logo_path : 'assets/media/img/no_image.png') }}">
                      <img class="img-fluid mt-2" src="{{ asset( !is_null($machine->builder->logo_path) ? 'storage/'.$machine->builder->logo_path : '') }}" style="height:15px" alt="{{ $machine->builder->name }}">
                      @if($machine->gps)
                        <button class="btn btn-sm btn-outline-primary btn-icon ml-2 mt-3" onclick="map_machine('{{$machine->uuid}}')"><i class="fa fa-map"></i></button>
                      @endif
                  </div>
                    <div class="d-flex align-items mr-2">
                        <div class="ml-3">
                          <ul class="list-unstyled pl-5 mt-3 font-size-sm">
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
                </div>
                <!--end::Item-->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
