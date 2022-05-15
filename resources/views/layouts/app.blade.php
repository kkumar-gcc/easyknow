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
    <link rel="stylesheet" type="text/css" href={{ asset('css/prism.css') }}>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/home.css" rel="stylesheet" />

    @yield('style')
</head>

<body>

    <div id="app">
        <div class="wrapper">
            @include('layouts.navbars.navbars')
            <div class="main-panel">
                <div class="left">
                    <div class="content">
                        <div class="alert alert-info" role="alert" data-mdb-color="info">
                            <div class="sub-body">
                                <h5 class="sub-title ">Location</h5>
                                <hr>
                                <ul class="sidebar-nav" style="padding-left:10px;">
                                    <li class="sidebar-item">
                                        <p class="sidebar-link sidebar-change alert-link">
                                            <span class="icon-primary">{{ svg('bi-facebook') }}
                                            </span>
                                            facebook  </p>
                                    </li>
                                    <li class="sidebar-item">
                                        <p class="sidebar-link sidebar-change alert-link">
                                            <span class="icon-primary">{{ svg('bi-facebook') }}
                                            </span>
                                            facebook  </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- @yield('content-left') --}}
                    </div>
                </div>
                <div class="middle">
                    {{-- <div class="content"> --}}
                        @yield('content')
                    {{-- </div> --}}
                </div>
                <div class="right">
                    <div class="content">
                        <div class="alert alert-info" role="alert" data-mdb-color="info">
                            <div class="sub-body">
                                <h5 class="sub-title ">Location</h5>
                                <hr>
                                <ul class="sidebar-nav" style="padding-left:10px;">
                                    <li class="sidebar-item">
                                        <p class="sidebar-link sidebar-change alert-link">
                                            <span class="icon-primary">{{ svg('bi-facebook') }}
                                            </span>
                                            facebook  </p>
                                    </li>
                                    <li class="sidebar-item">
                                        <p class="sidebar-link sidebar-change alert-link">
                                            <span class="icon-primary">{{ svg('bi-facebook') }}
                                            </span>
                                            facebook  </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- @yield('content-right') --}}
                    </div>
                </div>
                {{-- @guest
                    @if (Route::has('login'))
                        <li class="nav-item ">
                            <a class="link link-secondary sbtn " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item ">
                            <a class="link link-secondary sbtn ml-3"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @endguest --}}
                {{-- <div class="content">
                        @yield('content')
                    </div> --}}

            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script> --}}
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    <script src={{ asset('js/prism.js') }}></script>
    @yield('script')
</body>

</html>
