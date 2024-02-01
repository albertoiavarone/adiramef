@extends('layout.app')
@section('title','Home')
@section('content')
    @if(session('login-success'))
        <div class="alert alert-success" role="alert">
            {{ session('login-success') }}
        </div>
    @endif
    @include('home.backoffice')
@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent
    <script>
        /*    START:    machine Ping for health ceck     */
        var machines = [];
        var index = 0;
        @forelse($machines as $key => $machine)
            @if(!$machine->gps)
              machines[index] = '{{$machine->uuid}}';
              index++;
            @endif
        @endforeach

        var loading_html = '<span class="text-warning"><i class="fa fa-spinner fa-spin text-warning"></i></span>';
        counter = 0;
        timer = setInterval(function(){
                $('#box-health-'+machines[counter]).html(loading_html);
                $('#time-refresh-'+machines[counter]).html(loading_html);
                checkMachine(machines[counter]);
                counter++
                if (counter === machines.length) {
                      counter = 0;
                }
          }, 30000);

        function checkMachine(uuid) {

            $.post( '{{ route('machine.ping') }}' ,{
                    _token: "{{ csrf_token() }}",
                    uuid : uuid
            }).done(function( response ) {
                //console.log(response)
                $('#box-health-'+response.uuid).html('<span><i class="fas fa-'+(response.status ? 'check':'times')+'-circle text-'+(response.status ? 'success':'danger')+'"></i></span>');
                if(response.last_work){
                    var last_work_html = '<ul class="list-unstyled pl-5 mt-3 font-size-sm">'+
                                                '<li>{{ __('production.date_start') }}: '+response.last_work.date+'</li>'+
                                                '<li>{{ trans_choice('production.program',1) }}: '+response.last_work.type+'</li>'+
                                                '<li>{{ __('production.actual_time') }}: '+response.last_work.message+'</li>'+
                                            '</ul>';

                    $('#last-work-'+response.uuid).html(last_work_html);
                } else {
                    $('#last-work-'+response.uuid).html('<ul class="list-unstyled pl-5 mt-3 "><li>{{ __('general.data_not_found')}}</li></ul>');
                }

                if(response.last_log){
                    var last_log_html = '<ul class="list-unstyled pl-5 mt-3 font-size-sm">'+
                                                '<li>{{ __('production.date_start') }}: '+response.last_log.date+'</li>'+
                                                '<li>{{ __('general.type') }}: '+response.last_log.type+'</li>'+
                                                '<li>{{ trans_choice('general.message',1) }}: '+response.last_log.message+'</li>'+
                                            '</ul>';
                    $('#last-log-'+response.uuid).html(last_log_html);
                } else {
                    $('#last-log-'+response.uuid).html('<ul class="list-unstyled pl-5 mt-3"><li>{{ __('general.data_not_found')}}</li></ul>');
                }
                var today = new Date();
                var now = today.toLocaleString();
                $('#time-refresh-'+uuid).html(now);
            })
        }
        /*    END:    machine Ping for health ceck     */

    </script>
@endsection
