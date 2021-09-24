
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
<div class="container container-login animated fadeIn">
<h3 class="card-header bg-secondary-gradient text-white">{{ __('Reset Password') }}</h3>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.password.email') }}">
    @csrf


            <div class="form-group form-floating-label">
                <input id="email" type="text" class="form-control input-border-bottom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="email" class="placeholder  @error('email') is-invalid @enderror">{{ __('E-Mail') }}</label>
            </div>

            <div class="form-action mb-3">
                <button type="submit" class="btn btn-primary btn-rounded btn-login">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
