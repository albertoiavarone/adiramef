@if($notification->read_at)
    <span class="badge badge-success">
        {{ trans_choice('notifications.readed', 1)}}
    </span>
@else
    <div id="read_info_{{$notification->id}}">
        <span class="badge badge-warning" >{{ trans_choice('notifications.unreaded', 1)}}</span>
        <button class="btn btn-sm btn-secondary btn-icon" onclick="markAsReadNotification('{{$notification->id}}', '{{route('my.notifications')}}')" title="{{__('notifications.mark_as_read')}}">
            <i class="fa fa-check-circle"></i>
        </button>
    </div>
@endif
