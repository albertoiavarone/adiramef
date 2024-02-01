@extends('layout.app')
@section('title',trans_choice('production.localization',1))
@section('page_name',trans_choice('production.localization',1))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('telemetries')}}" class="text-muted">{{trans_choice('production.localization',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $machine_data->machine->name }}</span>
    </li>
@endsection


@section('content')
<div class="row">
  <div class="col-md-4">
    <h4 class="font-weight-bold">
      <img class="img-fluid mr-1" src="{{ asset('storage/'.$machine_data->machine->type->logo_path) }}" style="height:25px" />
      {{$machine_data->machine->name}}
    </h4>
    <hr class="m-0 mb-1"/>
    <p class=""><i class="far fa-clock font-size-sm"></i> Data rilevazione: {{  $machine_data->timestamp ? convertToLocal($machine_data->timestamp) : 'n.d' }}</p>
    <p class="">
        <i class="fas fa-power-off font-size-sm "></i> Stato: <span class="text-{{ $machine_data->machine->status['class'] }}">
          {{ $machine_data->machine->status['label'] }}</span>
    </p>
    <p class=""><i class="flaticon-dashboard font-size-normal"></i> Velocità {{ intval($machine_data->speed) }} Km/h</p>
    <p class=""><i class="fas fa-barcode"></i> Seriale: {{$machine_data->machine->serial_number}}</p>
    <p class=""><i class="fa fa-map-marker-alt font-size-normal"></i> Latitudine: {{$machine_data->latitude}}</p>
    <p class=""><i class="fa fa-map-marker-alt font-size-normal"></i> Longitudine: {{$machine_data->longitude}}</p>
    <p class=""><i class="fa fa-map-marker-alt font-size-normal"></i> Altitudine: {{$machine_data->altitude}}</p>
    <p class=""><i class="fa fa-map-marker-alt font-size-normal"></i> Direzione: {{$machine_data->direction}}</p>
    <p class=""><i class="fa fa-map-marker-alt font-size-normal"></i>Indirizzo: {{$machine_data->address}}</p>

    <p class=""><i class="far fa-clock font-size-sm"></i> Data Inserimento: {{  convertToLocal($machine_data->created_at) }}</p>

    <hr class="m-0 mb-1"/>
    <span class="float-left"><img class="img-fluid" src="{{ asset( !is_null($machine_data->machine->provider->logo_path) ? 'storage/'.$machine_data->machine->provider->logo_path : '') }}" style="height:50px" alt="{{ $machine_data->machine->provider->name}}" /></span>
    <span class="float-right"><img class="img-fluid" src="{{ asset( !is_null($machine_data->machine->builder->logo_path) ? 'storage/'.$machine_data->machine->builder->logo_path : '') }}" style="height:50px" alt="{{ $machine_data->machine->builder->name}}" /></span>
    <div class="clearfix"></div>
  </div>
  <div class="col-md-8">
    {!! view('home.shared.map' , compact('positions')) !!}
  </div>
</div>

<hr class="mt-10">
<div class="btn-group float-right mt-10">
    <a class="btn btn-outline-secondary" href="{{ route('telemetries.index') }}">
        <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
    </a>

</div>


@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent





@endsection
