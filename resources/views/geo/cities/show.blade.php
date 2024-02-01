@extends('layout.app')
@section('title',__('geo.city'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('cities')}}" class="text-muted">{{__('geo.city')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $city->name }}</span>
    </li>
@endsection

@section('content')
    <h3>{{ __('geo.city').': '.$city->name }}</h3>
    <div class="row">
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-md-4">{{__('geo.city')}}</dt>
                <dd class="col-md-8">{{ $city->name }}</dd>
                <dt class="col-md-4">{{__('geo.province')}}</dt>
                <dd class="col-md-8">{{ data_get($city, 'province.name') }}</dd>
                <dt class="col-md-4">{{__('general.abbreviation')}}</dt>
                <dd class="col-md-8">{{ data_get($city, 'province.province_abbreviation') }}</dd>
                <dt class="col-md-4">{{__('geo.nation')}}</dt>
                <dd class="col-md-8">{{ $city->nation->countryName }}</dd>
                <dt class="col-md-4">{{__('geo.city_code')}}</dt>
                <dd class="col-md-8">{{ $city->code }}</dd>

            </dl>
        </div>
        <div class="col-md-8"></div>
    </div>



    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('cities.index') }}">
            <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
        </a>
        <a class="btn btn-outline-info" href="{{ route('cities.edit',$city->id) }}">
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
