@extends('layout.app')
@section('title',trans_choice('production.program',1))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('programs')}}" class="text-muted">{{trans_choice('production.program',1)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $machine_program->name }}</span>
    </li>
@endsection

@section('content')
{!! BootForm::open()
    ->action(route('programs.update', $machine_program->uuid))
    ->put()
    ->id('machine_program-update')
    ->multipart()
!!}
{!! BootForm::bind($machine_program) !!}
<div class="card">
    <div class="card-header"><h4>{{__('general.edit')}} {{trans_choice('production.program',1)}}</h4></div>
    <div class="card-body">

        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label>{{ trans_choice('production.machine', 1) }}</label>
                  <p>{{ $machine_program->machine->name }}</p>

              </div>
              {!!BootForm::text(__('general.name'), 'name')->placeholder('es. carico pressa+carico frigo NO')->required()->maxlength('255') !!}
              {!!BootForm::text(__('production.ref_id'), 'ref_id')->placeholder('ID o codice dell\'operazione')->maxlength('20') !!}


          </div>
          <div class="col-md-8">
              {!!BootForm::textarea(__('general.description'), 'description')->placeholder('es. ABC group') !!}
          </div>
        </div>

    </div>
</div>
<hr class="mt-10">
<div class="btn-group float-right mt-10">
    <a class="btn btn-outline-secondary" href="{{ route('programs.index') }}">
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
        set_select2('machine')
      })
    </script>


@endsection
