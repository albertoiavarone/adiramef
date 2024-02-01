<div class="row">
    <div class="col-md-4">
        @if($status_machine)
          {!! view('production.machines.shared.status', compact('machine','status_machine')) !!}
        @endif
        <div class="card mb-5 ">
            <div class="card-header  bg-light"><i class="flaticon-statistics"></i> {{__('production.last_work')}}</div>
            <div class="card-body">
                @if($last_work)
                    <p class="float-left">
                        <strong>{{ trans_choice('general.order',1)}}:</strong>&nbsp;{{ data_get($last_work, 'order.code')}}
                        <br><strong>{{ __('production.date_start')}}:</strong>&nbsp;{{ $last_work['date_start'] ? formatDateTime($last_work['date_start']) : 'n.d.' }}
                    </p>
                    <a class="btn btn-sm btn-outline-secondary float-right" href="#"
                        onclick="ajax_req('{{ route('work.details') }}','{{ $last_work['uuid'] }}','{{ trans_choice('production.work',1)}}')"
                        <i class="fa fa-info-circle"></i> Info
                    </a>
                    @else
                    <p><i class="fa fa-times-circle"></i> {{ __('general.data_not_found')}}</p>
                @endif
            </div>
        </div>


        {!! view('production.syncs.shared.last_sync', compact('machine')) !!}

    </div>
    <div class="col-md-8">
        <div class="card card-custom gutter-b">
			<!--begin::Header-->
			<div class="card-header h-auto">
				<!--begin::Title-->
				<div class="card-title py-5">
					<h3 class="card-label">{{ trans_choice('production.work',2)}} {{ $machine->name }}</h3>
				</div>
				<!--end::Title-->
			</div>
			<!--end::Header-->
			<div class="card-body" style="position: relative;">
				<!--begin::Chart-->
				<div id="machine-data-chart" style="min-height: 365px;">
                </div>
    			<!--end::Chart-->
    			<div class="resize-triggers">
                    <div class="expand-trigger">
                        <div style="width: 634px; height: 418px;"></div>
                    </div>
                    <div class="contract-trigger"></div>
                </div>
            </div>
		</div>
    </div>
</div>

<!--end::Card-->
@include('layout.basic.js.graphs')
