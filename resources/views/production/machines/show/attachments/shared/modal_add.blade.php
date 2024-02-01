
<!-- Modal-Curriculum-Add-->
<div class="modal fade" id="Modal-Attachment-Add" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-Curriculum-Add"><strong class="text-primary">{{ __('general.add')}} {{ trans_choice('commercial.attachment',1)}}</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" >

                {!! BootForm::open()->post()->id('uploadFileFrm')->multipart() !!}
                    <div class="row">


                        <div class="col-md-6">
                            {!! BootForm::text(__('general.label'),'label' )->id('label')->class('form-control')->placeholder('es. Carta di Circolazione')->required()!!}
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>File {{ trans_choice('commercial.attachment',1)}}</label>
                                <input type="file" class="form-control" name="attachment" id="attachment" accept=".pdf,.doc,.docx,.doc,.xls,.xlsx,.jpg" required>
                                <small>[doc, docx, xls, xlsx, pdf, jpg]</small>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-12">
                            {!! BootForm::textarea(__('general.description'),'description' )->id('description')->class('form-control')->placeholder('es.')!!}
                        </div>
                    </div>
                <input type="hidden" name="machine_uuid" value="{{ $machine->uuid}}" />
                {!! BootForm::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal">{{__('general.close')}}</button>
                <button type="button" class="btn btn-outline-primary font-weight-bold" onclick="$('#uploadFileFrm').submit()"><i class="fa fa-upload"></i> {{__('general.upload')}}</button>
            </div>
        </div>
    </div>
</div>


    <script>



        $(document).ready(function(){
            refreshInputRequired();

            $('#uploadFileFrm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('machine.attachment.save') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        $('.modal').modal('hide');
                        $('.modal-backdrop').remove();
                        toastr.success('{{session('success')}}', '{{__('general.success')}}');
                        content_show('attachments')
                    },
                    error: function (data) {
                        toastr.error('{{session('error')}}', '{{__('general.error')}}');
                    }
                });
            });


        });

    </script>
