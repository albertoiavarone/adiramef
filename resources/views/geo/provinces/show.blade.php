@extends('layout.app')
@section('title',__('geo.province'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('provinces')}}" class="text-muted">{{__('geo.provinces')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $province->name}}</span>
    </li>
@endsection

@section('content')
    <h3>{{ __('geo.province').': '.$province->name }}</h3>
    <div class="row">
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-md-4">{{__('geo.province')}}</dt>
                <dd class="col-md-8">{{ $province->name }}</dd>
                <dt class="col-md-4">{{__('general.abbreviation')}}</dt>
                <dd class="col-md-8">{{ $province->province_abbreviation }}</dd>
                <dt class="col-md-4">{{__('geo.nation')}}</dt>
                <dd class="col-md-8">{{ $province->nation->countryName }}</dd>
                <dt class="col-md-4">{{__('geo.region')}}</dt>
                <dd class="col-md-8">{{ $province->region }}</dd>

            </dl>
        </div>
        <div class="col-md-8"></div>
    </div>



    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('provinces.index') }}">
            <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
        </a>
        <a class="btn btn-outline-info" href="{{ route('provinces.edit',$province->id) }}">
            <i class="fa fa-edit"></i> {{__('general.edit')}}
        </a>
    </div>


@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent

@endsection
