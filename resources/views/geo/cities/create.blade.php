@extends('layout.app')
@section('title',__('geo.cities'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('cities')}}" class="text-muted">{{__('geo.cities')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{__('general.add')}}</span>
    </li>
@endsection

@section('content')
    <h4>{{__('general.add')}} {{__('geo.city')}}</h4>
    {!! BootForm::open()
        ->action(route('cities.store'))
        ->post()
        ->id('cities-create')
    !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('geo.nation')}}</label>
                <select class="form-control" name="nation_id" id="nation_id" required>
                    <option value=""></option>
                    @forelse($nations as $nation)
                       <option value="{{ $nation->id }}">{{ $nation->countryName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __('geo.province')}}</label>
                <select class="form-control" name="province_id" id="province_id" required>
                    <option value=""></option>
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
    </div>

    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('cities.index') }}">
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
            set_select2('nation_id');
            set_select2('province_id');
        })
        $('#nation_id').change(function(){
            var url = "{{ url('geo/nations/provinces') }}/"+$(this).val();
            getAjaxDataSelectOptions($(this).attr('id'), url, 'province_id');
        });
    </script>

@endsection
