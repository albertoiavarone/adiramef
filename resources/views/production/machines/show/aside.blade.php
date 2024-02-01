    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body pt-4">
            <div class="d-flex justify-content-end">
				<div class="dropdown dropdown-inline">
					<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="ki ki-bold-more-hor"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
						<!--begin::Navigation-->
						<ul class="navi navi-hover py-5">
							<li class="navi-item">
								<a href="{{route('machines.edit', $machine->uuid)}}" class="navi-link" >
									<span class="navi-icon">
										<i class="flaticon2-drop"></i>
									</span>
									<span class="navi-text">{{__('general.edit')}}</span>
								</a>
							</li>
							<li class="navi-item">
								<a href="#" class="navi-link" onclick="$('#machine-sync-prod-{{$machine->uuid}}').submit()">
									<span class="navi-icon">
										<i class="flaticon2-list-3"></i>
									</span>
									<span class="navi-text">{{__('production.sync_production')}}</span>
								</a>
							</li>
						</ul>
						<!--end::Navigation-->
					</div>
				</div>
			</div>
            <!--begin::Machine-->
			<div class="d-flex">
				<div class="symbol symbol-40  mr-1 align-self-start align-self-xxl-center">
            <img class="img-fluid" src="{{ asset( !is_null($machine->type->logo_path) ? 'storage/'.$machine->type->logo_path : 'assets/media/img/no_image.png') }}"  />
            @if(!is_null($machine->builder->logo_path))
            <p>
                <img class="img-fluid" src="{{ asset('storage/'.$machine->builder->logo_path) }} " style="max-width:80px"  />
            </p>
            @endif
				</div>
				<div>
					<a href="#" class="font-weight-bolder font-size-h3 text-dark-75 text-hover-primary ">{{$machine->name}}</a>
				</div>
			</div>
			<!--end::Machine-->

            <!--begin::Details-->
			<div class="py-9">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="font-weight-bold mr-2">{{ trans_choice('production.machine_type',1)}}:</span>
					<span class="text-muted text-hover-primary">{{ $machine->type->name }}</span>
				</div>
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="font-weight-bold mr-2">{{ trans_choice('production.builder',1)}}:</span>
					<span class="text-muted text-hover-primary">{{ $machine->builder->name }}</span>
				</div>
				<div class="d-flex align-items-center justify-content-between mb-2">
					<span class="font-weight-bold mr-2">{{ __('production.serial_number') }}:</span>
					<span class="text-muted">{{ $machine->serial_number }}</span>
				</div>
			</div>
			<!--end::Details-->
			<!--begin::Nav-->
			<div class="navi navi-bold navi-hover navi-active navi-link-rounded">
				<div class="navi-item mb-2">
					<a href="{{route('machines.show',$machine->uuid)}}" class="btn btn-outline-secondary btn-block ">
						<span class="navi-text font-size-lg">{{ __('general.overview')}}</span>
            <span class="navi-icon float-right mr-2"><i class="flaticon2-magnifier-tool"></i></span>
					</a>
				</div>
        @if($machine->gps)
        <div class="navi-item mb-2">
          <button type="button" onclick="content_show('telemetry')"  class="btn btn-outline-secondary btn-block ">
            <span class="navi-text font-size-lg">{{ __('production.telemetry') }}</span>
            <span class="navi-icon float-right mr-2"><i class="flaticon-placeholder"></i></span>
          </button>
        </div>
        @endif
				<div class="navi-item mb-2">
					<button type="button" onclick="content_show('works')"  class="btn btn-outline-secondary btn-block ">
						<span class="navi-text font-size-lg">{{ trans_choice('production.work',2)}}</span>
            <span class="navi-icon float-right mr-2"><i class="flaticon-cogwheel"></i></span>
					</button>
				</div>
        <div class="navi-item mb-2">
          <button type="button" onclick="content_show('orders')"  class="btn btn-outline-secondary btn-block ">
            <span class="navi-text font-size-lg">{{ trans_choice('commercial.order',2)}}</span>
            <span class="navi-icon float-right mr-2"><i class="flaticon-layers"></i></span>
          </button>
        </div>
				<div class="navi-item mb-2">
            @if($machine->sync_production)
					     <button type="button" onclick="content_show('syncs')"  class="btn btn-outline-secondary btn-block ">
            @else
               <button type="button" onclick="promptAlert('{{__('production.sync_not_allowed')}}')" class="btn btn-outline-light btn-block ">
            @endif
						<span class="navi-text font-size-lg">{{ trans_choice('production.sync',2)}}</span>
            <span class="navi-icon float-right mr-2"><i class="flaticon-refresh"></i></span>
					</button>
				</div>
        @if(!$machine->gps)
        <div class="navi-item mb-2">
					<button type="button" onclick="content_show('schedule')"  class="btn btn-outline-secondary btn-block ">
						<span class="navi-text font-size-lg">{{ trans_choice('production.schedule',1)}}</span>
            <span class="navi-icon float-right mr-2"><i class="flaticon-calendar-with-a-clock-time-tools"></i></span>
					</button>
				</div>
        @endif
        <div class="navi-item mb-2">
					<button type="button" onclick="content_show('manteinances')"  class="btn btn-outline-secondary btn-block ">
						<span class="navi-text font-size-lg">{{ trans_choice('production.manteinance',1)}}</span>
            <span class="navi-icon float-right mr-2"><i class="flaticon-calendar-with-a-clock-time-tools"></i></span>
					</button>
				</div>
        <div class="navi-item mb-2">
					<button type="button" onclick="content_show('attachments')"  class="btn btn-outline-secondary btn-block ">
						<span class="navi-text font-size-lg">{{ trans_choice('commercial.attachment',2)}}</span>
            <span class="navi-icon float-right mr-2"><i class="flaticon-folder"></i></span>
					</button>
				</div>
			</div>
			<!--end::Nav-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Profile Card-->
    <form method="post" id="machine-sync-prod-{{$machine->uuid}}" action="{{ route('machine.sync') }}">
        <input type="hidden" name="uuid" value="{{$machine->uuid}}" />
        @csrf
        {{ method_field('POST') }}
    </form>
    <form method="post" id="machine-sync-dia-{{$machine->uuid}}" action="{{ route('machine.sync.diagnostics') }}">
        <input type="hidden" name="uuid" value="{{$machine->uuid}}" />
        @csrf
        {{ method_field('POST') }}
    </form>
