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
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href={{ asset('css/prism.css') }}>
   
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="{{ asset('assets') }}/css/home.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
    <style>
        .code-toolbar pre:not(.default-pre) {
            border-radius: 22px;
        }
    </style>
    @livewireStyles
</head>

<body
    class="selection:bg-rose-600 dark:selection:bg-rose-500 selection:text-white w-full dark:bg-gray-900 text-gray-700 dark:text-gray-300">
    <?php
    Str::macro('readDuration', function (...$text) {
        $totalWords = str_word_count(implode(' ', $text));
        $minutesToRead = round($totalWords / 200);
        return (int) max(1, $minutesToRead);
    });
    ?>

    @include('layouts._nav')
    <div class="w-full px-2 mt-2 text-gray-700 sm:px-6 sm:mt-6 md:px-20 md:mt-16 dark:text-gray-300">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src={{ asset('js/prism.js') }}></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
