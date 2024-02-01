<div class="btn-group">
  <button type="button" onclick="ajax_req('{{ route('work.details') }}','{{$work->uuid}}','{{ trans_choice('production.work',1).' #'.$work->code}}')"
      class="btn btn-sm btn-outline-primary btn-icon">
      <i class="fa fa-wrench"></i>
  </button>
  @can('works_d')
	  <button class="btn btn-sm btn-outline-danger btn-icon ml-1" onclick="show_confirm_delete('work-delete-{{$work->uuid}}')"><i class="fa fa-trash"></i></button>
		<form method="post" id="work-delete-{{ $work->uuid }}" action="{{ route('works.destroy',$work->uuid) }}">
			@csrf
			{{ method_field('DELETE') }}
		</form>
  @endcan
</div>
