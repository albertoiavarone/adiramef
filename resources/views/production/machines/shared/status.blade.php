<div class="card mb-5 ">
    <div class="card-header bg-light">
        <i class="flaticon-info"></i> {{ __('general.status') }}
        <small class="float-right">{{ date('d/m/Y H:i:s')}}</small>
    </div>
    <div class="card-body  pl-0">
      {{ echoArrayLabelLang($status_machine['data'] , isset($machine->options['class']) ? $machine->options['class'] : null ) }}
    </div>
</div>
