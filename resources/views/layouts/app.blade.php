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
    <script src="{{ asset('js/theme.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.min.css" integrity="sha512-n48mMpd2Ez+soTQuZManEgeJeSeBNynyPL7S23uY5zKXZiEpKn529rl4Zu01ZiJEyJPBYMPp5AxNQD3XRh1oeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" type="text/css" href={{ asset('css/prism.css') }}>
    <link href="{{ asset('assets') }}/css/home.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')

</head>

<body>

    <div id="app">
        <div class="wrapper w-full">

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js" integrity="sha512-Rc24PGD2NTEGNYG/EMB+jcFpAltU9svgPcG/73l1/5M6is6gu3Vo1uVqyaNWf/sXfKyI0l240iwX9wpm6HE/Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.min.js" integrity="sha512-PnQiQIdb86U1QdVJOzyZQWS0deb1BFZisR6aEuRtc8KZopFYm5wLqL6+LZMgHmg/niTTEXjUA0C3bhc8CFUzjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src={{ asset('js/prism.js') }}></script>
    <script src={{ asset('js/flowbite.js') }}></script>

    @stack('scripts')
</body>

</html>
