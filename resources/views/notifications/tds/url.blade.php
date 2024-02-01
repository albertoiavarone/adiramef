@if($notification->data['url'])
    <button class="btn btn-outline-primary btn-sm btn-icon" onclick="markAsReadNotification('{{$notification->id}}', '{{ $notification->data['url'] }}')" >
        <i class="fa fa-info-circle"></i>
    </button>
@endif
