@extends('layout.app')
@section('title',trans_choice('production.manteinance_type',2))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('manteinance-types')}}" class="text-muted">{{ trans_choice('production.manteinance_type',2) }}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $type->name }}</span>
    </li>
@endsection
@section('content')
        <div class="card">
              <div class="card-body">
                  <h3 class="card-title">{{__('general.edit')}} {{ trans_choice('production.manteinance_type',2) }}</h3>
                  <hr />

                  <div class="row">
                      <div class="col-md-6">
                          {!! BootForm::open()
                                 ->action(route('manteinance-types.update', $type->id))
                                 ->put()
                                 ->id('form-update')
                          !!}
                          {!! BootForm::bind($type) !!}

                            {!! BootForm::text(__('general.name'), 'name')->id('name')->required()->class('form-control col-md-4')->placeholder('es. Tagliando') !!}
                            {!! BootForm::checkbox(__('general.status'), 'active') !!}
                            <hr />
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fa fa-save"></i> {{__('general.save')}}
                            </button>
                         {!! BootForm::close() !!}
                      </div>
                      <div class="col-md-6">
                       </div>
                  </div>


                    <hr class="mt-10">
                    <div class="btn-group float-right mt-10">
                        <a class="btn btn-secondary float-left" href="{{ route('manteinance-types.index') }}"><i class="fa fa-arrow-circle-left"></i> Indietro</a>


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
@endsection
