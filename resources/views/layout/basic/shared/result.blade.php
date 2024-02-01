

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $message)
            {{ $message }}<br>
        @endforeach
    </div>
@endif
