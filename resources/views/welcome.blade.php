<?php
if(auth()->user()){
    header("location: /home");
    die();
}
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body style="background-image:url('{{asset('assets/media/img/welcome.jpg')}}'); background-repeat: no-repeat; background-position: center; height: 900px;background-size: cover;">
        <div id="app" >
            <nav class="bg-white navbar navbar-expand-md navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <i class="fa fa-home"></i> Home
                    </a>
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        <div class="collapse navbar-collapse right-0" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="mr-auto navbar-nav">
                                @if (Route::has('login'))
                                    @auth
                                        <li class="mr-2"><a class="btn btn-sm btn-outline-secondaray" href="{{route('home')}}">Home</a></li>
                                    @else
                                        <li class="mr-2"><a class="btn btn-sm btn-outline-info" href="{{route('login')}}">{{__('auth.login')}}</a></li>
                                        @if (Route::has('register'))
                                            <li class="mr-2"><a class="btn btn-sm btn-outline-primary" href="{{route('register')}}">{{__('auth.register')}}</a></li>
                                        @endif
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </nav>
            <main class="py-4">
                <div class="container" style="padding-top:10px">
                    <!--<p class="text-center align-text-bottom">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>-->
                </div>
            </main>
        </div>
    </body>
</html>
