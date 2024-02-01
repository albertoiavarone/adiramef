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

    <h4 class="text-primary my-4">{{ $user->name }} <small class="text-muted">{{__('users.code').' '.$user->code}}</small></h4>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile">
                <span class="nav-icon">
                    <i class="fa fa-user"></i>
                </span>
                <span class="nav-text">Account</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " id="userdata-tab" data-toggle="tab" href="#userdata" aria-controls="userdata">
                <span class="nav-icon">
                    <i class="far fa-id-card"></i>
                </span>
                <span class="nav-text">{{__('users.user_data')}}</span>
            </a>
        </li>
    </ul>
    <div class="tab-content mt-5 p-5" id="myTabContent">
        <!-- start:tab-pane  -->
        <div class="tab-pane fade active show " id="profile" role="tabpanel" aria-labelledby="profile-tab">
            {!! BootForm::open()
                ->action(route('users.update', $user->uuid))
                ->put()
                ->id('user-edit')
            !!}
            {!! BootForm::bind($user) !!}
            <div class="row">
                <div class="col-md-4">
                     {!!BootForm::text(__('users.name'), 'name')->required() !!}
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-4">
                     {!!BootForm::email(__('users.email'), 'email')->required() !!}
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="role_id">{{__('roles.role')}}</label>
                        <select class="form-control" name="role_id" id="role_id" required>
                            @forelse($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected':''}} >{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="language" class="col-form-label">{{ __('general.language') }}</label>
                        <select class="form-control" name="language" required>
                            @forelse(config('languages.lang') as $key=>$lang)
                                <option value="{{$key}}" {{ auth()->user()->language == $key ? 'selected' : '' }} >{{ $lang['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="language" class="col-form-label">{{ __('general.timezone') }}</label>
                        <select class="form-control" name="timezone" id="timezone" required>
                            @forelse( \App\Models\Geo\Timezone::all() as $timezone)
                                <option value="{{ $timezone->name }}" {{ auth()->user()->timezone == $timezone->name ? 'selected' : '' }} >{{ $timezone->name.' '.$timezone->offset }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                </div>
            </div>
            <hr class="mt-10">
            <div class="btn-group float-right mt-10">
                <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">
                    <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
                </a>
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fa fa-save"></i> {{__('general.save')}}
                </button>
            </div>
            {!! BootForm::close() !!}
        </div>
        <!-- end:tab-pane  -->
        <!-- start:tab-pane  -->
        <div class="tab-pane fade " id="userdata" role="tabpanel" aria-labelledby="userdata-tab">
            @if(count($user->details) == 0)
            <p class="text-muted px-5"><i class="fa fa-times"></i> {{__('general.data_not_found')}}</p>
            @endif
            <!-- Button trigger modal-->
            <button  class="btn btn-light-primary btn-sm  float-right mb-2" data-toggle="modal" data-target="#addUserDetail">
                <i class="fa fa-plus"></i> {{__('general.add')}}
            </button>
            <div class="clearfix"></div>
            <div class="row">

                @forelse($user->details as $user_detail)
                <div class="col-md-3">
                    @include('users.shared.card_detail')
                </div>
                @endforeach
            </div>
        </div>
        <!-- end:tab-pane  -->
    </div>

@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent

    {!! view('users.modals.add_user_detail', ['user' => $user]) !!}
    <div id="modal_edit_user_detail"></div>
    <script>
        set_select2('timezone');

        function editDetail(id){
            $.get("{{url('userdetails/edit')}}/"+id , function(data){
                $("#modal_edit_user_detail").html( data );
                $('#editUserDetail').modal('show');
            });

        }
    </script>

@endsection
