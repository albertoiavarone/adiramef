
<button type="button" onclick="ajax_req('{{ route('diagnostic.details') }}','{{ $diagnostic->uuid }}','{{ __('production.diagnostics')}}')"
    class="btn btn-sm btn-secondary btn-icon">
    <i class="fa fa-info-circle"></i>
</button>
