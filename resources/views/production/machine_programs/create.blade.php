@extends('layout.app')
@section('title',trans_choice('production.program',2))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('programs')}}" class="text-muted">{{trans_choice('production.program',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{__('general.add')}}</span>
    </li>
@endsection

@section('content')
{!! BootForm::open()
    ->action(route('programs.store'))
    ->post()
    ->id('machine_program-create')
    ->multipart()
!!}
<div class="card">
    <div class="card-header"><h4>{{__('general.add')}} {{trans_choice('production.program',1)}}</h4></div>
    <div class="card-body">

        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label>{{ trans_choice('production.machine', 1) }}</label>
                  <select class="form-control" name="machine" id="machine">
                      <option value=""></option>
                      @forelse($machines as $machine)
                      <option value="{{ $machine->id }}">{{ $machine->name }} [{{ $machine->builder->name }}]</option>
                      @endforeach
                  </select>
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
        <i class="fa fa-save"></i> {{__('general.add')}}
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
