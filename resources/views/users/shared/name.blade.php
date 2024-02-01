<span style="width: 250px;">
    <div class="d-flex align-items-center">
        <div class="symbol symbol-40 symbol-sm symbol-circle flex-shrink-0">
            <img src="{{ asset( !is_null($user->image) ? 'storage/'.$user->image : 'assets/media/users/blank.png') }}">
        </div>
        <div class="ml-4">
            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">{{ $user->name }}</div>
            <div class="font-weight-bold text-muted">{{__('users.code')}}: {{$user->code}}</div>
            <div class="font-weight-bold text-muted">{{$user->email}}</div>
        </div>
    </div>
</span>
