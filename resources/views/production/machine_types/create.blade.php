@extends('layout.app')
@section('title',trans_choice('production.machine_type',2))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('nations')}}" class="text-muted">{{trans_choice('production.machine_type',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{__('general.add')}}</span>
    </li>
@endsection

@section('content')
{!! BootForm::open()
    ->action(route('machine-types.store'))
    ->post()
    ->id('machine_type-create')
    ->multipart()
!!}
<div class="card">
    <div class="card-header"><h4>{{__('general.add')}} {{trans_choice('production.machine_type',1)}}</h4></div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                 {!!BootForm::text(__('general.name'), 'name')->placeholder('es. ABC group')->required()->maxlength('255') !!}
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <label>Logo</label>
                 <input class="form-control" type="file" name="uploaded_file" required>
            </div>
            <div class="col-md-8"></div>
        </div>
    </div>
</div>
<hr class="mt-10">
<div class="btn-group float-right mt-10">
    <a class="btn btn-outline-secondary" href="{{ route('machine-types.index') }}">
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

@endsection
