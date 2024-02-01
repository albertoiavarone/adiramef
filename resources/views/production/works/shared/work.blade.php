<div class="card card-custom gutter-b card-stretch">
	<!--begin::Body-->
	<div class="card-body">
		<!--begin::Section-->
		<div class="d-flex align-items-center">
			<!--begin::Pic-->
			<div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
				<i class="fas fa-cog fa-3x"></i>
			</div>
			<!--end::Pic-->
			<!--begin::Info-->
			<div class="d-flex flex-column mr-auto">
				<!--begin: Title-->
				<p class="card-title text-primary font-weight-bolder font-size-h5 mb-1">{{ trans_choice('general.order',1)}} {{ data_get($work,'order.ref_code') }}</p>
				<a href="{{ route('machines.show', $work->machine->uuid) }}" class="text-muted font-weight-bold">{{ $work->machine->type->name }} {{ $work->machine->name }}</a>
				<!--end::Title-->
			</div>
			<!--end::Info-->

		</div>
		<!--end::Section-->
		<!--begin::Content-->
		<div class="d-flex flex-wrap mt-14">
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="d-block font-weight-bold mb-4">{{__('production.date_start')}}</span>
				<span class="btn btn-light-warning btn-sm font-weight-bold btn-upper btn-text">{{ formatDateTime($work->date_start)}}</span>
			</div>
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="d-block font-weight-bold mb-4">{{__('production.date_end')}}</span>
				<span class="btn btn-light-success btn-sm font-weight-bold btn-upper btn-text">{{ formatDateTime($work->date_stop)}}</span>
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="font-weight-bolder mb-4"><i class="fas fa-boxes"></i> {{ trans_choice('production.piece',2)}}</span>
				<span class="font-weight-bolder font-size-h5 pt-1">
				<span class="font-weight-bold text-dark-50">{{ $work->processes }}
			</div>
			<!--end::Item-->

		</div>
		<!--end::Content-->

		<!--begin::Text-->
		<p><strong>{{ __('general.description')}}</strong></p>
		{{ $work->description}}
		<hr />
		<p><strong>Programma</strong><br />{{ $work->program_name}}</p>
		<!--end::Text-->

		<!--begin::Blog-->
		<div class="d-flex flex-wrap mt-15">
			<!--begin: Item-->
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="font-weight-bolder mb-4"><i class="fa fa-clock"></i> {{ __('production.total_time')}}</span>
				<span class="font-weight-bolder font-size-h5 pt-1">
				<span class="font-weight-bold text-dark-50">{{ $work->total_time}}
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="font-weight-bolder mb-4"><i class="fas fa-tachometer-alt"></i> {{ __('production.energy_consumed')}}</span>
				<span class="font-weight-bolder font-size-h5 pt-1">
				<span class="font-weight-bold text-dark-50">{{ $work->energy_consumed}} KW
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="font-weight-bolder mb-4"><i class="fa fa-fill-drip"></i> {{ __('production.fuel')}}</span>
				<span class="font-weight-bolder font-size-h5 pt-1">
				<span class="font-weight-bold text-dark-50">{{ $work->fuel}} Lt
			</div>
			<!--end::Item-->


		</div>
		<!--end::Blog-->

		<!--begin::Blog2-->
		@if($work->info)
	 		<h5 class="text-lead mb-5 "><i class="flaticon-interface-1"></i> {{ trans_choice('production.parameter',2)}}</h5>
			<ul>
				@forelse($work->info as $key => $value)
					@if(is_array($value))
							@forelse($value as $k => $v)
									<li>
										<span class="font-weight-bolder mb-4">{{ str_replace('_',' ',$key) }} - {{ str_replace('_',' ',$k) }}: </span>
										<span class="font-weight-bolder font-size-h5 pt-1">
										<span class="font-weight-bold text-dark-50">{{ $v }}
									</li>
							@endforeach
					@else
							<!--begin::Item-->
							<li>
								<span class="font-weight-bolder mb-4">{{ str_replace('_',' ',$key) }}</span>
								<span class="font-weight-bolder font-size-h5 pt-1">
								<span class="font-weight-bold text-dark-50">{{ $value }}
							</li>
							<!--end::Item-->
					@endif
				@endforeach
			</ul>


		@endif
		<!--end::Blog2-->
		<small class="float-left">{{__('general.created_at')}}: {{ convertToLocal($work->created_at) }}</small>
		<small class="float-right">{{__('general.updated_at')}}: {{ convertToLocal($work->updated_at) }}</small>
	</div>
	<!--end::Body-->
</div>
