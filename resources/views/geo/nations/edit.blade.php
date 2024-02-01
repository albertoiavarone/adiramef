@extends('layout.app')
@section('title',__('geo.nation'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('nations')}}" class="text-muted">{{__('geo.nations')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $nation->countryName }}</span>
    </li>
@endsection

@section('content')
    <h4>{{__('general.edit')}} {{__('geo.nation')}}</h4>
    {!! BootForm::open()
        ->action(route('nations.update', $nation->id))
        ->put()
        ->id('nation-update')
    !!}
    {!! BootForm::bind($nation) !!}
    <div class="row">
        <div class="col-md-4">
             {!!BootForm::text(__('general.name'), 'countryName')->placeholder('es. Italy')->required()->maxlength('255') !!}
        </div>
        <div class="col-md-2">
             {!!BootForm::text(__('geo.country_code'), 'countryCode')->placeholder('es. IT')->required()->maxlength('2') !!}
        </div>
        <div class="col-md-2">
             {!!BootForm::text(__('geo.currency'), 'currencyCode')->placeholder('es. EUR')->required()->maxlength('3') !!}
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
             {!!BootForm::text(__('geo.continent_name'), 'continentName')->placeholder('es. Europe')->required()->maxlength('100') !!}
        </div>
        <div class="col-md-2">
             {!!BootForm::text(__('geo.continent_code'), 'continent')->placeholder('es. EU')->required()->maxlength('2') !!}
        </div>
        <div class="col-md-2">
            <div class="form-group">
               <label class="my-2">&nbsp;</label>
                   <label class="checkbox">
                   <input type="checkbox" name="extra_ue" value=1 {{ $nation->extraue ? 'checked' : ''}}>
                   <span></span>&nbsp; {{__('geo.extra_ue')}}</label>
           </div>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-2">
             {!!BootForm::text(__('geo.vies_code'), 'viesCode')->placeholder('es. IT')->maxlength('2') !!}
        </div>
        <div class="col-md-2">
             {!!BootForm::text('ISO Alpha3', 'isoAlpha3')->placeholder('es. ITA')->maxlength('3') !!}
        </div>
        <div class="col-md-2">
             {!!BootForm::text('ISO', 'isoNumeric')->placeholder('es. 380')->maxlength('3') !!}
        </div>

        <div class="col-md-8"></div>
    </div>



    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('nations.index') }}">
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
