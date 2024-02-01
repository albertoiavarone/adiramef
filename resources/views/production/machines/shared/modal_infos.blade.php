<!-- Modal Show-->
<div class="modal fade" id="Modal-Infos" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-Infos"><strong class="text-primary">Info Dispositivo</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" >
                @if( data_get($machine, 'infos.info') )
                  {!! echoArray($machine->infos->info) !!}
                @else
                  {{ __('general.data_not_found')}}
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">{{__('general.close')}}</button>
            </div>
        </div>
    </div>
</div>
