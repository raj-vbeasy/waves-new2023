@extends('auth.layout.index')
@section('title', 'Login')
@section('page-title', 'Login')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group form-focus">
            <label for="email" class="control-label">Email</label>
            <input id="email"
                   name="email"
                   class="form-control floating @error('email') is-invalid @enderror"
                   type="text"
                   value="{{ old('email') }}"
                   autocomplete="email"
                   autofocus
            >
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group form-focus">
            <label for="password" class="control-label">Password</label>
            <input id="password"
                   class="form-control floating @error('password') is-invalid @enderror"
                   type="password"
                   name="password"
                   autocomplete="current-password"
            >
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary btn-block account-btn" type="submit">Login</button>
        </div>
        @if (Route::has('password.request'))
            <div class="text-center">
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
        @endif
        <div class="text-center" style="margin-top: 20px">
            <a href="{{ route('register') }}">Not a user? Signup</a>
        </div>
    </form>
@endsection
