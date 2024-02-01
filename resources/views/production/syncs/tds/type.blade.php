@if($sync->type=='prod')
    <span>{{ __('production.production')}}</span>
@elseif($sync->type=='info')
    <span>Info dispositivo</span>
@elseif($sync->type=='telemetry')
    <span>Telemetria</span>
@elseif($sync->type=='dia')
    <span>{{ __('production.diagnostics')}}</span>
@endif
