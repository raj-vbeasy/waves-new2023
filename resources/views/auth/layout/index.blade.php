<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
<div class="main-wrapper">
    <div class="account-page">
        <div class="container">
            <h3 class="account-title">@yield('page-title')</h3>
            <div class="account-box">
                <div class="account-wrapper">
                    <div class="account-logo">
                        <a href="javascript:void(0)">
                            <img src="{{ asset("assets/img/logo.png") }}" style="min-width: 250px;margin-bottom: 30px;" alt="">
                        </a>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sidebar-overlay" data-reff="#sidebar"></div>
<footer class="footer mt-auto text-center">
    <div class="copyright bg-white">
        <p>
            Copyrights© <span id="copy-year"></span> Squeak E. Clean Waves | Developed by <a class="text-primary" href="https://www.vbeasy.com" target="_blank"><img src="{{ asset('assets/img/logo2.png') }}" alt="VB Easy" class="img-fluid" style="width: 100px;"></a> | Version-2.2

        </p>
    </div>
    <script>
		document.getElementById("copy-year").innerHTML = (new Date()).getFullYear().toString();
    </script>
</footer>
</body>
<script type="text/javascript" src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
</html>
