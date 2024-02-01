

<!--  start:Modal Upload Document -->
<div class="modal fade" id="Modal-Status-Add" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-Status-Add">{{ __('general.edit')}} {{ __('general.status')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" >
                {!! BootForm::open()->action(route('manteinance.status.change', $manteinance->uuid))->post()->id('statusFrm')->multipart() !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('general.status')}}</label>
                            <select class="form-control" name="status" id="change_status" required>
                                <option value="" selected>{{ __('general.select')}}</option>
                                @forelse($statuses as $status )
                                    <option value="{{ $status->id }}" >{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-12">
                        <label>{{ __('general.notes')}}</label>
                        <textarea class="form-control" name="notes"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>{{ trans_choice('documents.document_upload',1)}}</label>
                        <input type="file" class="form-control" name="uploaded" id="uploaded" accept=".pdf,.doc,.docx,.doc,.jpg,.jpeg,.xls,.xlsx">
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <hr />
                <p class="text-left">
                    <button type="submit" class="btn btn-outline-primary font-weight-bold">
                        <i class="fa fa-save"></i> {{__('general.save')}}
                    </button>
                </p>
                {!! BootForm::close(); !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light font-weight-bold" data-dismiss="modal">{{__('general.close')}}</button>
            </div>
        </div>
    </div>
</div>
<!--  end:Modal Upload Document   -->
@section('script')
    @parent
    <script>
        $(document).ready(function(){
            set_select2('change_status');
        })

    </script>
@endsection
