<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title','UITS')</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{asset('assets/image/icon.png')}}" type="image/x-icon"/>

    <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    {{-- <!-- Fonts and icons -->
    <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {"families":["Open+Sans:300,400,600,700"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['assets/css/fonts.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script> --}}

    <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/azzara.min.css')}}">

    <style>
        label.placeholder.is-invalid {
            font-size: 8px;
            top: 0;
            font-size: 85%!important;
            transform: translate3d(0,-10px,0);
            font-weight: 800;
            left: 0;
        }

    </style>
@stack('styles')
</head>
<body class="login">

    <div class="wrapper">
        <div class="main-header" data-background-color="purple" style="top: 0">
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
    
                    <ul class="navbar-nav topbar-nav navbar-left align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">
                                <i class="fa fa-home"></i> Home
                            </a>
                            <a class="nav-link" href="{{url('login')}}">
                                <i class="fa fa-users"></i> Student Panel
                            </a>
                            <a class="nav-link" href="{{url('admin/login')}}">
                                <i class="fas fa-user-shield"></i> Admin Panel
                            </a>
                        </li>
    
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
        <div class="wrapper wrapper-login" style="margin-top:5%">
            @yield('content')
        </div>
    </div>
    <script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/ready.js')}}"></script>

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
</html>
