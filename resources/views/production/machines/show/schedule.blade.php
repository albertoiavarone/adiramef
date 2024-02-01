<div class="card mb-10 ">
    <div class="card-header  bg-light"><i class="flaticon-calendar-with-a-clock-time-tools"></i> {{ trans_choice('production.schedule',1)}}</div>
    <div class="card-body">
        {{ __('production.schedule_info_box')}}
        <hr />
        @if(isset($machine->options['view_schedule_name']))
          @include('production.machines.shared.schedule.'.$machine->options['view_schedule_name'])
        @else
          <p>
            Nessuna Scheda di Controllo associata a questo dispositivo
          </p>
        @endif
    </div>
</div>

@if($machine->schedules && isset($machine->options['show_scheduled']))
    {!! view('production.machines.shared.schedule.scheduled', compact('machine'))!!}
@endif

@include('layout.basic.js.graphs')
<script>
    $(document).ready(function(){
        //
    });
</script>
