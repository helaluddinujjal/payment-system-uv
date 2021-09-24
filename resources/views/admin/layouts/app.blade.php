<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title','Dashboard')</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{asset('assets/image/icon.png')}}" type="image/x-icon"/>

    <!-- Fonts and icons -->
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
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    @if (!empty($theme->logo) && file_exists($logopath))
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
                                    @if (!empty(Auth::user()->image) && file_exists($path.Auth::user()->image))
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
                                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}">My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
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
                                <span class="user-level" style="font-size: 14px">Admin</span>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item {{ Route::is('admin.dashboard')?'active':'' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>

                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Menu</h4>
                    </li>
                    <li class="nav-item {{ Route::is('admin.students')?'active':'' }}">
                        <a href="{{ route('admin.students') }}">
                            <i class="fas fa-user"></i>
                            <p>All Student</p>
                            <span class="badge badge-count">{{ App\User::all()->count() }}</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Route::is('admin.dept*')?'active':'' }}">
                        <a data-toggle="collapse" href="#department">
                            <i class="fas fa-boxes"></i>
                            <p>Department</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="department">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.dept') }}">
                                        <span class="sub-item">All Department</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.dept.create') }}">
                                        <span class="sub-item">Add a Department</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ Route::is('admin.batch*')?'active':'' }}">
                        <a data-toggle="collapse" href="#batch">
                            <i class="fas fa-pen-square"></i>
                            <p>Batches</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="batch">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.batch') }}">
                                        <span class="sub-item">All Batch</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.batch.create') }}">
                                        <span class="sub-item">Add a Batch</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ Route::is('admin.semester*')?'active':'' }}">
                        <a data-toggle="collapse" href="#semester">
                            <i class="fas fa-boxes"></i>
                            <p>Semester</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="semester">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.semester') }}">
                                        <span class="sub-item">All Semester</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.semester.create') }}">
                                        <span class="sub-item">Add a Semester</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ Route::is('admin.tuition*')?'active':'' }}">
                        <a data-toggle="collapse" href="#tuition">
                            <i class="fas fa-pen-square"></i>
                            <p>Tuitions</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tuition">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.tuition') }}">
                                        <span class="sub-item">All tuition</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tuition.create') }}">
                                        <span class="sub-item">Add a Tuition</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @php
                    $department=App\Department::all();
                    $i=0;
                    @endphp
                    <li class="nav-item ">
                        <a data-toggle="collapse" href="#payments">
                            <i class="fas fa-table"></i>
                            <p>Payments</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="payments">
                            <ul class="nav nav-collapse">
                                @foreach ($department as $dept )
                                @php
                                $i++;
                                @endphp
                                <li class="nav-item">
                                    <a data-toggle="collapse" href="#dept-{{ $i }}">
                                        <i class="fas fa-table"></i>
                                        <p><span>&#8594;</span>{{ $dept->name }}</p>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="dept-{{ $i }}">
                                        <ul class="nav nav-collapse">
                                            @php
                                            $batches=App\Batch::where('dept_id',$dept->id)->get();
                                            @endphp
                                            <li class="nav-item">
                                                <a data-toggle="collapse" href="#batch-{{ $dept->id }}">
                                                    <i class="fas fa-table"></i>
                                                    <p><ispan>&#187;</span>Batches</p>
                                                        <span class="caret"></span>
                                                    </a>
                                                    <div class="collapse" id="batch-{{ $dept->id }}">
                                                        <ul class="nav nav-collapse">
                                                            @foreach ($batches as $batch)

                                                            <li>
                                                                <a href="{{ route('admin.payment.details',['dept_id'=>$dept->id,'batch_id'=>$batch->id]) }}">
                                                                    <span class="sub-item">{{ $batch->batch }}</span>
                                                                </a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>

                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                            <hr>
                        </li>

                        <div class="dropdown-divider"></div>
                        <li class="nav-item {{ Route::is('admin.theme.setting')?'active':'' }}">
                            <a href="{{ route('admin.theme.setting') }}">
                                <i class="fas fa-cog"></i>
                                <p>Theme Settings</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn-block btn-danger text-success" href="href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
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
</html>
