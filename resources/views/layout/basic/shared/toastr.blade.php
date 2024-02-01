@if(session('success'))
    <script>
        $(document).ready(function(){
            toastr.success('{{session('success')}}', "");
        });
    </script>
@elseif(session('error'))
    <script>
        $(document).ready(function(){
            toastr.error('{{session('error')}}', "");
        });
    </script>
@endif
