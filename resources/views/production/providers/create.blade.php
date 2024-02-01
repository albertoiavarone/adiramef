@extends('layout.app')
@section('title',trans_choice('production.provider',1))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('providers')}}" class="text-muted">{{trans_choice('production.provider',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ __('general.add') }}</span>
    </li>
@endsection

@section('content')
{!! BootForm::open()
    ->action(route('providers.store'))
    ->post()
    ->id('provider-update')
    ->multipart()
!!}
<div class="card">
    <div class="card-header">
        <h4>{{__('general.add')}} {{trans_choice('production.provider',1)}}</h4>
    </div>
     <div class="card-body">


        <div class="row">
          <div class="col-md-4">
            {!!BootForm::text(__('general.name'), 'name')->placeholder('es. ABC group')->required()->maxlength('255') !!}
            {!!BootForm::text('Class Name', 'class_name')->placeholder('es. TrackUnit')->required()->maxlength('255') !!}

            <div class="form-group">
              <label>Logo</label>
              <input class="form-control" type="file" name="uploaded_file">

            </div>
             <div class="form-group">
                 <label class="checkbox my-10">
                    <input type="checkbox" name="geo_info" id="geo_info" value=1 />
                    <span></span>&nbsp;Geo Info (Lat/Long, etc)
                </label>
                <p>Se il servizio del Provider non invia le coordinate è possibile indicare Latitudine e Longitudine statiche direttamente alla macchina, al fine di visualizzare il dispositivo sulla mappa.</p>
            </div>


          </div>
          <div class="col-md-8">
              <div class="card">
                <div class="card-header bg-light"><i class="fa fa-cog"></i> {{ __('general.settings')}}</div>
                <div class="card-body" id="json-options">

                      <div class="row" id="box-options" >
                          <div class="col-md-6">
                              <label>Key</label>
                          </div>
                          <div class="col-md-6">
                              <label>Value</label>
                          </div>

                          <div class="col-md-6 mb-5">
                              <input type="text" class="form-control" name="option_keys[]"  placeholder="sync_method, etc" />
                          </div>
                          <div class="col-md-6 mb-5">
                              <input type="text" class="form-control"  name="option_values[]" placeholder="sync_method, etc"/>
                          </div>
                      </div>
                      <button type="button" class="btn btn-outline-light btn-sm" id="add-row"><i class="fa fa-plus"></i> {{__('general.add')}}</button>


                </div>
              </div>


          </div>


        </div>
    </div>
</div>
<hr class="mt-10">
<div class="btn-group float-right mt-10">
    <a class="btn btn-outline-secondary" href="{{ route('providers.index') }}">
        <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
    </a>
    <button class="btn btn-outline-primary" type="submit">
        <i class="fa fa-save"></i> {{__('general.save')}}
    </button>
</div>
{!! BootForm::close() !!}

@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function(){

            $('#add-row').click(function(){
                $('#box-options').append(
                    '<div class="col-md-6 mb-5">'+
                            '<input type="text" class="form-control" name="option_keys[]"  placeholder="sync_method, etc" />'+
                        '</div>'+
                        '<div class="col-md-6 mb-5">'+
                            '<input type="text" class="form-control"  name="option_values[]" placeholder="sync_method, etc"/>'+
                        '</div>'
                    );
            });
        });
    </script>
@endsection
