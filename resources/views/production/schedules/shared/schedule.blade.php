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
				<p class="card-title text-primary font-weight-bolder font-size-h5 mb-1">
                    {{ $schedule->name }}
                </p>
				<a href="{{ route('machines.show', $schedule->machine->uuid) }}" class="text-muted font-weight-bold">{{ $schedule->machine->type->name }} {{ $schedule->machine->name }}</a>
				<!--end::Title-->
			</div>
			<!--end::Info-->

		</div>
		<!--end::Section-->
		<!--begin::Content-->
		<div class="d-flex flex-wrap mt-14">
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="d-block font-weight-bold mb-4">{{__('production.date_start')}}</span>
				<span class="btn btn-light-warning btn-sm font-weight-bold btn-upper btn-text">{{ formatDateTime($schedule->date_start)}}</span>
			</div>
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="d-block font-weight-bold mb-4">{{__('production.date_end')}}</span>
				<span class="btn btn-light-success btn-sm font-weight-bold btn-upper btn-text">{{ formatDateTime($schedule->date_stop)}}</span>
			</div>
		</div>
		<!--end::Content-->

		<!--begin::Blog2-->
		@if($schedule->info)
		<h5 class="text-lead mb-5 "><i class="flaticon-interface-1"></i> {{ trans_choice('production.parameter',2)}}</h5>
		<div class="d-flex flex-wrap">
			@forelse($schedule->info as $key => $value)
			<!--begin::Item-->
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="font-weight-bolder mb-4">{{$key}}</span>
				<span class="font-weight-bolder font-size-h5 pt-1">
				<span class="font-weight-bold text-dark-50">{!! nl2br($value) !!}
			</div>
			<!--end::Item-->
			@endforeach
		</div>
		@endif
		<!--end::Blog2-->
		<small class="float-left">{{__('general.created_at')}}: {{ convertToLocal($schedule->created_at) }}</small>
		<small class="float-right">{{__('general.updated_at')}}: {{ convertToLocal($schedule->updated_at) }}</small>
	</div>
	<!--end::Body-->
</div>
