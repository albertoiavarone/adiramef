<div class="card mb-3 shadow-sm"  style="width: 100%;">
    <div class="card-header bg-light">
        <span class="float-left"><a href="{{ route('machines.show', $machine->uuid)}}">{{ $machine->name }}</a> </span>
        <span class="float-right" id="box-health-{{ $machine->uuid }}"></span>
    </div>
    <div class="card-header">
        <div class="d-flex">
            <!--begin::Item-->
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-flex align-items-center mr-2">
                    <div class="symbol symbol-20 symbol-lg-45 float-left mr-3">
                        <img src="{{ asset( !is_null($machine->type->logo_path) ? 'storage/'.$machine->type->logo_path : 'assets/media/img/no_image.png') }}">
                        <small>{{ $machine->builder->name }}</small>
                    </div>
                    <div class="ml-3">
                        <span class="text-lead">{{ $machine->type->name }}
                            <br />S/N {{ $machine->serial_number }}
                            <br />IP:{{ $machine->host}}
                        </span>
                    </div>
                </div>
            </div>
            <!--end::Item-->
        </div>
        <div class="clearfix"></div>


    </div>
    <div class="card-body p-2">
        <div class="card-body p-3">
            <span class=" ml-3 mb-2"><i class="far fa-calendar-check"></i> {{__('production.last_work')}}</span>
            @if($machine->last_work())
            <div id="last-work-{{ $machine->uuid }}">
                <ul class="list-unstyled pl-5 mt-3 font-size-sm">
                    <li>{{__('production.date_start')}}: {{ formatDatetime($machine->last_work()->date_end)}}</li>
                </ul>
            </div>
            @else
              <p><small class="ml-10 text-warning">{{__('general.data_not_found')}}</small></p>
            @endif
        </div>
    </div>
</div>
