@extends('layout.app')
@section('title',trans_choice('production.work',1))
@section('page_name',trans_choice('production.work',1))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('works')}}" class="text-muted">{{trans_choice('production.work',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{__('general.add')}}</span>
    </li>
@endsection
@section('content')

<div class="card">
    <div class="card-header"><h4>{{__('general.add')}} {{trans_choice('production.work',1)}}</h4></div>
    <div class="card-body">


              {!! BootForm::open()
                  ->action(route('works.store'))
                  ->post()
                  ->id('work-create')
                  ->multipart()
              !!}
              <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ trans_choice('production.machine',1) }}</label>
                        <select class="form-control" name="machine" id="machine-add" required>
                            <option value=""></option>
                            @forelse($machines as $machine)
                            <option value="{{ $machine->uuid }}">{{ $machine->type->name }} {{ $machine->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
    					         <label>{{ trans_choice('commercial.ref_code',1) }}</label>
                        <select id="order_code" name="order" required></select>
            				</div>
                  </div>
                  <div class="col-md-4">

                  </div>
                  <div class="col-md-4">
                      {!! BootForm::text(__('general.name'), 'name')->required() !!}
                        <div class="form-group">
                          <label class="">{{ __('production.date_from') }}</label>
                          <div class="input-group date" id="date_from" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="date_from" placeholder="Seleziona data ed ora" data-target="#date_from" required>
                            <div class="input-group-append" data-target="#date_from" data-toggle="datetimepicker">
                              <span class="input-group-text">
                                <i class="ki ki-calendar"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="">{{ __('production.date_to') }}</label>
                          <div class="input-group date" id="date_to" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="date_to" placeholder="Seleziona data ed ora" data-target="#date_to" required>
                            <div class="input-group-append" data-target="#date_to" data-toggle="datetimepicker">
                              <span class="input-group-text">
                                <i class="ki ki-calendar"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                  </div>
                  <div class="col-md-8">
                    {!! BootForm::textarea(__('general.description'), 'description')->class('form-control') !!}
                  </div>
                  <div class="col-md-4">
                      {!! BootForm::text(trans_choice('commercial.cost',1), 'cost')->placeholder('es. 1500') !!}
                  </div>
                  <div class="col-md-4">
                      {!! BootForm::text(__('production.fuel').' (Lit.)', 'fuel')->placeholder('es. 245.56') !!}
                  </div>
                  <div class="col-md-4">
                      {!! BootForm::text(__('production.energy_consumed').' KW', 'energy_consumed')->placeholder('es. 245.56') !!}
                  </div>
            </div>

            <hr class="mt-10">
            <div class="btn-group float-right mt-10">
                <a class="btn btn-outline-secondary" href="{{ route('works.index') }}">
                    <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
                </a>
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fa fa-save"></i> {{__('general.save')}}
                </button>
            </div>

            {!! BootForm::close() !!}

    </div>
</div>

@endsection

@section('head')
    @parent
@endsection


@section('script')
  @parent
  <script>
    $(document).ready(function(){
      set_select2('machine-add');
      set_datetimepicker('date_from');
      set_datetimepicker('date_to');
    })


    $('#order_code').select2({
        placeholder: "{{__('general.select')}}",
        width: "100%",
        allowClear: true,
        minimumInputLength: 3,
        ajax: {
            url: '{{ route('order.search.by.code') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    term: params.term
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.text,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
  </script>
@endsection
