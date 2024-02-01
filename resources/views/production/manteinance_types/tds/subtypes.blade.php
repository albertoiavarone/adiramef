<ul>
    @if($type->subtypes->count() > 0)
        @foreach($type->subtypes as $subtype)
            <li>
                {{ $subtype->name }}
            </li>
        @endforeach
    @endif
</ul>
