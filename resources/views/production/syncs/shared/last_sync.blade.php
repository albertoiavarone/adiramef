<div class="card mb-5 ">
    <div class="card-header  bg-light">{{ trans_choice('production.sync',1)}} {{__('production.production')}}</div>
    <div class="card-body">
        @if($machine->sync_production)
            @if($machine->last_sync())
                <div class="d-flex align-items-center justify-content-between mb-2">
                       <span class="font-weight-bold mr-2">{{ __('general.sync_on')}}:</span>
                            <br /><span class="text-muted">{{ $machine->last_sync()->id ? convertToLocal($machine->last_sync()->created_at) : '--' }}</span>
                 </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                       <span class="font-weight-bold mr-2">{{trans_choice('general.response',1)}}:</span>
                            <span class="text-muted">
                        {{ $machine->last_sync()->status ? __('general.success') : __('general.success') }}
                    </span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <button class="btn btn-sm btn-outline-primary" onclick="$('#machine-sync-prod-{{$machine->uuid}}').submit()"><i class="fa fa-sync"></i> Force Sync</button>
                </div>
            @else
                <p class="text-danger">{{__('general.data_not_found')}}</p>
            @endif
        @else
            <p class="text-warning">{{__('production.sync_not_allowed')}}</p>
        @endif
    </div>
</div>
