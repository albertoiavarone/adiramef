@extends('layout.app')
@section('title', trans_choice('production.machine', 1) )
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('machines')}}" class="text-muted">{{ trans_choice('production.machine', 2) }}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $machine->builder->name.' - '.$machine->name}}</span>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('production.machines.show.aside')
        </div>
        <div class="col-md-9" id="box-content">
          @if($machine->gps)
            @include('production.machines.show.overview_gps')
          @else
            @include('production.machines.show.overview')
          @endif

        </div>
    </div>
    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('machines.index') }}">
            <i class="fa fa-arrow-circle-left"></i> {{__('general.back')}}
        </a>
    </div>
@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent
    @include('layout.basic.js.datatable_srv')
    <script>
        //-------------------------------------------------
        function content_show(section){
            switch(section){
                case 'works':
                    var route = "{{ route('machine.show.works') }}";
                break;
                case 'syncs':
                    var route = "{{ route('machine.show.syncs') }}";
                break;
                case 'diagnostics':
                    var route = "{{ route('machine.show.diagnostics') }}";
                break;
                case 'schedule':
                    var route = "{{ route('machine.show.schedule') }}";
                break;
                case 'telemetry':
                    var route = "{{ route('machine.show.telemetry') }}";
                break;
                case 'orders':
                    var route = "{{ route('machine.show.orders') }}";
                break;
                case 'manteinances':
                    var route = "{{ route('machine.show.manteinances') }}";
                break;
                case 'attachments':
                    var route = "{{ route('machine.show.attachments') }}";
                break;
            }

            content_load(route);
        }
        //-------------------------------------------------
        function content_load(route){
            $.post( route,{
                    _token: "{{ csrf_token() }}",
                    uuid : '{{ $machine->uuid }}'
            }).done(function( response ) {
                $('#box-content').html(response);
            });
        }
        //-------------------------------------------------
        $(document).ready(function(){
            if($("#machine-data-chart").length == 1) {
              getMachineData();
            }
        });
        //-------------------------------------------------
        function getMachineData(){
            var xSeries = [];
            var xCategories = [];
            $.post( "{{ route('machine.data') }}",{
                    _token: "{{ csrf_token() }}",
                    uuid : '{{ $machine->uuid }}'
            }).done(function( response ) {
                var data = JSON.parse(response)
                var works_data = [];
                $.each(data.works, function(i, item) {
                    works_data.push(item.value)
                    xCategories.push(item.label);
                });
                xSeries.push({
                    "name" : "{{ trans_choice('production.work',2)}}",
                    "data" : works_data
                })

                drawBars('machine-data-chart',xSeries,xCategories);
            });
        }
        //-------------------------------------------------
    </script>


    {!! view('production.machines.shared.modal_infos', compact('machine'))!!}



@endsection
