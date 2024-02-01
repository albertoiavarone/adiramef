@can('users_u')
<a href="{{ route('users.edit', $user->uuid ) }}"
    class="btn btn-sm btn-primary btn-icon">
    <i class="fa fa-edit"></i>
</a>
@endcan
@can('users_d')
  @if(auth()->id() != $user->id)
    <button class="btn btn-sm btn-danger btn-icon" onclick="show_confirm_delete('user-delete-{{ $user->uuid }}')">
        <i class="fa fa-trash"></i>
    </button>
    <form method="post" id="user-delete-{{ $user->uuid }}" action="{{ route('users.destroy',$user->uuid) }}">
        @csrf
        {{ method_field('DELETE') }}
    </form>
  @endif
@endcan
