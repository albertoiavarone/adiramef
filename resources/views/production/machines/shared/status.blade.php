<div class="card mb-5 ">
    <div class="card-header bg-light">
        <i class="flaticon-info"></i> {{ __('general.status') }}
    </div>
    <div class="card-body  pl-0">
      {{ echoArrayLabelLang($status_machine['data'] , isset($machine->options['class']) ? $machine->options['class'] : null ) }}
    </div>
</div>
