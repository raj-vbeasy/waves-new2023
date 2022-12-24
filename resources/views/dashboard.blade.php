@extends('layouts.app')

@push('post-css')
    <style>
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 40px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 2px;
            font-size: 43px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                <img src="{{ asset('assets/img/imgpsh_fullsize_anim.png') }}" alt="Trulli" width="700" height="350"> <br>
            </div>

            <div class="links">
                <h1> Welcome to Squeak E. Clean Waves Web Portal</h1>
                <h4>
                    The non exclusive licensing service of <a href="https://www.squeakeclean.com/">Squeak E. Clean Studios.</a><br><br>
                    This website was designed to ease the process of on-boarding and keeping your catalog up to date<br> with us.<br><br>
                    If you have any questions or issues while you’re going through this site, <br>please feel free to email <a href="mailto:blade@squeakeclean.com"> blade@squeakeclean.com</a><br><br>
                    We’re excited to have you on board!</a> </h4>
            </div>
        </div>
    </div>
@endsection