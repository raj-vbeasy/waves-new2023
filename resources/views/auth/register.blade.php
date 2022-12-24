@extends('auth.layout.index')
@section('title', 'Register')
@section('page-title', 'Register')
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group form-focus">
            <label for="name" class="control-label">Artist/Band Name</label>
            <input id="name"
                   name="name"
                   class="form-control floating @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   type="text"
                   autofocus
                   autocomplete="name"
            >
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group form-focus">
            <label for="email" class="control-label">Email</label>
            <input id="email"
                   name="email"
                   class="form-control floating @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   autocomplete="email"
                   type="text"
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
                   name="password"
                   class="form-control floating @error('password') is-invalid @enderror"
                   autocomplete="new-password"
                   type="password"
            >
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group form-focus">
            <label for="password-confirm" class="control-label">Repeat Password</label>
            <input id="password-confirm"
                   class="form-control floating"
                   name="password_confirmation"
                   type="password"
                   autocomplete="new-password"
            >
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary btn-block account-btn" type="submit">Register</button>
        </div>
        <div class="text-center">
            <a href="{{ route('login') }}">Already have an account?</a>
        </div>
    </form>
@endsection
