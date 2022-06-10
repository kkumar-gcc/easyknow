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
    <link href="{{ asset('assets') }}/css/webui-popover.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href={{ asset('css/prism.css') }}>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/home.css" rel="stylesheet" />
    @stack('styles')

</head>

<body>

    <div id="app">
        <div class="wrapper">
            @include('layouts.navbars.navbars')
            <div class="main-panel">
                <div class="left">
                    <div class="content">

                        @yield('content-left')
                    </div>
                </div>
                <div class="middle">
                    {{-- <div class="content"> --}}
                    @yield('content')
                    {{-- </div> --}}
                </div>
                <div class="right">
                    <div class="content">
                        @yield('content-right')
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script> --}}
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/webui-popover@1.2.18/dist/jquery.webui-popover.min.js"></script>    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    <script src={{ asset('js/prism.js') }}></script>
   
    @stack('scripts')
</body>

</html>
