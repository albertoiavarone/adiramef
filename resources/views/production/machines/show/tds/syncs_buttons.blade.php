
<button type="button"
    onclick="ajax_req('{{ route('sync.details') }}','{{$sync->uuid}}','{{ trans_choice('production.sync',1)}}')"
    class="btn btn-sm btn-secondary btn-icon">
    <i class="fa fa-info-circle"></i>
</button>
