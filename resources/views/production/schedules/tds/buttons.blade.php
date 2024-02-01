<button type="button" onclick="ajax_req('{{ route('schedule.details') }}','{{$schedule->uuid}}','{{ trans_choice('production.schedule',1)}}')"
    class="btn btn-sm btn-secondary btn-icon">
    <i class="fa fa-info-circle"></i>
</button>
