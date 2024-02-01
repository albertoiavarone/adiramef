@extends('layout.app')
@section('title',__('geo.provinces'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('provinces')}}" class="text-muted">{{__('geo.provinces')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{__('general.add')}}</span>
    </li>
@endsection

@section('content')
    <h4>{{__('general.add')}} {{__('geo.nation')}}</h4>
    {!! BootForm::open()
        ->action(route('provinces.store'))
        ->post()
        ->id('provinces-create')
    !!}
    <div class="row">
        <div class="col-md-4">
             {!!BootForm::text(__('general.name'), 'name')->placeholder('es. New York')->required()->maxlength('255') !!}
        </div>
        <div class="col-md-2">
             {!!BootForm::text(__('general.abbreviation'), 'province_abbreviation')->placeholder('es. NJ')->required()->maxlength('2') !!}
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-4">
            <div form class="form-group">
                <label>{{ __('geo.nation')}}</label>
                <select class="form-control" name="nation_id" id="nation_id" required>
                    <option value=""></option>
                    @forelse($nations as $nation)
                       <option value="{{ $nation->id }}">{{ $nation->countryName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
             {!!BootForm::text(__('geo.region'), 'region')->placeholder('es. New Jersey')->required()->maxlength('100') !!}

        </div>
        <div class="col-md-8"></div>
    </div>

    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('provinces.index') }}">
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
        $(function(){
            $('#nation_id').select2({
                placeholder: "{{__('general.select')}}"
            });
        })
    </script>

@endsection
