<div class="header">
    <div class="header-left">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('assets/img/logo.png') }}" width="150" height="50" alt="">
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="la la-bars"></i></a>
    <div class="page-title-box pull-left">
        <h3>{{ config('app.name') }}</h3>
    </div>
    <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
    <ul class="nav navbar-nav navbar-right user-menu pull-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
                <span class="user-img"><img class="img-circle" src="{{ asset('assets/img/user.jpg') }}" width="40" alt="Admin">
                    <span class="status online"></span>
                </span>
                <span>{{ auth()->user()->name }}</span>
                <i class="caret"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="javascript:void(0)"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <ul class="dropdown-menu pull-right">
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Edit Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li>
                <a href="javascript:void(0)"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >Logout</a></li>
        </ul>
    </div>
</div>