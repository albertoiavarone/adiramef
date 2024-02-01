<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>{{__('general.created_at')}}</th>
        <th>{{__('users.user')}}</th>
        <th>{{__('general.status')}}</th>
        <th>{{__('general.notes')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->logs as $log)
      <tr>
        <td>{{ convertToLocal($log->created_at)}}</td>
        <td>{{ data_get($log, 'user.name') }}</td>
        <td class="text-{{ $log->status->class }}">{{__('commercial.status_'.$log->status->name)}}</td>
        <td>{{ $log->notes }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
