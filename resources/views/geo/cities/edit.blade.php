@extends('layout.app')
@section('title',__('geo.city'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('cities')}}" class="text-muted">{{__('geo.cities')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $city->name }}</span>
    </li>
@endsection

@section('content')
    <h4>{{__('general.edit')}} {{__('geo.city')}}</h4>
    {!! BootForm::open()
        ->action(route('cities.update', $city->id))
        ->put()
        ->id('city-update')
    !!}
    {!! BootForm::bind($city) !!}
    <div class="row">
        <div class="col-md-4">
            <div form class="form-group">
                <label>{{ __('geo.nation')}}</label>
                <select class="form-control" name="nation_id" id="nation_id" required>
                    <option value=""></option>
                    @forelse($nations as $nation)
                       <option value="{{ $nation->id }}" {{ $city->nation_id == $nation->id ? 'selected' : '' }} >{{ $nation->countryName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <div form class="form-group">
                <label>{{ __('geo.province')}}</label>
                <select class="form-control" name="province_id" id="province_id" required>
                    <option value=""></option>
                    @forelse($provinces as $province)
                       <option value="{{ $province->id }}" {{ $city->province_id == $province->id ? 'selected' : '' }} >{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4">
             {!!BootForm::text(__('general.name'), 'name')->placeholder('es. New York')->required()->maxlength('255') !!}
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-2">
             {!!BootForm::text(__('general.code'), 'code')->placeholder('es. A123')->required()->maxlength('10') !!}
        </div>
        <div class="col-md-8"></div>
    </div>



    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('cities.index') }}">
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
        $(function(){
            set_select2('nation_id');
            set_select2('province_id');
        })
        $('#nation_id').change(function(){
            var url = "{{ url('geo/nations/provinces') }}/"+$(this).val();
            getAjaxDataSelectOptions($(this).attr('id'), url, 'province_id');
        });
    </script>

@endsection
