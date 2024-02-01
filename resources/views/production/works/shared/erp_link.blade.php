@if($work->work_productions->count() > 0)
  <ul class="pl-2">
    @foreach($work->work_productions as $work_productions)
      <li>
        Doc. {{ $work_productions->docmagt_num}} del {{ \Carbon\Carbon::parse($work_productions->docmagt_dtuk)->format('d/m/Y')  }}#Riga&nbsp;{{ $work_productions->docmagrig_nriga}}
      </li>
    @endforeach
  </ul>
@endif
