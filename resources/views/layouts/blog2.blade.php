<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description"
        content="The Laravel portal for problem solving, knowledge sharing and community building." />
    <!-- Styles -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/theme.js') }}" defer></script> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    @include('layouts._favicons')
    @include('layouts._social')
    {{-- @include('layouts._fathom') --}}
    @livewireStyles
</head>

<body
    class="selection:bg-rose-600 dark:selection:bg-rose-500 selection:text-white w-full dark:bg-gray-900 text-gray-700 dark:text-gray-300">
    @include('layouts._nav')
   
    <div class="mt-2 flex-col flex justify-between w-screen  lg:flex-row max-w-7xl">
       
        <div class="flex-none w-full lg:w-1/3 lg:px-7 mt-4 shadow-sm sticky top-24 p-2">
            @yield('content-right')
        </div> 
        <div class="flex-auto w-full lg:w-2/3 ">
            @yield('content')
        </div>
    </div>
    @include('layouts._footer')
    @stack('modals')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <script src={{ asset('js/prism.js') }}></script> --}}
    @stack('scripts')
    @livewireScripts
</body>

</html>
