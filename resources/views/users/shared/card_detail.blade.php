            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end">
                        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" >
                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover">
                                    <li class="navi-footer py-1">
                                        <button class="btn btn-clean font-weight-bold btn-sm" onclick="editDetail({{ $user_detail->id }})">
                                            <i class="fa fa-edit"></i> {{__('general.edit')}}
                                        </button>
                                    </li>

                                </ul>
                                <!--end::Navigation-->
                            </div>
                        </div>
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::User-->
                    <div class="d-flex align-items-end mb-7">
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <span class="text-muted font-weight-bold">
                                @if($user_detail->is_default)
                                    <i class="fas fa-check text-success" title="{{__('users.default')}}"></i>
                                @else
                                     <i class="fas fa-address-card"></i>
                                @endif
                                 {{ $user_detail->label}}
                            </span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::User-->

                    <!--begin::Info-->
                    <div class="mb-7">
                        @if($user_detail->is_business)
                            <div class="d-flex justify-content-between align-items-center">
                                <span  class="text "><i class="fa fa-industry"></i> {{ $user_detail->company_name}}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted pl-5">{{ $user_detail->vat_number}}</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                                @if(!$user_detail->is_business)
                                <span  class="text"> <i class="fa fa-user-circle"></i>
                                @else
                                <span  class="text-muted pl-5">
                                @endif
                                {{ $user_detail->name}} {{ $user_detail->surname}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span  class="text-muted pl-5">{{ __('users.fiscal_code_abbreviation').' '.$user_detail->fiscal_code}}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted ">
                                <i class="fa fa-map-marker-alt"></i>
                                {{ $user_detail->address}} {{ $user_detail->address_number}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span  class="text-muted pl-5">
                                <!--<i class="fa fa-map-marker-alt"></i>-->
                                {{ $user_detail->postal_code }}
                                {{ data_get($user_detail,'city.name') }}
                                {{ data_get($user_detail, 'city.province.provice_abbreviation') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted pl-5">
                                <!--<i class="fa fa-globe"></i>-->
                                {{ data_get($user_detail, 'nation.countryName') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                <i class="fas fa-address-book"></i>
                                {{ $user_detail->email }}
                            </span>
                        </div>
                        @if($user_detail->pec)
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted pl-5">
                                {{ $user_detail->pec }}
                            </span>
                        </div>
                        @endif
                        @if($user_detail->phone_number)
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted pl-5">
                                {{ $user_detail->phone_number }}
                            </span>
                        </div>
                        @endif
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Body-->
            </div>
