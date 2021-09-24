<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title',"UITS")</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{asset('assets/image/icon.png')}}" type="image/x-icon"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/azzara.min.css') }}">
    @stack('styles')

</head>
<body>
    <div class="wrapper">
        <!--
            Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
        -->
        <div class="main-header" data-background-color="purple">
            <!-- Logo Header -->
            <div class="logo-header">
                @php
                $theme= App\ThemeSetting::find(1);
                $logopath=public_path('assets/image/theme/'.$theme->logo);
                $path=public_path('assets/image/profile/');
             @endphp
               <a href="{{url('/')}}" class="logo">
                @if (!empty($theme->logo)&&file_exists($logopath))
                            <img src="{{ asset('assets/image/theme/'.$theme->logo) }}" alt="{{ config('app.name') }}" class="navbar-brand" width="110" height="50">
                            @else
                            <img src="{{ asset('assets/image/logo/logo.png') }}" alt="{{ config('app.name') }}" class="navbar-brand" width="110" height="50">
                            @endif
            </a>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg">

                <div class="container-fluid">

                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    @if (!empty(Auth::user()->image)&&file_exists($path.Auth::user()->image))
                                    <img src="{{ asset('assets/image/profile/'.Auth::user()->image) }}" alt="image profile" class="avatar-img rounded-circle">

                                    @else
                                    <img src="{{ asset('assets/image/demo.png') }}" alt="image profile" class="avatar-img rounded-circle">
                                    @endif
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg">
                                            @if (!empty(Auth::user()->image)&&file_exists($path.Auth::user()->image))
                                            <img src="{{ asset('assets/image/profile/'.Auth::user()->image) }}" alt="image profile" class="avatar-img rounded">

                                            @else
                                            <img src="{{ asset('assets/image/demo.png') }}" alt="image profile" class="avatar-img rounded">
                                            @endif
                                        </div>
                                        <div class="u-text">
                                            <h4>{{ Auth::user()->name }}</h4>
                                            <p class="text-muted">{{  Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('student.profile.index') }}">My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                 </form>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar">

            <div class="sidebar-background"></div>
            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            @if (!empty(Auth::user()->image)&&file_exists($path.Auth::user()->image))
                            <img src="{{ asset('assets/image/profile/'.Auth::user()->image) }}" alt="image profile" class="avatar-img rounded-circle">

                            @else
                            <img src="{{ asset('assets/image/demo.png') }}" alt="image profile" class="avatar-img rounded-circle">
                            @endif
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    {{ Auth::user()->name }}
                                    <span class="user-level" style="font-size: 14px">#Id {{ Auth::user()->student_id }}</span>
                                </span>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li class="nav-item active {{ Route::is('student.dashboard')?'active':'' }}">
                            <a href="{{ route('student.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item {{ Route::is('student.payment*')?'active':'' }}">
                            <a data-toggle="collapse" href="#payment">
                                <i class="fas fa-table"></i>
                                <p>Payments</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="payment">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('student.payment.history') }}">
                                            <span class="sub-item">Payment History</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.payment') }}">
                                            <span class="sub-item">Pay Now</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <div class="dropdown-divider"></div>
                        <li class="nav-item">
                            <a class="btn-block btn-danger text-success" href="href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>{{ __('Logout') }}</p>
                            </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>


        <!-- jQuery Scrollbar -->
        <script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

        <!-- Sweet Alert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- Toastr JS -->
        <script src="//cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}

        <script>
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}','Error',{
                closeButton:true,
                progressBar:true,
            });
            @endforeach
            @endif
        </script>

        @stack('scripts')

    </body>
    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
    </html>
