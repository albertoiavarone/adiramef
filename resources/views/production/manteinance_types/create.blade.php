@extends('layout.app')
@section('title',trans_choice('production.manteinance_type',2))

@section('content')
        <div class="card">
              <div class="card-body">
                  <h3 class="card-title">{{__('general.new')}} {{trans_choice('production.manteinance_type',1)}} </h3>
                  {!! BootForm::open()
                        ->action(route('manteinance-types.store'))
                         ->id('form-create')
                         ->post()
                  !!}
                    {!! BootForm::text(__('general.name'), 'name')->id('name')->required()->class('form-control col-md-4')->placeholder('es. Tagliando') !!}
                    {!! BootForm::checkbox(__('general.status'), 'active') !!}

                    <hr class="mt-10">
                    <div class="btn-group float-right mt-10">
                        <a class="btn btn-secondary float-left" href="{{ route('manteinance-types.index') }}"><i class="fa fa-arrow-circle-left"></i> Indietro</a>

                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fa fa-save"></i> {{__('general.add')}}
                        </button>
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             {!! BootForm::close() !!}
@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent
@endsection
