@extends('layout.app')
@section('title',trans_choice('production.machine_type',1))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('machine-types')}}" class="text-muted">{{trans_choice('production.machine_type',2)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $machine_type->name }}</span>
    </li>
@endsection

@section('content')
{!! BootForm::open()
    ->action(route('machine-types.update', $machine_type->uuid))
    ->put()
    ->id('machine_type-update')
    ->multipart()
!!}
{!! BootForm::bind($machine_type) !!}
<div class="card">
    <div class="card-header">
        <h4>{{__('general.edit')}} {{trans_choice('production.machine_type',1)}}</h4>
    </div>
     <div class="card-body">


        <div class="row">
            <div class="col-md-4">
                 {!!BootForm::text(__('general.name'), 'name')->placeholder('es. ABC group')->required()->maxlength('255') !!}
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <label>Logo</label>
                 <input class="form-control" type="file" name="uploaded_file">
            </div>
            <div class="col-md-8">
            </div>
            <div class="col-md-4 mt-15">
                <img class="img-fluid" src="{{ asset( !is_null($machine_type->logo_path) ? 'storage/'.$machine_type->logo_path : 'assets/media/img/no_image.png') }}" />
            </div>
            <div class="col-md-8 ">
            </div>
        </div>
    </div>
</div>
<hr class="mt-10">
<div class="btn-group float-right mt-10">
    <a class="btn btn-outline-secondary" href="{{ route('machine-types.index') }}">
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

@endsection
