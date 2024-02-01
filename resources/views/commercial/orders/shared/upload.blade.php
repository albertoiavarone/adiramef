
<div class="card">
  <div class="card-header bg-light">{{ __('general.upload')}} {{trans_choice('commercial.document',1)}}
  </div>
  <div class="card-body">
    {!! BootForm::open()->action(route('order.attachment.save', $order->uuid))->post()->id('uploadFileFrm')->multipart() !!}
    <div class="row">
        <div class="col-md-6">
            {!! BootForm::text(__('general.label'),'label' )->id('label')->class('form-control')->placeholder('es. Visura')->required()!!}
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>File {{ trans_choice('commercial.attachment',1)}}</label>
                <input type="file" class="form-control" name="attachment" id="attachment" accept=".pdf,.doc,.docx,.xls,.xlsx,.txt" required>
            </div>
        </div>
    </div>
    <p class="text-left">
        <button type="submit" class="btn btn-outline-primary font-weight-bold">
            <i class="fa fa-upload"></i> {{__('general.upload')}}
        </button>
    </p>
    {!! BootForm::close() !!}
  </div>
</div>
