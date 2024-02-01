@extends('layout.app')
@section('title',__('geo.nation'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('nations')}}" class="text-muted">{{__('geo.nations')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $nation->countryName}}</span>
    </li>
@endsection

@section('content')
    <h3>{{ __('geo.nation').': '. $nation->countryName }}</h3>
    <div class="row">
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-md-4">{{__('geo.nation')}}</dt>
                <dd class="col-md-8">{{ $nation->countryName }}</dd>
                <dt class="col-md-4">{{__('geo.country_code')}}</dt>
                <dd class="col-md-8">{{ $nation->countryCode }}</dd>
                <dt class="col-md-4">{{__('geo.currency')}}</dt>
                <dd class="col-md-8">{{ $nation->currencyCode }}</dd>
                <dt class="col-md-4">{{__('geo.continent_name')}}</dt>
                <dd class="col-md-8">{{ $nation->continentName }}</dd>
                <dt class="col-md-4">{{__('geo.continent_code')}}</dt>
                <dd class="col-md-8">{{ $nation->continent }}</dd>

            </dl>
        </div>
        <div class="col-md-8"></div>
    </div>



    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('nations.index') }}">
            <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
        </a>
        <a class="btn btn-outline-info" href="{{ route('nations.edit',$nation->id) }}">
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
