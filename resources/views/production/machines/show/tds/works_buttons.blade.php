<button type="button" onclick="ajax_req('{{ route('work.details') }}','{{$work->uuid}}','{{ trans_choice('production.work',1)}}')"
    class="btn btn-sm btn-secondary btn-icon">
    <i class="fa fa-info-circle"></i>
</button>
