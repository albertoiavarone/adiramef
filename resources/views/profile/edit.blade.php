@extends('layout.app')
@section('title','edit' )
@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            @if (session('status') == "profile-information-updated")
                <div class="alert alert-success">
                    {{__('general.profile_updated')}}
                </div>
            @endif

            <h3 class=""> {{ __('general.profile') }}</h3>

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
                    <form method="POST" action="{{ route('user-profile-information.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <p p class="alert alert-light">{{ __('roles.role') }}:
                                    <span class="font-weight-bolder text-primary">{{__('roles.'.auth()->user()->getRoleNames()[0])}}</span>
                                </p>

                            </div>
                            <div class="col-md-8">
                            </div>

                            <div class="col-md-4">
                                <label for="" class="col-form-label">{{ __('users.code') }}</label>
                                <input type="text" class="form-control " value="{{ auth()->user()->code }}" disabled>
                            </div>
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">{{ __('users.name') }}</label>
                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? auth()->user()->name }}" disabled autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">{{ __('users.email') }}</label>
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control border border-success @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? auth()->user()->email }}" required autocomplete="email" autofocus>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-check-circle text-success"></i></span>
                                        </div>
                                    </div>
                                     @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-8">
                            </div>
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

                            <div class="col-md-1 pt-10">
                                <div class="symbol symbol-80 symbol-sm  flex-shrink-0 ">
                                    <img class="img-fluid" src="{{ asset( !is_null(auth()->user()->image) ? 'storage/'.auth()->user()->image : 'assets/media/users/blank.png') }}">
                                </div>
                            </div>
                            <div class="col-md-3 pt-20">
                                <button type="button" class="btn btn-outline-secondary float-left"
                                    data-toggle="modal" data-target="#uploadProfileImage">
                                        <i class="fa fa-edit"></i> {{ __('users.profile_image_change')}}
                                </button>
                            </div>
                            <div class="col-md-8">
                            </div>

                        </div>

                        <hr class="mt-10">
                        <div class="btn-group float-right mt-10">
                            <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">
                                <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
                            </a>
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fa fa-save"></i> {{__('general.save')}}
                            </button>
                        </div>
                    </form>
                </div>
                <!-- end:tab-pane  -->
                <!-- start:tab-pane  -->
                <div class="tab-pane fade " id="userdata" role="tabpanel" aria-labelledby="userdata-tab">

                    <div class="row">
                        @forelse(auth()->user()->details as $user_detail)
                        <div class="col-md-3">
                            @include('users.shared.card_detail')
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- end:tab-pane  -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent

    {!! view('users.modals.add_user_detail', ['user' => auth()->user(),'route_callback'=>'']) !!}
    <div id="modal_edit_user_detail"></div>
    <!-- Modal uploadProfileImage-->
    <div class="modal fade" id="uploadProfileImage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadProfileImageLabel">{{__('users.profile_image_change')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('profile.image') }}" enctype="multipart/form-data" id="uploadProfileImageForm">
                        @csrf
                        <div class="form-group">
							<label>{{__('users.profile_image')}}</label>
							<div class="input-group">
								<input class="form-control" type="file" name="uploaded_file" required>
								<div class="input-group-append">
									<button type="submit" class="btn btn-primary" ><i class="fa fa-upload"></i> {{ __('general.submit')}}</button>
								</div>
							</div>
						</div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{__('general.cancel')}}</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        set_select2('timezone');
        $(function(){
            //
        });

        function editDetail(id){
            $.get("{{url('userdetails/edit')}}/"+id , function(data){
                $("#modal_edit_user_detail").html( data );
                $('#editUserDetail').modal('show');
            });

        }
        function editAccountDetail(id){
            $.get("{{url('usersaccountdetails/edit')}}/"+id , function(data){
                $("#modal_edit_user_account_detail").html( data );
                $('#editUserAccountDetail').modal('show');
            });

        }
    </script>

@endsection
