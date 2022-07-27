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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.min.css"
        integrity="sha512-n48mMpd2Ez+soTQuZManEgeJeSeBNynyPL7S23uY5zKXZiEpKn529rl4Zu01ZiJEyJPBYMPp5AxNQD3XRh1oeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <div class="container ">
                    <div style="padding-top:5px;">
                        <a class="e-btn" href="/test">Go to Test</a>
                    </div>
                    <div class="row justify-content-center">
                        <h5>New Feature</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="1">

                            <label class="form-check-label" for="1">
                               
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.min.js"
        integrity="sha512-PnQiQIdb86U1QdVJOzyZQWS0deb1BFZisR6aEuRtc8KZopFYm5wLqL6+LZMgHmg/niTTEXjUA0C3bhc8CFUzjQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    <script src={{ asset('js/prism.js') }}></script>

    @stack('scripts')

</body>

</html>
