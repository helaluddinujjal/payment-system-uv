<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>

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

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/azzara.min.css')}}">
</head>
<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <h3 class="text-center">Sign In To Student</h3>
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group form-floating-label">
                        <input id="email" type="email" class="form-control input-border-bottom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label for="email" class="placeholder">{{ __('E-Mail Address') }}</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="password" type="password" class="form-control input-border-bottom @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label for="password" class="placeholder">{{ __('Password') }}</label>

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
                        <a href="#Registration" id="show-signup" class="link">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="container container-signup animated fadeIn">
            <h3 class="text-center">Sign Up</h3>
            <div class="login-form">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group form-floating-label">
                        <input id="name" type="text" class="form-control  input-border-bottom  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="name" class="placeholder">{{ __('Name') }}</label>

                    </div>
                    <div class="form-group form-floating-label">
                        <input id="student_id" type="text" class="form-control  input-border-bottom  @error('student_id') is-invalid @enderror" name="student_id"  required autocomplete="student_id" autofocus>

                        @error('student_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="student_id" class="placeholder">{{ __('Student Id') }}</label>

                    </div>

                    <div class="form-group form-floating-label">
                        <input id="email-reg" type="email" class="form-control  input-border-bottom  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="email-reg" class="placeholder">{{ __('E-Mail Address') }}</label>

                    </div>

                    <div class="form-group form-floating-label">
                        <input id="password-reg" type="password" class="form-control  input-border-bottom  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="password-reg" class="placeholder">{{ __('Password') }}</label>

                    </div>

                    <div class="form-group form-floating-label">
                        <input id="password-confirm" type="password" class="form-control input-border-bottom" name="password_confirmation" required autocomplete="new-password">
                        <label for="password-confirm" class="placeholder">{{ __('Confirm Password') }}</label>

                    </div>

                    <div class="form-group form-floating-label">
                            <select class="form-control  input-border-bottom  @error('dept_id') is-invalid @enderror" name="dept_id" id="dept_id" value="{{ old('dept_id') }}" required autocomplete="dept_id" autofocus style="padding: 0.5rem 0;">
                                <option value="" >Select a Department</option>
                                @foreach ($department as $dept)
                                    <option value="{{$dept->id}}" >{{$dept->name}}</option>
                                @endforeach
                            </select>
                            @error('dept_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group form-floating-label d-none" id="batch-hide">
                        <label for="batch_id">Select a Batch</label>
                            <select class="form-control  input-border-bottom  @error('batch_id') is-invalid @enderror" name="batch_id" id="batch_id" value="{{ old('batch_id') }}" required autocomplete="batch_id" autofocus style="padding: 0.5rem 0;">
                            </select>
                            @error('batch_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group form-floating-label">

                            <select class="form-control  input-border-bottom  @error('gender') is-invalid @enderror" name="gender" id="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus style="padding: 0.5rem 0;">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Fe-Male">Fe-Male</option>
                                <option value="Others">Others</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group form-floating-label">
                        <input type="text" class="form-control  input-border-bottom  @error('mobile') is-invalid @enderror" name="mobile" id="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="mobile" class="placeholder">{{ __('Mobile') }}</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <label for="image">Profile Image</label>
                        <input type="file" class="form-control-file  @error('image') is-invalid @enderror" name="image" id="image" value="{{ old('image') }}" required autocomplete="image" autofocus>
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-action">
                        <a href="#" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-rounded btn-login">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/ready.js')}}"></script>
    <script>
        jQuery('#dept_id').change(function(){
            $("#batch-hide").removeClass('d-none');
            var dept = $('#dept_id').val();
                if($('#dept_id').val()==''){

                    $("#batch-hide").addClass('d-none');
                }
                //alert(dept);
                $('#batch_id').html('');
                var option= '';
               $.get( "http://online-payment-system.local/get-batch/"+dept, function( data ) {
                    data=JSON.parse(data);
                    data.forEach(function(element){
                        option+="<option value='"+element.id+"'>"+element.batch+"</option>";
                    });
                    $('#batch_id').html(option);
                });
            });

        </script>
</body>
</html>
