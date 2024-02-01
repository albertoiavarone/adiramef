<!-- Modal Show-->
<div class="modal fade" id="Modal-Add-Manteinance" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-Add-Manteinance"><strong class="text-primary">{{ __('general.add')}} {{ trans_choice('production.manteinance',1)}}</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" >
              {!! BootForm::open()
                     ->action(route('manteinances.store', $machine->uuid))
                     ->post()
                     ->id('form-store')
                     ->multipart()
              !!}


                {!! BootForm::text(trans_choice('general.title',1), 'title')->id('title')->required()->placeholder('es. Omologazione') !!}

                <div class="form-group">
                    <label>{{ trans_choice('production.manteinance_type',1) }}</label>
                    <select class="form-control" name="type" id="manteinance_type" required>
                        <option value=""></option>
                        @forelse($manteinance_types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                {!! BootForm::text(__('general.expire_date'),'expire_date' )->id('expire_date')->class('form-control datepicker')
                                    ->placeholder(__('general.select'))
                                    ->required()
                !!}

                <div class="form-group">
                    <label>{{ __('general.status') }}</label>
                    <select class="form-control" name="status" id="manteinance_status" required>
                        <option value=""></option>
                        @forelse($manteinance_statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>{{ trans_choice('documents.document_upload',1)}}</label>
                    <input type="file" class="form-control" name="uploaded" id="uploaded" accept=".pdf,.doc,.docx,.doc,.jpg,.jpeg,.xls,.xlsx">
                </div>

                {!! BootForm::textarea(__('general.notes'), 'notes') !!}
                <hr />
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fa fa-save"></i> {{__('general.save')}}
                </button>
                {!! BootForm::hidden('machine_uuid')->value($machine->uuid) !!}
                {!! BootForm::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">{{__('general.close')}}</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        set_datepicker('expire_date');
        set_select2('manteinance_type');
        set_select2('manteinance_status');
        refreshInputRequired();
    });
</script>
