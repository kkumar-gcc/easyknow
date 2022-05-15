<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/home.css" rel="stylesheet" />

    @yield('style')
</head>

<body>

    <div id="app">
        <div class="wrapper">
            @include('layouts.navbars.navbars')
            <div class="user-main-panel ">
                <div class="left">
                    <div class="content">
                        {{-- @yield('content-left') --}}
                        <div id="gtm-content-others" class="position-relative"
                            style="min-height:175px;margin-bottom: 1rem;">
                            <div class="position-absolute w-100 justify-content-center">
                                <div class="border border-info shadow-3 rounded overflow-hidden"
                                    style="border-color: rgba(133, 214, 251, .3) !important;">
                                    <span class="dc-content-animation mx-2 mb-2 mt-3" style="width: 40%;"></span>
                                    <span class="dc-content-animation mx-2 mb-1" style="width: 70%;"></span>
                                    <span class="dc-content-animation mx-2 mb-1"></span>
                                    <span class="dc-content-animation mx-2 mb-1" style="width: 80%;"></span>
                                    <span class="dc-content-animation mx-2 mb-1" style="width: 70%;"></span>


                                </div>
                            </div>

                            <div id="gtmDC-scroll-unlogged" style="min-height:1px"></div>

                        </div>
                    </div>
                </div>
                <div class="middle">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>

                {{-- <div class="content">
                        @yield('content')
                    </div> --}}

            </div>
        </div>
    </div>
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
    <!-- Chart JS -->
    {{-- <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script> --}}
    <!--  Notifications Plugin    -->

    <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    {{-- <script src="{{ asset('assets') }}/js/theme.js"></script> --}}
    @yield('script')
</body>

</html>
