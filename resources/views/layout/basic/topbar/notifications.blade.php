<div class="dropdown">
    <!--begin::Toggle-->
    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 {{ auth()->user()->unreadNotifications->count() > 0 ? 'pulse pulse-danger' : '' }}">
            <i class="far fa-bell {{  auth()->user()->unreadNotifications->count() > 0 ? 'text-danger' : '' }}"></i>
            <span class="pulse-ring"></span>
        </div>
    </div>
    <!--end::Toggle-->
    <!--begin::Dropdown-->
    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg" style="">

            <!--begin::Header-->
            <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image:  url({{asset('assets/media/misc/bg-1.jpg')}})">
                <!--begin::Title-->
                <h4 class="d-flex flex-center rounded-top mb-5">
                    <span class="text-white">{{ trans_choice('notifications.notification',2)}}</span>
                </h4>
                <p class="text-white text-center">
                    <strong>{{ auth()->user()->unreadNotifications->count() }}</strong>
                    {{ trans_choice('notifications.unreaded_notification', auth()->user()->unreadNotifications->count() )}}
                </p>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="tab-content">
                <!--begin::Tabpane-->
                <div class="tab-pane show active p-8" id="topbar_notifications_sharings" role="tabpanel">
                    <!--begin::Scroll-->
                    <div class="scroll pr-7 mr-n3 ps ps--active-y" data-scroll="true" data-height="300" data-mobile-height="200" style="height: 300px; overflow: hidden;">
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40 symbol-light-primary mr-3">
                                    <span class="symbol-label">
                                        <a href="javascript:void(0)" id="Notify_{{$notification->id}}" class="text-dark text-hover-primary mb-1 font-size" onclick="markAsReadNotification('{{$notification->id}}', '{{$notification->data['url']}}' )">
                                            <i class="fas fa-bullhorn"></i>
                                        </a>
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column font-weight-bold">
                                    <a href="javascript:void(0)" id="Notify_{{$notification->id}}" class="text-dark text-hover-primary mb-1 font-size" onclick="markAsReadNotification('{{$notification->id}}', '{{$notification->data['url']}}' )">
                                        {{ trans_choice('notifications.'.$notification->data['group'],1) }}
                                    </a>
                                    <span class="text-muted text-left font-size-sm">{{convertToLocal($notification->created_at)}}</span>
                                    <span class="text-muted font-size-sm">{{ $notification->data['text'] }}</span>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                        @endforeach
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                    <!--end::Nav-->
                    <h5 class="text-center text-mute"><a class="" href="{{route('my.notifications')}}">{{__('notifications.all_notifications')}}</a></h5>
                </div>
                <!--end::Tabpane-->

            </div>
            <!--end::Content-->
    </div>
    <!--end::Dropdown-->
</div>
