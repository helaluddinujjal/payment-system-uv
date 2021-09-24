@extends('auth.layouts.app')
@section('title',"Student Registration")
    @push('styles')
    <style>
        .container-reg{
            width: 400px;
            background: #fff;
            padding: 60px 25px;
            border-radius: 5px;
            -webkit-box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03);
            -moz-box-shadow: 0 .75rem 1.5rem rgba(18,38,63,.03);
            box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03);
            border: 1px solid #ebecec;
        }
        .login .wrapper.wrapper-login .btn-login, .login .wrapper.wrapper-login .btn-login {
            padding: 15px 0;
            width: 135px;
        }

 .form-action {
             text-align: center;
             padding: 25px 10px 0;
        }

    </style>
    @endpush
@section('content')
<div class="container container-reg animated fadeIn">
    <h3 class="card-header bg-secondary-gradient text-white mb-3">Sign Up</h3>
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
                <label for="name" class="placeholder @error('name') is-invalid @enderror">{{ __('Name') }}</label>

            </div>
            <div class="form-group form-floating-label">
                <input id="student_id" type="text" class="form-control  input-border-bottom  @error('student_id') is-invalid @enderror" name="student_id"  required autocomplete="student_id" autofocus>

                @error('student_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="student_id" class="placeholder @error('student_id') is-invalid @enderror">{{ __('Student Id') }}</label>

            </div>

            <div class="form-group form-floating-label">
                <input id="email-reg" type="email" class="form-control  input-border-bottom  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="email-reg" class="placeholder @error('email') is-invalid @enderror">{{ __('E-Mail Address') }}</label>

            </div>

            <div class="form-group form-floating-label">
                <input id="password-reg" type="password" class="form-control  input-border-bottom  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="password-reg" class="placeholder @error('password') is-invalid @enderror">{{ __('Password') }}</label>

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
            <div class="form-group form-floating-label d-none" id="semester-hide">
                <label for="semester_id">Select a Semester</label>
                    <select class="form-control  input-border-bottom  @error('semester_id') is-invalid @enderror" name="semester_id" id="semester_id" value="{{ old('semester_id') }}" required autocomplete="semester_id" autofocus style="padding: 0.5rem 0;">
                        @foreach (App\Semester::all() as $sem)
                            <option value="{{$sem->id}}" >{{$sem->name}}</option>
                        @endforeach
                    </select>
                    @error('semester_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="form-group form-floating-label">

                    <select class="form-control  input-border-bottom  @error('gender') is-invalid @enderror" name="gender" id="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus style="padding: 0.5rem 0;">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Fe-Male</option>
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
                <label for="mobile" class="placeholder @error('mobile') is-invalid @enderror">{{ __('Mobile') }}</label>
            </div>
            <div class="form-group form-floating-label">
                <label for="image">Profile Image</label>
                <input type="file" class="form-control-file  @error('image') is-invalid @enderror" name="image" id="image" value="{{ old('image') }}"  autocomplete="image" autofocus>
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-action">
                <a href="{{ route('login') }}" class="btn btn-danger btn-rounded btn-login mr-3">Login</a>
                <button type="submit" class="btn btn-primary btn-rounded btn-login">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
@push('scripts')
<script>
    jQuery('#dept_id').change(function(){
        $("#batch-hide").removeClass('d-none');
        $("#semester-hide").removeClass('d-none');
        var dept = $('#dept_id').val();
            if($('#dept_id').val()==''){

                $("#batch-hide").addClass('d-none');
            }
            //alert(dept);
            $('#batch_id').html('');
            var option= '';
            var url="{{ url('/') }}/";
           $.get( url+"get-batch/"+dept, function( data ) {
                data=JSON.parse(data);
                data.forEach(function(element){
                    option+="<option value='"+element.id+"'>"+element.batch+"</option>";
                });
                $('#batch_id').html(option);
            });
        });

    </script>
@endpush
