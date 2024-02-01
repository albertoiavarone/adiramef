@extends('layout.app')
@section('title',trans_choice('production.machine',2))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('machines')}}" class="text-muted">{{trans_choice('production.machine',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{__('general.add')}}</span>
    </li>
@endsection

@section('content')
{!! BootForm::open()
    ->action(route('machines.store'))
    ->post()
    ->id('machine-create')
    ->multipart()
!!}
<div class="card">
    <div class="card-header"><h4>{{__('general.add')}} {{trans_choice('production.machine',1)}}</h4></div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <label>{{ trans_choice('production.builder',1)}}</label>
                <select class="form-control" name="builder_uuid" id="builder" required>
                    <option value="" selected>{{__('general.select')}}</option>
                    @forelse($builders as $builder)
                        <option value="{{ $builder->uuid}}">{{ $builder->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>{{ trans_choice('production.machine_type',1)}}</label>
                <select class="form-control" name="machine_type_uuid"  id="machine_type"  required>
                    <option value="" selected>{{__('general.select')}}</option>
                    @forelse($machine_types as $type)
                        <option value="{{ $type->uuid}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 ">  </div>


            <div class="col-md-4  mt-5">
                {!! BootForm::text(__('general.name'), 'name')->required() !!}
            </div>
            <div class="col-md-4 mt-5">
                {!! BootForm::text(__('production.serial_number'), 'serial_number')->required() !!}
            </div>
            <div class="col-md-4 mt-5">
            </div>

            <div class="col-md-4 mt-5">
                <div class="form-group">
                    <label class="checkbox my-10">
                       <input type="checkbox" name="gps" id="gps" value=1 >
                       <span></span>&nbsp;{{__('production.gps')}}
                   </label>
               </div>
            </div>
            <div class="col-md-4 mt-5">
                <label>{{ trans_choice('production.provider',1)}}</label>
                <select class="form-control" name="provider_uuid"  id="provider"  disabled >
                    <option value="" selected>{{__('general.select')}}</option>
                    @forelse($providers as $provider)
                        <option value="{{ $provider->uuid}}" data-geo_info={{$provider->geo_info}}>{{$provider->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mt-5">
            </div>

            <div class="col-md-4 mt-5 static-geo-box">
              <p class="alert alert-light">
                {{ __('production.provider_no_gps_info')}}
              </p>
            </div>
            <div class="col-md-4 mt-5 static-geo-box">
              {!! BootForm::text('Latitudine', 'static_latitude')->id('static_latitude') !!}
            </div>
            <div class="col-md-4 mt-5 static-geo-box">
              {!! BootForm::text('Longitudine', 'static_longitude')->id('static_longitude') !!}
            </div>

            <div class="col-md-4 mt-5">
                <div class="form-group">
                    <label class="">Host</label>
                    <input type="text" class="form-control" name="host" id="host" placeholder="es. 192.168.100.100 se locale">
                </div>
            </div>
            <div class="col-md-4 mt-5">
                {!! BootForm::text(__('production.purchase_date'), 'purchase_date')->class('form-control datepicker')->id('purchase_date') !!}
            </div>
            <div class="col-md-4 mt-5">
            </div>

            <div class="col-md-4 mt-5">
                <div class="form-group">
                    <label class="checkbox my-10">
                       <input type="checkbox" name="sync_diagnostics" id="sync_diagnostics" value=1 >
                       <span></span>&nbsp;{{__('production.sync_diagnostics')}}
                   </label>
                   <p class="text-muted gps-info-refresh">{{ __('production.info_machine_sync_refresh')}}</p>

               </div>
            </div>
            <div class="col-md-4 mt-5">
                <div class="form-group">
                    <label class="checkbox my-10">
                       <input type="checkbox" name="sync_production" id="sync_production" value=1 >
                       <span></span>&nbsp;{{__('production.sync_production')}}
                   </label>
                   <p class="text-muted gps-info-refresh">{{ __('production.telemetry_machine_sync_refresh')}}</p>

               </div>
            </div>
            <div class="col-md-8 mt-5"></div>

            <div class="col-md-8 mt-5">
                <p class="alert alert-light">JSON Options</p>
                <div class="row" id="box-options">
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
<hr class="mt-10">
<div class="btn-group float-right mt-10">
    <a class="btn btn-outline-secondary" href="{{ route('machines.index') }}">
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
            set_datepicker('purchase_date');
            set_select2('builder');
            set_select2('provider');
            set_select2('machine_type');

            $('.static-geo-box').hide();
            $('.gps-info-refresh').hide();

            $('#gps').click(function(){
              if( $(this).is(':checked') ){
                $('#provider').prop('disabled', false);
                $('.gps-info-refresh').show();
              } else {
                $('#provider').prop('disabled', true);
                $('.gps-info-refresh').hide();
              }
            });

            $('#provider').change(function(){
              var geo_info = $(this).find(':selected').data('geo_info')
                if( geo_info  == 1){
                  $('.static-geo-box').hide();
                  $('#static_latitude').prop('required', false);
                  $('#static_longitude').prop('required', false);
                } else {
                  $('.static-geo-box').show();
                  $('#static_latitude').prop('required', true);
                  $('#static_longitude').prop('required', true);
                }
                refreshInputRequired();
            });

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
