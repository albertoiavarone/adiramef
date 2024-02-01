<a href="{{ route('cities.show', $city->id ) }}"
    class="btn btn-sm btn-secondary btn-icon">
    <i class="fa fa-info-circle"></i>
</a>
<a href="{{ route('cities.edit', $city->id ) }}"
    class="btn btn-sm btn-primary btn-icon">
    <i class="fa fa-edit"></i>
</a>
<button class="btn btn-sm btn-danger btn-icon" onclick="show_confirm_delete('city-delete-{{ $city->id }}')">
    <i class="fa fa-trash"></i>
</button>
<form method="post" id="city-delete-{{ $city->id }}" action="{{ route('cities.destroy',$city->id) }}">
    @csrf
    {{ method_field('DELETE') }}
</form>
