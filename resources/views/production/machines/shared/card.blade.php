<div class="card ">
    <div class="card-header text-center  bg-light">
        {{ $machine->name }}
    </div>
    <div class="card-body text-center">
        <img class="mb-5" src="{{ asset( !is_null($machine->type->logo_path) ? 'storage/'.$machine->type->logo_path : 'assets/media/img/no_image.png') }}"  style="max-height:40px">
        <p class="mb-5">{{__('production.serial_number')}}: {{ $machine->serial_number }}</p>
        <a href="{{ route('machines.show', $machine->uuid)}}" class="btn btn-outline-secondary btn-sm btn-block"><i class="fa fa-info-circle"></i> Info</a>
    </div>
</div>
