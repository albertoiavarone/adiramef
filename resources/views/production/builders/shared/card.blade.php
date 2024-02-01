
    <div class="card shadow-sm ">
        <div class="card-header mt-5">
            <img class="float-left" src="{{ asset( !is_null($builder->logo_path) ? 'storage/'.$builder->logo_path : 'assets/media/img/no_image.png') }}" alt="{{$builder->name}}" style="max-height:50px">
            <div class="btn-group float-right">
                <a href="{{ route('builders.edit', $builder->uuid ) }}" class="btn btn-outline-secondary btn-sm btn-icon"><i class="fa fa-edit"></i></a>
                @can('builders_d')
                  @if( $builder->machines->count() == 0)
                    <button class="btn  btn-outline-secondary btn-sm btn-icon " onclick="show_confirm_delete('builder-delete-{{$builder->uuid}}')"><i class="fa fa-trash"></i></button>
                    <form method="post" id="builder-delete-{{$builder->uuid}}" action="{{ route('builders.destroy',$builder->uuid) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                    </form>
                  @else
                      <button class="btn btn-sm btn-outline-light btn-icon" onclick="promptAlert('{{ __('production.not_permit_builder_delete') }}')">
                          <i class="fa fa-trash"></i>
                      </button>
                  @endif
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse( $builder->machines as $machine )
                    <div class="col-md-6 mb-5">
                        @include('production.machines.shared.card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
