@php
    $provinces = \App\Models\Geo\Province::all();
    if(!isset($action)){
        $action = 'user.detail.store';
    }
@endphp

{!! BootForm::open()
    ->post()
    ->action(route($action))
    ->id('add-user-detail')
 !!}
     <!-- start: Modal addUserDetail -->
    <div class="modal fade" id="addUserDetail" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserDetail">{{__('general.add')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {!! BootForm::hidden('user_uuid')->value($user->uuid)!!}

                     <div class="row BOX" id="box-FORM">
                         @include('users.modals.form_user_details.add.retail')
                     </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal">{{__('general.cancel')}}</button>
                    <button type="submit" class="btn btn-primary font-weight-bold" >{{__('general.save')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!--  end:Modal addUserDetail -->
    @if(isset($route_callback))
        <input type="hidden" name="route_callback" value="{{ $route_callback }}">
    @endif
{!! BootForm::close() !!}
<script>
    $(function(){
        set_select2('nation_id');
        set_select2('province_id');
        set_select2('city_id');
    });

    $('#province_id').change(function(){
        var url = "{{ url('geo/provinces/cities') }}/"+$(this).val();
        getAjaxDataSelectOptions($(this).attr('id'), url, 'city_id');
    });
    /* -----Rule Form  is_business-------------- */
    $('#is_business').change(function(){
        if($(this).is(':checked')){
            $('.is_freelance').hide();
            $('.is_pa').show();
        }

    });
    $('#is_retail').change(function(){
        if($(this).is(':checked')){
            $('.is_freelance').show();
            $('.is_pa').hide();
        }
    });
    $('#is_freelance').change(function(){
        if($(this).is(':checked')){
            //-------freelance---------
        } else {
            loadForm('retail')
        }
    });
    $('#is_pa').change(function(){
        if($(this).is(':checked')){
            //-------public public_administration---------
        } else {
            loadForm('business')
        }
    });
    function loadForm(form){
        $.get('{{ route('user.detail.form')}}',{ type: form, action_type:'add'}).done(function(data){
            $('#box-FORM').html(data);
            set_select2('province_id');
            set_select2('city_id');
            $('#nation_id').val('').trigger('change');
            $('#nation_id').change(function(){
                var url = "{{ url('geo/nations/provinces') }}/"+$(this).val();
                getAjaxDataSelectOptions($(this).attr('id'), url, 'province_id');
            });
            $('#province_id').change(function(){
                var url = "{{ url('geo/provinces/cities') }}/"+$(this).val();
                getAjaxDataSelectOptions($(this).attr('id'), url, 'city_id');
            });
            refreshInputRequired();
        });
    }


</script>
