
    <div class="card shadow-sm">
        <div class="card-header mt-5">
            <h4 class="float-left">{{$machine_type->name}}</h4>
            <div class="btn-group float-right">
                <a href="{{ route('machine-types.edit', $machine_type->uuid ) }}" class="btn btn-outline-secondary btn-sm btn-icon"><i class="fa fa-edit"></i></a>
                @can('machine_types_d')
                  @if( $machine_type->machines->count() == 0)
                      <button class="btn  btn-outline-secondary btn-sm btn-icon " onclick="show_confirm_delete('machine_type-delete-{{$machine_type->uuid}}')"><i class="fa fa-trash"></i></button>
                      <form method="post" id="machine_type-delete-{{$machine_type->uuid}}" action="{{ route('machine-types.destroy',$machine_type->uuid) }}">
                      @csrf
                      {{ method_field('DELETE') }}
                      </form>
                  @else
                      <button class="btn btn-sm btn-outline-light btn-icon" onclick="promptAlert('{{ __('production.not_permit_machine_type_delete') }}')">
                          <i class="fa fa-trash"></i>
                      </button>
                  @endif
                @endcan
            </div>
        </div>
        <div class="card-body text-center">
            <div class="row">
            @forelse( $machine_type->machines as $machine )
                <div class="col-md-6">
                    @include('production.machines.shared.card')
                </div>
            @endforeach
            </div>
        </div>
        <div class="card-footer d-flex text-right">
            <p>{{__('general.updated_at').' '.convertToLocal($machine_type->updated_at)}}</p>
        </div>
    </div>
