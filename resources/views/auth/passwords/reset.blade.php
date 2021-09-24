
@extends('auth.layouts.app')
@section('title',"Reset password")
@push('styles')
<style>
    .login .wrapper.wrapper-login .container-login .btn-login, .login .wrapper.wrapper-login .container-signup .btn-login {
        padding: 15px 0px;
        width: 100%;
    }
</style>
@endpush
@section('content')
<div class="container container container-login animated fadeIn">

    <h3 class="card-header bg-secondary-gradient text-white">{{ __('Reset Password') }}</h3>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group form-floating-label">


            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label for="email" class="placeholder  @error('email') is-invalid @enderror">{{ __('E-Mail Address') }}</label>
        </div>

        <div class="form-group form-floating-label">


            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label for="password" class="placeholder  @error('password') is-invalid @enderror">{{ __('Password') }}</label>
        </div>

        <div class="form-group form-floating-label">


            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

            <label for="password-confirm" class="placeholder">{{ __('Confirm Password') }}</label>
        </div>

        <div class="form-group form-floating-label mb-0">
            <button type="submit" class="btn btn-primary">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</div>
@endsection

