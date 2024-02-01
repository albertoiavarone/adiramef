<div class="alert alert-custom alert-outline-2x alert-outline-success fade show mb-5 ml-10" role="alert">
	<div class="alert-icon">
		<i class="fas fa-battery-half"></i>
	</div>
	<div class="alert-text"><h2>{{ __('production.energy_consumed')}} <span class="float-right">KW {{ $order->order_total_energy_consumed }}</span></h2></div>
</div>

<div class="alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5 ml-10" role="alert">
	<div class="alert-icon">
		<i class="fa fa-fill-drip"></i>
	</div>
	<div class="alert-text"><h2>{{ __('production.fuel')}} <span class="float-right">Lit {{ $order->order_total_fuel }}</span></h2></div>
</div>



	<div class="card-body">
		<h4>{{ trans_choice('production.machine',2)}} {{ trans_choice('commercial.order',1)}}</h4>
		@if($order->order_machines->count() > 0)
			<ul class = "list-unstyled">
				@foreach($order->order_machines as $order_machine)
					<li class="mb-3 font-size-lg">
						<div class="alert alert-custom  alert-outline-secondary mb-3 shadow-sm" role="alert">
							@if(!is_null($order_machine->machine->type->logo_path))
							<img class="mr-3" src="{{ asset('storage/'.$order_machine->machine->type->logo_path) }}" style="height:20px" />
							@endif
							{{ $order_machine->machine->name }} [{{ $order_machine->machine->builder->name  }} S/N {{ $order_machine->machine->serial_number}}]
						</div>
					</li>
				@endforeach
			</ul>
		@else
			<p>
				{{ __('general.data_not_found')}}
			</p>
		@endif
	</div>
