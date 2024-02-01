<button type="button" 
    onclick="ajax_req('{{ route('program.details') }}','{{$program->uuid}}','{{ trans_choice('production.program',1)}}')"
    class="btn btn-sm btn-secondary btn-icon">
    <i class="fa fa-info-circle"></i>
</button>
