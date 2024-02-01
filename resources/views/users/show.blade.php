@extends('layout.app')
@section('title',__('users.user'))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('users')}}" class="text-muted">{{__('users.users')}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{$user->name}}</span>
    </li>
@endsection

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile">
                <span class="nav-icon">
                    <i class="fa fa-user"></i>
                </span>
                <span class="nav-text">Account</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link active" id="userdata-tab" data-toggle="tab" href="#userdata" aria-controls="userdata">
                <span class="nav-icon">
                    <i class="far fa-id-card"></i>
                </span>
                <span class="nav-text">{{__('users.user_data')}}</span>
            </a>
        </li>
    </ul>
    <div class="tab-content mt-5 p-5" id="myTabContent">

        <!-- start:tab-pane  -->
        <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-4">{{__('users.name')}}</dt>
                        <dd class="col-md-8">{{ $user->name }}</dd>
                        <dt class="col-md-4">{{__('users.code')}}</dt>
                        <dd class="col-md-8">{{ $user->code }}</dd>
                        <dt class="col-md-4">{{__('users.email')}}</dt>
                        <dd class="col-md-8">{{ $user->email }}</dd>
                        <dt class="col-md-4">{{__('users.code')}}</dt>
                        <dd class="col-md-8">{{ $user->code }}</dd>
                        <dt class="col-md-4">{{__('roles.role')}}</dt>
                        <dd class="col-md-8">{{ $user->getRoleNames()[0] }}</dd>
                        <dt class="col-md-4">{{__('users.language')}}</dt>
                        <dd class="col-md-8">{{ $user->language }}</dd>
                        <dt class="col-md-4">{{__('users.timezone')}}</dt>
                        <dd class="col-md-8">{{ $user->timezone }}</dd>
                    </dl>
                </div>
                <div class="col-md-8"></div>
            </div>
        </div>
        <!-- end:tab-pane  -->
        <!-- start:tab-pane  -->
        <div class="tab-pane fade  active show" id="userdata" role="tabpanel" aria-labelledby="userdata-tab">
            <div class="row">
                @if(count($user->details) == 0)
                <p class="text-muted px-5"><i class="fa fa-times"></i> {{__('general.data_not_found')}}</p>
                @endif
                @forelse($user->details as $user_detail)
                <div class="col-md-4">
                    <div class="card my-3">
                        <div class="card-header bg-light p-3">
                            @if($user_detail->is_default)
                                <i class="fas fa-check text-success" title="{{__('users.default')}}"></i>
                            @else
                                <i class="fas fa-address-card"></i>
                            @endif
                            {{$user_detail->label}}
                            @if($user_detail->is_business)
                            <span class="badge badge-primary float-right"><small>{{__('users.business')}}</small></span>
                            @endif
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                @if($user_detail->is_business)
                                <dt class="col-md-4">{{__('users.company_name')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->company_name }}</dd>
                                <dt class="col-md-4">{{__('users.vat_number')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->vat_number }}</dd>
                                @endif
                                <dt class="col-md-4">{{__('users.surname')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->surname }}</dd>
                                <dt class="col-md-4">{{__('users.name')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->name }}</dd>
                                <dt class="col-md-4">{{__('users.fiscal_code')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->fiscal_code}}</dd>

                                <dt class="col-md-4">{{__('users.address')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->address }}</dd>
                                <dt class="col-md-4">{{__('users.address_number')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->address_number }}</dd>

                                <dt class="col-md-4">{{__('users.postal_code')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->postal_code }}</dd>
                                <dt class="col-md-4">{{__('geo.city')}}</dt>
                                <dd class="col-md-8">{{ data_get($user_detail,'city.name' ) }}</dd>
                                <dt class="col-md-4">{{__('geo.province')}}</dt>
                                <dd class="col-md-8">{{ data_get($user_detail,'province.name' ) }}</dd>
                                <dt class="col-md-4">{{__('geo.nation')}}</dt>
                                <dd class="col-md-8">{{ data_get($user_detail,'nation.countryName' ) }}</dd>

                                <dt class="col-md-4">{{__('users.email')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->email }}</dd>
                                <dt class="col-md-4">{{__('users.pec')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->pec }}</dd>
                                <dt class="col-md-4">{{__('users.phone_number')}}</dt>
                                <dd class="col-md-8">{{ $user_detail->phone_number }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- end:tab-pane  -->
    </div>
    <hr class="mt-10">
    <div class="btn-group float-right mt-10">
        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">
            <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
        </a>
        <a class="btn btn-outline-info" href="{{ route('users.edit',$user->uuid) }}">
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
