@extends('auth.layout.index')
@section('title', 'Password Reset')
@section('page-title', 'Password Reset')

@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group form-focus">
            <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>

            <input id="email"
                   type="email"
                   class="form-control floating @error('email') is-invalid @enderror"
                   name="email"
                   value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group form-focus">
            <label for="password" class="control-label">{{ __('Password') }}</label>

            <input id="password"
                   type="password"
                   class="form-control floating @error('password') is-invalid @enderror"
                   name="password"
                   required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group form-focus">
            <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm"
                   type="password"
                   class="form-control floating"
                   name="password_confirmation"
                   required
                   autocomplete="new-password">
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block account-btn">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
@endsection
