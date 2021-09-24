@extends('admin.layouts.app')
@section('title','Profile')
@section('content')
<div class="row">
    <div class="col-md-8 offset-2">
        <h4 class="page-title">Admin Profile</h4>
        <div class="card card-with-nav">
            <div class="card-header">
                <div class="row row-nav-line">
                    <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                        <li class="nav-item submenu"> <a class="nav-link active show" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Profile</a> </li>
                        <li class="nav-item submenu"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Settings</a> </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="profile">
                        <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name"  value="{{ Auth::user()->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-md-8">
                                    <div class="card card-profile card-secondary">
                                        @php
                                            $path=public_path('assets/image/profile/');
                                        @endphp
                                        @if (!empty(Auth::user()->image)&&file_exists($path.Auth::user()->image))

                                        <img src="{{ asset('assets/image/profile/'.Auth::user()->image) }}" alt="..." width="90%" style="max-height: 300px">
                                        @else
                                        <img src="{{ asset('assets/image/demo.png') }}" alt="..." width="90%" style="max-height: 300px">

                                        @endif
                                    </div>


                                </div>
                                <div class="col-md-4">
                                    <div class="card-footer">
                                        <div class="row user-stats">
                                            <label for="image">Change Image</label>
                                            <input type="file" class="form-control-file" name="image">
                                        </div>
                                        <div class="row user-stats">
                                            <div class="form-group form-group-default mt-3">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" value="{{ Auth::user()->mobile }}" name="mobile" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-3 mb-3">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>


                        </form>
                    </div>
                    <div class="tab-pane" id="settings">
                        <form action="{{ route('admin.password.update') }}" method="post">
                            @csrf
                            <label for="old_password">Old Password</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="old_password" class="form-control input-pill" placeholder="Enter your old password" name="old_password" >
                                </div>
                            </div>
                            <label for="password">New Password</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" class="form-control input-pill" placeholder="Enter your new password" name="password">
                                </div>
                            </div>
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password_confirmation" class="form-control input-pill" placeholder="Enter your new password again" name="password_confirmation">
                                </div>
                            </div>


                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
