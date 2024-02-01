@extends('layout.app')
@section('title',trans_choice('general.order',1))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('orders')}}" class="text-muted">{{trans_choice('general.order',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $order->ref_code }} - {{ $order->name }}</span>
    </li>
@endsection

@section('content')

      <h4>{{trans_choice('general.order',1)}}: <span class="text-primary">{{ $order->name }}</span></h4>
      <p class="font-size-xs">
        <i class="far fa-clock"></i> Ultimo agg. {{ convertToLocal($order->updated_at)}}
        {!! view('commercial.orders.tds.status', compact('order'))!!}
      </p>
      <hr />

      <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
              <a class="nav-link " data-toggle="tab" href="#info"><i class="fa fa-info mr-2"></i>{{ __('general.info') }}</a>
          </li>
          <li class="nav-item">
              <a class="nav-link " data-toggle="tab" href="#works"><i class="fas fa-list mr-2"></i>{{trans_choice('production.work',2)}}</a>
          </li>
          <li class="nav-item">
              <a class="nav-link " data-toggle="tab" href="#documents"><i class="fa fa-folder mr-2"></i>{{trans_choice('commercial.document',2)}}</a>
          </li>
          <li class="nav-item">
              <a class="nav-link " data-toggle="tab" href="#logs"><i class="fas fa-list mr-2"></i>Logs</a>
          </li>
      </ul>

      <div class="tab-content" id="myTabContent">
          <div class="tab-pane show p-5" id="info" role="tabpanel" aria-labelledby="info">
            {!! BootForm::open()
                ->action(route('orders.update', $order->uuid))
                ->put()
                ->id('order-update')
                ->multipart()
            !!}
            {!! BootForm::bind($order) !!}

            <div class="row">
              <div class="col-md-6 mt-5">
                    <div class="row">
                      <div class="col-md-6">
                        {!! BootForm::text(trans_choice('commercial.ref_code',1), 'ref_code')->class('form-control')->placeholder('es. ABC123') !!}
                      </div>
                      <div class="col-md-6">
                        {!! BootForm::text(trans_choice('commercial.ref_date',1), 'ref_date')->class('form-control datepicker')->id('ref_date')->value($order->ref_date ? \Carbon\Carbon::parse($order->ref_date)->format('d/m/Y') : '') !!}
                      </div>
                      <div class="col-md-6">
                        {!! BootForm::text(__('general.name'), 'name')->class('form-control')->required() !!}
                      </div>
                      <div class="col-md-6">
                      </div>

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
                    <br />
                    {!! BootForm::textarea(__('general.description'), 'description') !!}

              </div>
              <div class="col-md-6 mt-5 p-3">
                {!! view('commercial.orders.shared.dashboard', compact('order'))!!}
              </div>
            </div>
            <hr />
            <button class="btn btn-outline-primary" type="submit">
                <i class="fa fa-save"></i> {{__('general.save')}}
            </button>
            {!! BootForm::close() !!}
          </div>

          <div class="tab-pane fade  p-5" id="works" role="tabpanel" aria-labelledby="works">
              {!! view('commercial.orders.shared.works', compact('order'))!!}
          </div>

          <div class="tab-pane fade  p-5" id="documents" role="tabpanel" aria-labelledby="documents">
            <div class="row">
              <div class="col-md-5">
                {!! view('commercial.orders.shared.upload', compact('order'))!!}
              </div>
              <div class="col-md-7">
                  {!! view('commercial.orders.shared.documents', compact('order'))!!}
              </div>
            </div>
          </div>

          <div class="tab-pane fade  p-5" id="logs" role="tabpanel" aria-labelledby="logs">
            <button type="button" data-toggle="modal" data-target="#Modal-Add-Log" class="btn btn-outline-secondary btn-sm mb-5">
              <i class="fa fa-edit"></i> {{__('general.edit')}}
            </button>
            <br />
            <div class="card">
              <div class="card-header bg-light">
                  Logs {{ trans_choice('commercial.order',1)}}

              </div>
              <div class="card-body">
                {!! view('commercial.orders.shared.logs', compact('order', 'statuses')) !!}
              </div>
            </div>
          </div>

      </div>





<hr class="mt-10">
<div class="btn-group float-right mt-10">
    <a class="btn btn-outline-secondary" href="{{ route('orders.index') }}">
        <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
    </a>

</div>

{!! view('commercial.orders.shared.modal_status', compact('order','statuses'))!!}


@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent
    @include('layout.basic.js.datatable')
    <script>
        $(document).ready(function(){
            set_datepicker('ref_date', '{{$order->ref_date }}');
            set_datetimepicker('date_from', '{{$order->date_start }}');
            set_datetimepicker('date_to', '{{$order->date_end }}');
            setActiveTab('info');
        });
    </script>

@endsection
