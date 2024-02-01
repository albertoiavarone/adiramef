@extends('layout.app')
@section('title',trans_choice('general.order',1))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('orders')}}" class="text-muted">{{trans_choice('general.order',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ trans_choice('general.order',1)}}</span>
    </li>
@endsection

@section('content')
{!! BootForm::open()
    ->action(route('orders.store'))
    ->post()
    ->id('order-create')
    ->multipart()
!!}
<div class="card">
    <div class="card-header"><h4>{{__('general.add')}} {{trans_choice('general.order',1)}}</h4></div>
    <div class="card-body">
      <div class="row">
          <div class="col-md-4">
            <p class="alert alert-custom alert-light-primary">
              <i class="fa fa-info-circle fa-2x text-white mr-2"></i> Inserisci le informazioni principali della Commessa.
              <br />Una volta creata potrai aggiungere documenti ed attività.
            </p>
              {!! BootForm::text(trans_choice('commercial.ref_code',1), 'ref_code')->placeholder('es. ABC123')->required() !!}
              {!! BootForm::text(trans_choice('commercial.ref_date',1), 'ref_date')->class('form-control datepicker')->id('ref_date')->required() !!}
              {!! BootForm::text(__('general.name').' '.trans_choice('commercial.order',1), 'name')->required() !!}
              {!! BootForm::textarea(__('general.description'), 'description') !!}
              <p class="alert alert-primary-light mt-5">
                <i class="fa fa-info-circle mr-5"></i>Se può aiutarti a definire la durata dell'ordine
              </p>
              <div class="row">
                <div class="col-md-6">
                    <label class="">{{ __('production.date_from') }}</label>
                      <div class="input-group date" id="date_from" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="date_from" placeholder="Seleziona data ed ora" data-target="#date_from">
                        <div class="input-group-append" data-target="#date_from" data-toggle="datetimepicker">
                          <span class="input-group-text">
                            <i class="ki ki-calendar"></i>
                          </span>
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <label class="">{{ __('production.date_to') }}</label>
                      <div class="input-group date" id="date_to" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="date_to" placeholder="Seleziona data ed ora" data-target="#date_to">
                        <div class="input-group-append" data-target="#date_to" data-toggle="datetimepicker">
                          <span class="input-group-text">
                            <i class="ki ki-calendar"></i>
                          </span>
                        </div>
                      </div>
                </div>
              </div>

          </div>
          <div class="col-md-8 mt-5 text-center">
              <img class="img-fluid" src="{{ asset('assets/media/img/sales_order.png')}}" />
          </div>
      </div>

    </div>
</div>
<hr class="mt-10">
<div class="btn-group float-right mt-10">
    <a class="btn btn-outline-secondary" href="{{ route('orders.index') }}">
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
    @include('layout.basic.js.datatable')
    <script>
      $(document).ready(function(){
          set_datepicker('ref_date');
          set_datetimepicker('date_from');
          set_datetimepicker('date_to');
      });
    </script>

@endsection
