@extends('layout.app')
@section('title',trans_choice('production.manteinance',2))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('manteinances')}}" class="text-muted">{{ trans_choice('production.manteinance',2) }}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $manteinance->title }}</span>
    </li>
@endsection
@section('content')
        <div class="card">
              <div class="card-body">
                  <h3 class="card-title">
                    {{ trans_choice('production.manteinance',1) }}
                      <div class="card-body">
                        <span class="float-left">
                          <img class="mb-5 mr-5" src="{{ asset( !is_null($manteinance->machine->type->logo_path) ? 'storage/'.$manteinance->machine->type->logo_path : '') }}" alt="{{ $manteinance->machine->type->name}}"  style="max-height:40px">
                          <img class="mb-5 mr-5" src="{{ asset( !is_null($manteinance->machine->builder->logo_path) ? 'storage/'.$manteinance->machine->builder->logo_path : '') }}" alt="{{ $manteinance->machine->builder->name}}"  style="max-height:40px">
                          <br />
                          {!! view('production.machines.shared.name', [ 'machine' => $manteinance->machine ]  ) !!}
                        </span>
                        <span class="float-right">
                          {!! view('production.manteinance.tds.status', compact('manteinance')  ) !!}
                        </span>
                      </div>
                      <div class="clearfix"></div>

                  </h3>
                  <hr />

                  <div class="row">
                      <div class="col-md-5">

                          {!! BootForm::open()
                                 ->action(route('manteinances.update', $manteinance->uuid))
                                 ->put()
                                 ->id('form-update')
                          !!}
                          {!! BootForm::bind($manteinance) !!}

                            {!! BootForm::text(trans_choice('general.title',1), 'title')->id('title')->required()->value($manteinance->title)->placeholder('es. Omologazione') !!}

                            <div class="form-group">
                                <label>{{ trans_choice('production.manteinance_type',1) }}</label>
                                <select class="form-control" name="type" id="type">
                                    <option value=""></option>
                                    @forelse($types as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == $manteinance->machine_manteinance_type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {!! BootForm::text(__('general.expire_date'),'expire_date' )->id('expire_date')->class('form-control datepicker')->placeholder(__('general.select'))->value( $manteinance->expire_date ? formatDate($manteinance->expire_date) : '')!!}

                            {!! BootForm::textarea(__('general.notes'), 'notes') !!}

                            <hr />
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fa fa-save"></i> {{__('general.save')}}
                            </button>
                         {!! BootForm::close() !!}
                      </div>
                      <div class="col-md-7">
                        <div class="card  mt-5">
                          <div class="card-header"><i class="fas fa-road"></i> Logs
                              <button type="button" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#Modal-Status-Add"><i class="fa fa-edit"></i> {{ __('general.edit')}} {{ __('general.status')}}</button>
                          </div>
                          <div class="card-body">
                            {!! view('production.manteinance.shared.logs.index' , compact('manteinance')) !!}
                          </div>
                        </div>

                       </div>
                  </div>


                    <hr class="mt-10">
                    <div class="btn-group float-right mt-10">
                        <a class="btn btn-secondary float-left" href="{{ route('manteinances.index') }}"><i class="fa fa-arrow-circle-left"></i> Indietro</a>
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent
    <script>
      $(document).ready(function(){
        set_select2('type');
        set_datepicker('expire_date');
      })
    </script>

    @include('production.manteinance.shared.logs.modal_add')

@endsection
