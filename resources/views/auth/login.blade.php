@extends('auth.layouts.app')
@section('title',"login")

@section('content')
<div class="container container-login animated fadeIn">
    <h3 class="card-header bg-secondary-gradient text-white">Sign In To Student</h3>
    <div class="login-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group form-floating-label">
                <input id="email" type="text" class="form-control input-border-bottom @error('email') is-invalid @enderror" name="email"  required autocomplete="email" autofocus value="demo@student.com">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="email" class="placeholder  @error('email') is-invalid @enderror">{{ __('Student Id/E-Mail') }}</label>
            </div>
            <div class="form-group form-floating-label">
                <input id="password" type="password" class="form-control input-border-bottom @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" value="12345678">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="password" class="placeholder @error('password') is-invalid @enderror">{{ __('Password') }}</label>

            </div>
            <div class="row form-sub m-0">
                <div class="custom-control custom-checkbox">
                    <input class="form-check-input custom-control-input" id="rememberme" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="rememberme">{{ __('Remember Me') }}</label>
                </div>

                @if (Route::has('password.request'))
                <a class="link float-right" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
            <div class="form-action mb-3">
                <button type="submit" class="btn btn-primary btn-rounded btn-login">
                    {{ __('Login') }}
                </button>
            </div>

            <div class="login-account">
                <span class="msg">Don't have an account yet ?</span>
                <a href="{{ route('register') }}"  class="link">Sign Up</a>
            </div>
            <div class="login-account">
                <a href="{{ route('admin.login') }}"  class="link">Click for admin login</a>
            </div>
        </form>
    </div>
</div>
@endsection
