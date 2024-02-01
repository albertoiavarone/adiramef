<div class="card mb-5 shadow-sm ">
    <div class="card-header text-center">
        <img class="float-left" src="{{ asset( !is_null($machine->builder->logo_path) ? 'storage/'.$machine->builder->logo_path : 'assets/media/img/no_image.png') }}" alt="{{$machine->builder->name}}" style="max-height:15px">
        <h6 class="float-left ml-10" >{{ $machine->name }}</h6>
        <div class="btn-group float-right">
            @can('machines_u')
            <a href="{{ route('machines.edit', $machine->uuid ) }}" class="btn btn-outline-secondary btn-sm btn-icon"><i class="fa fa-edit"></i></a>
            @endcan
            @can('machines_d')
            <button class="btn  btn-outline-secondary btn-sm btn-icon " onclick="show_confirm_delete('machine-delete-{{$machine->uuid}}')"><i class="fa fa-trash"></i></button>
            <form method="post" id="machine-delete-{{$machine->uuid}}" action="{{ route('machines.destroy',$machine->uuid) }}">
                @csrf
                {{ method_field('DELETE') }}
            </form>
            @endcan
        </div>
    </div>
    <div class="card-body text-center">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset( !is_null($machine->type->logo_path) ? 'storage/'.$machine->type->logo_path : 'assets/media/img/no_image.png') }}"  style="max-height:60px">
                @if($machine->gps)
                <img class="mt-4" src="{{ asset( !is_null($machine->provider->logo_path) ? 'storage/'.$machine->provider->logo_path : '') }}"  style="max-height:50px">
                @endif
            </div>
            <div class="col-md-8">
                <dl class="row text-left">
                    <dt class="col-md-6">{{ trans_choice('production.builder',1) }}</dt>
                    <dd class="col-md-6">{{ $machine->builder->name }}</dd>
                    <dt class="col-md-6">{{ trans_choice('production.machine_type',1)}}</dt>
                    <dd class="col-md-6">{{ $machine->type->name }}</dd>
                    <dt class="col-md-6">{{ __('production.serial_number') }}</dt>
                    <dd class="col-md-6">{{ $machine->serial_number }}</dd>
                </dl>
                <a href="{{ route('machines.show', $machine->uuid)}}" class="btn btn-outline-primary btn-sm btn-block"><i class="fa fa-info-circle"></i> Info</a>

            </div>
        </div>
    </div>
</div>
