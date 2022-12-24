<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/morris/morris.css') }}">
    @stack('pre-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    @stack('post-css')
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif]-->

    <style>
        button.btn.btn-default:hover {
            background: #000;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @yield('content')
        </div>
    </div>
    @stack('modals')
</div>
<div class="sidebar-overlay" data-reff="#sidebar"></div>
<footer class="footer mt-auto text-center">
    <div class="copyright">
        <p>
            Copyrights© <span id="copy-year"></span> Squeak E. Clean Waves | Developed by <a class="text-primary" href="https://vbeasy.com" target="_blank"><img src="{{ asset('assets/img/logo2.png') }}" alt="VB Easy" class="img-fluid" style="width: 100px;"></a> | Version-2.2
        </p>
    </div>
    <script>
		document.getElementById("copy-year").innerHTML = (new Date()).getFullYear().toString();
    </script>
</footer>
</body>
<script type="text/javascript" src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
@stack('pre-js')
<script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
@stack('post-js')
</html>
