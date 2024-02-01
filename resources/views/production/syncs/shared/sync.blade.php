<div class="card card-custom gutter-b card-stretch">
	<!--begin::Body-->
	<div class="card-body">
		<!--begin::Section-->
		<div class="d-flex align-items-center">
			<!--begin::Pic-->
			<div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
				<i class="fa fa-sync"></i>
			</div>
			<!--end::Pic-->
			<!--begin::Info-->
			<div class="d-flex flex-column mr-auto">
				<!--begin: Title-->
				<p class="card-title text-primary font-weight-bolder font-size-h5 mb-1">
                    {{ view('production.syncs.tds.type', compact('sync')) }}
                </p>
				<a href="{{ route('machines.show', $sync->machine->uuid) }}" class="text-muted font-weight-bold">{{ $sync->machine->type->name }} {{ $sync->machine->name }}</a>

				<!--end::Title-->
			</div>
			<!--end::Info-->
		</div>
		<!--end::Section-->
		<!--begin::Content-->
		<div class="d-flex flex-wrap mt-14">
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="d-block font-weight-bold mb-4">{{__('general.date')}}</span>
				<span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">{{ $sync->ref_date ? formatDate($sync->ref_date, 'd/m/Y') : ''}}</span>
			</div>
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="d-block font-weight-bold mb-4">{{__('general.created_at')}}</span>
				<span class="btn btn-light-success btn-sm font-weight-bold btn-upper btn-text">{{ convertToLocal($sync->created_at)}}</span>
			</div>
			<div class="mr-12 d-flex flex-column mb-7">
				<span class="d-block font-weight-bold mb-4">{{__('general.status')}}</span>
				<p class="mb-7 mt-3 ">{{ $sync->status == 1 || $sync->status == 200 ? __('general.success') : __('general.error')}}</p>
			</div>
			<!--begin::Progress-->
			<!--end::Progress-->
		</div>
		<!--end::Content-->
		<!--begin::Text-->
		<span class="d-block font-weight-bold mb-4">{{trans_choice('general.message',1)}}</span>
		<p class="mb-7 mt-3 ">{!! $sync->message !!}</p>
		<!--end::Text-->
	</div>
	<!--end::Body-->

</div>
