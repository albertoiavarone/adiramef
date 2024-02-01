<div class="row">
    <div class="col-md-4">
      {!! view('production.syncs.shared.last_position', compact('machine')) !!}

        <div class="card mb-5 ">
            <div class="card-header  bg-light"><i class="flaticon-statistics"></i> Info Dispositivo</div>
            <div class="card-body">
              <p>
                Ultimo aggiornamento Dispositivo:
                <br />{{ $machine->infos ? convertToLocal($machine->infos->updated_at) : 'n.d.'}}
              </p>
              <btn class="btn btn-outline-primary btn-sm btn-block" data-toggle="modal" data-target="#Modal-Infos"><i class="fa fa-info-circle"></i> Info Dispositivo</btn>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        {!! view('home.shared.map', compact('positions')) !!}
    </div>
</div>
