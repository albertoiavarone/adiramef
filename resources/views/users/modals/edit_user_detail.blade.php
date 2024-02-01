{!! BootForm::open()
    ->put()
    ->action(route('user.detail.update',$user_detail->id))
    ->id('update-user-detail')
 !!}
 {!! BootForm::bind($user_detail) !!}
     <!-- start: Modal EditUserDetail -->
    <div class="modal fade" id="editUserDetail" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserDetail">{{__('general.edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                     <div class="row">
                         <div class="col-md-8 ">
                             <div class="form-group">
                                 <label>{{ __('general.label') }}</label>
                                 <input type="text" class="form-control" name="label" value="{{ $user_detail->label }}" required>
                             </div>
                         </div>
                         <div class="col-md-4"></div>
                     </div>
                     <div class="row" id="box-FORM-Edit">
                         @include('users.modals.form_user_details.edit.'.$form_view)
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal">{{__('general.cancel')}}</button>
                    <button type="submit" class="btn btn-primary font-weight-bold" >{{__('general.save')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!--  end:Modal EditUserDetail -->
{!! BootForm::close() !!}

<script>
    $(function(){
        set_select2('edit_nation_id');
        set_select2('edit_province_id');
        set_select2('edit_city_id');
        //set_datepicker('edit_birthDate');
        checkInputRequired();
    });

    $('#edit_province_id').change(function(){
        var url = "{{ url('geo/provinces/cities') }}/"+$(this).val();
        getAjaxDataSelectOptions($(this).attr('id'), url, 'edit_city_id');
    });
    /* -----Rule Form  is_business-------------- */
    $('#is_business_edit').change(function(){
        if($(this).is(':checked')){
            console.log('is_business');
            $('.is_freelance').hide();
            $('.is_pa').show();
        }

    });
    $('#is_retail_edit').change(function(){
        if($(this).is(':checked')){
            $('.is_freelance').show();
            $('.is_pa').hide();
        }
    });
    $('#is_freelance_edit').change(function(){
        if($(this).is(':checked')){
            //-------freelance---------
        } else {
            loadForm('retail')
        }
    });
    $('#is_pa_edit').change(function(){
        if($(this).is(':checked')){
            //-------public public_administration---------
        } else {
            loadForm('business')
        }
    });
    function loadFormEdit(form){
        $.get('{{ route('user.detail.form')}}',{ type: form, action_type:'edit', uuid: '{{ $user_detail->uuid }}'   }).done(function(data){
            $('#box-FORM-Edit').html(data);
            set_select2('edit_province_id');
            set_select2('edit_city_id');
            $('#edit_nation_id').change(function(){
                var url = "{{ url('geo/nations/provinces') }}/"+$(this).val();
                getAjaxDataSelectOptions($(this).attr('id'), url, 'edit_province_id');
            });
            $('#edit_province_id').change(function(){
                var url = "{{ url('geo/provinces/cities') }}/"+$(this).val();
                getAjaxDataSelectOptions($(this).attr('id'), url, 'edit_city_id');
            });
            refreshInputRequired();
        });
    }

</script>
