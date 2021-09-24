@extends('auth.layouts.app')
@section('title','email varified')
@push('styles')
    <style>
        .login .wrapper.wrapper-login .container-login h3, .login .wrapper.wrapper-login .container-signup h3 {
            margin-bottom: 0px;
        }
    </style>
@endpush
@section('content')
<div class="container container-login animated fadeIn">
    <h3 class="card-header bg-secondary-gradient text-white">{{ __('Verify Your Email Address') }}</h3>

    <div class="card-body">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
    </div>
</div>
@endsection
