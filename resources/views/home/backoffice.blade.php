<div class="row">
    <div class="col-md-7">

      {!! view('home.shared.manteinance_expiring', compact('manteinances'))!!}
      @if($machines->count() < 10)
          <div class="card-body mt-0 pt-0">
            <h4 class="float-left">{{ trans_choice('production.machine', 2)}}</h4>
            @if($gps > 0)
            <a class="float-right" style data-toggle="modal" data-target="#Modal-Force-Sync" role="button">
              <i class="fas fa-sync"></i> Sync GPS
            </a>
            @endif
          </div>
          <div class="row">
            @forelse($machines as $machine)
              <div class=" col-md-6 col-sm-6 d-flex align-items-stretch">
                @if($machine->gps)
                  @include('home.shared.card_machine_gps')
                @else
                  @include('home.shared.card_machine')
                @endif
              </div>
            @endforeach
          </div>
      @else
          <div class="card mt-5">
            <div class="card-body">
              <h4 class="float-left">{{ trans_choice('production.machine', 2)}}</h4>
              @if($gps > 0)
                <a class="float-right" style data-toggle="modal" data-target="#Modal-Force-Sync" role="button">
                  <i class="fas fa-sync"></i> Sync GPS
                </a>
                <div class="clearfix"></div>
              @endif
              <hr />
                {!! view('home.shared.table_machines', compact('machines'))  !!}
            </div>
          </div>
      @endif


    </div>

    <div class="col-md-5 text-center" >
      @if($gps > 0)
        <div id="map_box">
          {!! view('home.shared.map' , compact('positions')) !!}
        </div>
        <button class="btn btn-sm btn-outline-secondary" onclick="location.reload()">{{ __('general.reload')}} {{ trans_choice('geo.map',1)}} <i class="fa fa-map"></i></button>
        <hr class="mb-10"/>
      @endif
      {!! view('home.shared.dashboard', compact('orders_statuses','works_by_month','months'))!!}
    </div>


</div>

@include('layout.basic.js.graphs')

@include('home.shared.modal_syncs')
@section('script')
  @parent
  <script>

      function refreshNow(){
        $('#response-box').html('<h3 class="text-center text-primary"><i class="fa fa-spinner fa-spin"></i> {{ __('general.loading')}}</h3>');

        $.post( "{{ route('machines.force.syncs') }}",{
						_token: "{{ csrf_token() }}"
					})
				.done(function( data ) {
          $('#response-box').html(data);
            $('#response-box').append( "<hr /><h4 class=\"text-primary\">La dashboard verrà riavviata tra pochi secondi...</h4>" );
					setTimeout(function(){
            window.location.reload();
          }, 5000)
				});
      }


      function map_machine(machine_uuid){
        $.post( "{{ route('machine.map') }}",{
						_token: "{{ csrf_token() }}",
            uuid : machine_uuid
					})
				.done(function( data ) {
          $('#map_box').html(data);
				});
      }


  </script>

@endsection
