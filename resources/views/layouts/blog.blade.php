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
    <script src="{{ asset('js/theme.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href={{ asset('css/prism.css') }}>
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
    <style>
        .code-toolbar pre:not(.default-pre) {
            border-radius: 22px;
        }
    </style>
</head>

<body>
    <?php
    Str::macro('readDuration', function (...$text) {
        $totalWords = str_word_count(implode(' ', $text));
        $minutesToRead = round($totalWords / 200);
        return (int) max(1, $minutesToRead);
    });
    ?>
    <div id="app">
        <div class="wrapper w-full dark:bg-neutral-900 dark:text-gray-500">
            @include('layouts.navbars.navbars')
            <div class="mt-2 flex-col flex justify-between w-screen  lg:flex-row max-w-7xl">
                <div class="blog">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <script src={{ asset('js/flowbite.js') }}></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js"
        integrity="sha512-Rc24PGD2NTEGNYG/EMB+jcFpAltU9svgPcG/73l1/5M6is6gu3Vo1uVqyaNWf/sXfKyI0l240iwX9wpm6HE/Tg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.min.js"
        integrity="sha512-PnQiQIdb86U1QdVJOzyZQWS0deb1BFZisR6aEuRtc8KZopFYm5wLqL6+LZMgHmg/niTTEXjUA0C3bhc8CFUzjQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src={{ asset('js/prism.js') }}></script>

    @stack('scripts')

</body>

</html>
