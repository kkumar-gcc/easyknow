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
                        <div class="col-md-8">
                            <div class="e-card">
                                <div class="e-card-body ">
                                    <div class="e-card-title">{{ __('Test Register') }}</div>
                                    <form method="POST" id="register">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="username"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                                            <div class="col-md-6">
                                                <input id="username" type="text" class="form-control"
                                                    name="username" value="{{ old('username') }}" required
                                                    autocomplete="email" autofocus>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="firstName"
                                                class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                                            <div class="col-md-6">
                                                <input id="firstName" type="text" class="form-control"
                                                    name="firstName" value="{{ old('firstName') }}" required
                                                    autocomplete="firstName" autofocus>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="lastName"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                                            <div class="col-md-6">
                                                <input id="lastName" type="text" class="form-control"
                                                    name="lastName" value="{{ old('lastName') }}" required
                                                    autocomplete="lastName" autofocus>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="password"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control"
                                                    name="password" required autocomplete="current-password">
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="e-btn e-btn-success">
                                                    {{ __('Register') }}
                                                </button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="response-div" style="display:none">
                        <pre class="language-json" tabindex="0">
                            <code class="language-json" id="response">
                            </code>
                        </pre>
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

    <script>
        $(document).ready(function() {
            $(document).on("submit", "#register", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'https://yournoteserver.herokuapp.com/users',
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(data) {
                        $("#response").html(JSON.stringify(data,null,4));
                        $("#response-div").show('slow');
                    },
                    error: function(data) {
                        $("#response").html(JSON.stringify(data,null,4));
                        $("#response-div").show('slow');
                    }
                });
            });
        });
    </script>
</body>

</html>
