<div class="modal fade" id="Modal-Add-Log" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">{{ __('general.edit') }} {{ __('general.status') }}</h5>
            </div>
            <div class="modal-body" >
              <h4 class="text-mute">{{ $order->name }} - Ref. {{ $order->ref_code }}</h4>
              <hr />
                {!! BootForm::open()
                      ->id('add-log-form')
                      ->action(route('order.add.log', $order->uuid))
                      ->post() !!}
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>{{__('general.status')}}</label>
                            <select class="form-control" name="status_id" id="status_id" required>
                                <option value=""></option>
                                @foreach($statuses as $status)
                                  <option value="{{ $status->id }}">{{__('commercial.status_'.$status->name)}}</option>
                                @endforeach
                            </select>
                          </div>
                      </div>
                      <div class="col-md-6">
                      </div>
                      <div class="col-md-12">
                        {!! BootForm::textarea(__('general.notes'),'notes' )->id('notes') !!}
                      </div>

                    </div>
                    <hr />
                    <button type="submit" class="btn btn-outline-success" ><i class="fa fa-save"></i> {{ __('general.save')}}</button>
                {!! BootForm::close() !!}
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">{{__('general.close')}}</button>
            </div>
        </div>
    </div>
</div>

@section('script')
  @parent
  <script>
    $(document).ready(function(){
      set_select2('status_id')
    })
  </script>
@endsection
