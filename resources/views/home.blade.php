<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title','UITS')</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{asset('assets/image/icon.png')}}" type="image/x-icon"/>

    <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- Fonts and icons -->
    <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {"families":["Open+Sans:300,400,600,700"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['assets/css/fonts.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/azzara.min.css')}}">

    <style>
       
       .banner-area{
	width: 100%;
	height: 100%;
    background:url('assets/image/img/uits.jpg');
	background-position: center;
	-webkit-background-size: cover;
	background-size: cover;
	display: -webkit-flex;
	display: -moz-flex;
	display: -ms-flex;
	display: -o-flex;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	font-size: 2vw;
	color: #fff;
    position: static;
}
.banner-area::before {
	content: '';
	height: 100%;
	width: 100%;
	background: #884040f2;
	opacity: .6;
	position: absolute;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
}

.banner-area h2{
	font-family: germania one;
	font-size: 65px;
	margin: 0 0 25px;
	animation: animate 2s 1;
    z-index: 3;
}
@keyframes animate{
	0%{
		transform: scale(0);
	}
	100%{
		transform: scale(1);
	}
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
        <div class=" banner-area" style="" >
            <h2>Online Payment System</h2>
        </div>
    </div>
    <script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/ready.js')}}"></script>

    

</body>
</html>
