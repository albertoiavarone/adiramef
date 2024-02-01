<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} - @yield('title')</title>
        @include('layout.basic.head')
        @section('head')
        @show
    </head>
    @auth
    <!--<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading aside-minimize">
      <!--begin::Main-->
        @include('layout.basic.header.header_mobile')
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
    			<div class="d-flex flex-row flex-column-fluid page">
    				<!--begin::Aside-->
                     @include('layout.basic.menu')
                    <!--end::Aside-->
                    <!--begin::Wrapper-->
    				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
    					<!--begin::Header-->
    					<div id="kt_header" class="header header-fixed">
    						<!--begin::Container-->
                            <p><img alt="MES" src="{{asset('assets/media/logos/mes.png')}}" class=" mt-2 ml-10" style="max-height: 50px" /></p>
    						<div class="container-fluid d-flex align-items-stretch justify-content-between">
                                <!--begin::Header Menu Wrapper-->
                                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                    {{-- @include('layout.basic.header.menu_wrapper') --}}
                                </div>
                                <!--end::Header Menu Wrapper-->
                                <!--end::Topbar-->
                                @include('layout.basic.topbar.topbar')
                                <!--begin::Topbar-->
                            </div>
                            <!--end::Container-->
    					</div>
    					<!--end::Header-->

                        <!--begin::Content-->
                        @include('layout.basic.content')
                        <!--end::Content-->

                        <!--begin::Footer-->
                        @include('layout.basic.footer')
                        <!--end::Footer-->
                </div>
            <!--end::Page-->
        </div>
      <!--end::Main-->

      <!-- begin::User Panel-->
      @include('layout.basic.panel.user')
      <!-- end::User Panel-->

      <!--begin::Quick Panel-->
      @include('layout.basic.panel.quick_panel')
	  <!--end::Quick Panel-->

      <!--begin::Chat Panel-->
      @include('layout.basic.panel.chat')
      <!--end::Chat Panel-->

      <!--begin::Scrolltop-->
	  @include('layout.basic.scrolltop')
      <!--end::Scrolltop-->

    @endauth
    @guest
    <body id="kt_body" class="bg-white">
            @yield('content')
    @endguest


    @include('layout.basic.scripts')
    @include('layout.basic.shared.toastr')
    @yield('script')
    @show
    </body>


</html>
