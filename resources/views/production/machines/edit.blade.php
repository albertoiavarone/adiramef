@extends('layout.app')
@section('title',trans_choice('production.machine',1))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('machines')}}" class="text-muted">{{trans_choice('production.machine',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $machine->name }} {{ $machine->serial_number }}</span>
    </li>
@endsection

@section('content')
{!! BootForm::open()
    ->action(route('machines.update', $machine->uuid))
    ->put()
    ->id('machine-update')
    ->multipart()
!!}
{!! BootForm::bind($machine) !!}

<h4 class="mb-5 text-primary" role="button" onclick="window.location='{{ route('machines.show', $machine->uuid)}}'">{{ $machine->name }} {{ $machine->serial_number }}</h4>


        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label>{{ trans_choice('production.builder',1)}}</label>
                    <select class="form-control" name="builder_uuid" id="builder" required>
                        @forelse($builders as $builder)
                            <option value="{{ $builder->uuid}}" {{ $builder->id == $machine->builder_id ? 'selected' : ''}} />{{ $builder->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>{{ trans_choice('production.machine_type',1)}}</label>
                    <select class="form-control" name="machine_type_uuid" id="machine_type" required>
                        @forelse($machine_types as $type)
                            <option value="{{ $type->uuid}}" {{ $type->id == $machine->machine_type_id ? 'selected' : ''}} />{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4 mt-5">
                    {!! BootForm::text(__('general.name'), 'name')->required() !!}
                </div>
                <div class="col-md-4 mt-5">
                    {!! BootForm::text(__('production.serial_number'), 'serial_number')->required() !!}
                </div>
                <div class="col-md-4">
                </div>


                <div class="col-md-4 mt-5">
                    <div class="form-group">
                        <label class="checkbox my-10">
                           <input type="checkbox" name="gps" id="gps" value=1 {{ $machine->gps ? 'checked':''}} />
                           <span></span>&nbsp;{{__('production.gps')}}
                       </label>
                   </div>
                </div>
                <div class="col-md-4 mt-5">
                    <label>{{ trans_choice('production.provider',1)}}</label>
                    <select class="form-control" name="provider_uuid" id="provider" {{ !$machine->gps ? 'disabled' : ''}}>
                        <option value="" selected></option>
                        @forelse($providers as $provider)
                            <option value="{{ $provider->uuid}}" {{ $provider->id == $machine->provider_id ? 'selected' : ''}}  data-geo_info={{$provider->geo_info}} />{{ $provider->name }}</option>
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
                  {!! BootForm::text('Latitudine', 'static_latitude') !!}
                </div>
                <div class="col-md-4 mt-5 static-geo-box">
                  {!! BootForm::text('Longitudine', 'static_longitude') !!}
                </div>

                <div class="col-md-4 mt-5">
                  {!! BootForm::text('Host', 'host')->placeholder('es. 127.0.0.1') !!}
                </div>
                <div class="col-md-4 mt-5">
                    {!! BootForm::text(__('production.purchase_date'), 'purchase_date')->class('form-control datepicker')->id('purchase_date')->value($machine->purchase_date ? \Carbon\Carbon::parse($machine->purchase_date)->format('d/m/Y') : '') !!}
                </div>
                <div class="col-md-4 mt-5">
                </div>

                <div class="col-md-4 mt-5">
                    <div class="form-group">
                        <label class="checkbox my-10">
                           <input type="checkbox" name="sync_diagnostics" id="sync_diagnostics" value=1 {{ $machine->sync_diagnostics ? 'checked':''}} />
                           <span></span>&nbsp;{{__('production.sync_diagnostics')}}
                       </label>
                       <p class="text-muted gps-info-refresh">{{ __('production.info_machine_sync_refresh')}}</p>
                   </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="form-group">
                        <label class="checkbox my-10">
                           <input type="checkbox" name="sync_production" id="sync_production" value=1 {{ $machine->sync_production ? 'checked':''}} />
                           <span></span>&nbsp;{{__('production.sync_production')}}
                       </label>
                       <p class="text-muted gps-info-refresh">{{ __('production.telemetry_machine_sync_refresh')}}</p>
                   </div>
                </div>
                <div class="col-md-4 mt-5 ">
                </div>

              </div>
              <p class="alert alert-secondary " ><i class="fas fa-rss"></i> {{ __('general.settings')}} Addizionali API</p>
              <div id="json-options">
                <div class="row">
                  <div class="col-md-8 mt-5" >
                      <div class="row" id="box-options" >
                          <div class="col-md-6">
                              <label>Key</label>
                          </div>
                          <div class="col-md-6">
                              <label>Value</label>
                          </div>
                          @if($machine->options)
                            @forelse( $machine->options as $key => $value )
                                <div class="col-md-6 mb-5">
                                    <input type="text" class="form-control" name="option_keys[]" value="{{ $key }}" placeholder="machine_id, etc" />
                                </div>
                                <div class="col-md-6 mb-5">
                                    <input type="text" class="form-control"  name="option_values[]" value="{{ $value }}" placeholder="1235678, etc"/>
                                </div>
                            @endforeach
                          @endif
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

            @if(data_get($machine, 'provider.geo_info' ))
              $('.static-geo-box').hide();
              $('.gps-info-refresh').show();
            @endif

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
