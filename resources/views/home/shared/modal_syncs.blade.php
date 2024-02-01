<!-- Modal Show-->
<div class="modal fade" id="Modal-Force-Sync" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-Force-Sync"><strong class="text-primary">Sync {{ trans_choice('production.machine',2)}}</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" >

                <div id="response-box">
                  @if(!empty($machines))
                  <ul>
                    @forelse($machines as $machine)
                      @if($machine->gps)
                        <li class="mb-3">
                          {{ $machine->name }}: <small><i class="far fa-clock font-size-xs ml-5"></i> {{__('production.last_log')}}: {{ $machine->last_position() ? convertToLocal($machine->last_position()->created_at) : 'n.d.'}}</small>
                          <br /><small>{{ $machine->type->name }} {{ $machine->builder->name }} Matr. {{ $machine->serial_number }} </small>
                        </li>
                      @endif
                    @endforeach
                    </ul>
                    <hr />
                    <p class="alert alert-light text-justify">
                      Con questo comando puoi forzare la sincronizzazione dei dispositivi GPS collegati ai mezzi.
                      <br />Può capitare che i dispositivi aggiornino e/o inviino dati solo in particaolri condizioni (es. accensione, funzionamento, etc).
                      <br />Questo potrebbe spiegare il fatto che l'ultimo aggiornamento presente in macchina sia "datato".
                      <br />Si consiglia di non utilizzare questo comando "a ripetizione" perchè il provider dei servizi potrebbe momentaneamente bloccare le continue richieste.
                    </p>
                    <div class="text-center">
                      <button class="btn btn-sm btn-outline-secondary" onclick="refreshNow()"><i class="fas fa-sync"></i> {{ __('general.refresh')}}</button>
                    </div>
                  @else
                    {{ __('general'.data_not_found)}}
                  @endif
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">{{__('general.close')}}</button>
            </div>
        </div>
    </div>
</div>
