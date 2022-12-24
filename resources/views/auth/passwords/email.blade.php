@extends('auth.layout.index')
@section('title', 'Password Reset')
@section('page-title', 'Password Reset')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group form-focus">
            <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
            <input id="email"
                   type="email"
                   class="form-control floating @error('email') is-invalid @enderror"
                   name="email"
                   value="{{ old('email') }}"
                   required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block account-btn">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>
@endsection
