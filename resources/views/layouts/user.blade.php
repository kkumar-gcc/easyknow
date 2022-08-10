<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/theme.js') }}"></script>
   <!-- Styles -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.min.css"
        integrity="sha512-n48mMpd2Ez+soTQuZManEgeJeSeBNynyPL7S23uY5zKXZiEpKn529rl4Zu01ZiJEyJPBYMPp5AxNQD3XRh1oeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.css"
        integrity="sha512-AQG3JVpy/h0TsLsFs/HDLjnkq1ih9uUliGGXdQ7LQcGQt7GD+1b7HWOQ2oeCH7tKdtrfRg75CGApafi+//9Dbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="{{ asset('assets') }}/css/home.css" rel="stylesheet" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    
</head>

<body class="selection:bg-rose-600 dark:selection:bg-rose-500 selection:text-white">

    <div id="app">
        <div class="wrapper  w-full text-gray-700 dark:text-gray-300 dark:bg-gray-900">
            @include('layouts.navbars.navbars')
            <div class=" flex flex-col-reverse justify-between w-screen  lg:flex-row max-w-7xl">
                <div class="flex-auto w-full lg:w-1/4  shadow-sm sticky top-24 p-2">
                    <div id="sticky-sidebar">
                        @yield('content-left')
                    </div>
                </div>
                <div class="flex-auto w-full lg:w-3/4 ">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js"
        integrity="sha512-Rc24PGD2NTEGNYG/EMB+jcFpAltU9svgPcG/73l1/5M6is6gu3Vo1uVqyaNWf/sXfKyI0l240iwX9wpm6HE/Tg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.min.js"
        integrity="sha512-PnQiQIdb86U1QdVJOzyZQWS0deb1BFZisR6aEuRtc8KZopFYm5wLqL6+LZMgHmg/niTTEXjUA0C3bhc8CFUzjQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src={{ asset('js/prism.js') }}></script>
    <script src={{ asset('js/flowbite.js') }}></script>
    @stack('scripts')
</body>

</html>
