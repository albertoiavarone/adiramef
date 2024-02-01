                            <div class="topbar">
								<!--begin::Search-->
                                @if(0)
                                    @include('layout.basic.topbar.search')
                                    <!--begin::Quick Actions-->
                                    @include('layout.basic.topbar.quick_actions')
                                    <!--end::Quick Actions-->
                                    <!--begin::Chat-->
    								@include('layout.basic.topbar.chat')
    								<!--end::Chat-->
                                    <!--begin::Quick Actions-->
                                    @include('layout.basic.topbar.quick_actions')
                                    <!--end::Quick Actions-->
    								<!--begin::Quick panel-->
    								@include('layout.basic.topbar.quick_panel')

                                @endif
                                <!--begin::Notifications-->
								@include('layout.basic.topbar.notifications')
								<!--end::Notifications-->
								<!--begin::Languages-->
								@include('layout.basic.topbar.languages')
								<!--end::Languages-->
								<!--begin::User-->
								@include('layout.basic.topbar.user')
								<!--end::User-->
							</div>
							<!--end::Topbar-->
