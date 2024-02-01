
    <div class="card shadow-sm ">
        <div class="card-header mt-5">
            <img class="float-left mr-5" src="{{ asset( !is_null($provider->logo_path) ? 'storage/'.$provider->logo_path : 'assets/media/img/no_image.png') }}" alt="{{$provider->name}}" style="max-height:50px">
            <div class="btn-group float-right">
              @can('providers_u')
                <a href="{{ route('providers.edit', $provider->uuid ) }}" class="btn btn-outline-secondary btn-sm btn-icon"><i class="fa fa-edit"></i></a>
              @endcan
            </div>
        </div>
        <div class="card-body">
          @if($provider->machines->count() > 0)
            <div class="row">
                @forelse( $provider->machines as $machine )
                    <div class="col-md-6">
                        @include('production.machines.shared.card')
                    </div>
                @endforeach
            </div>
          @else
            <p class="text-muted">Nessun dispositivo associato a questo servizio...</p>
          @endif
        </div>
    </div>
