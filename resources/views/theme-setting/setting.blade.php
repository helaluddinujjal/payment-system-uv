@extends('admin.layouts.app')
@section('title','Theme Settings')

@section('content')
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="card card-with-nav">
            <div class="card-header">
                <div class="row row-nav-line pt-3 pl-3">
                 <h4 class="page-title">Theme Settings</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.theme.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-8">
                            <div class="card card-profile card-secondary">
                                @if (!empty($theme->logo))
                                <img src="{{ asset('assets/image/theme/'.$theme->logo) }}" alt="..." width="90%" >
                                @else
                                <img src="{{ asset('assets/image/theme/logo.png') }}" alt="..." width="90%" >
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-footer">
                                <div class="row user-stats text-center">
                                    <label for="logo">Change Image</label>
                                    <input type="file" class="form-control-file" name="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Logo URL</label>
                                <input type="url" class="form-control" name="url"  value="{{ !empty($theme->url)?$theme->url:'http://online-payment-system.local/admin/dashboard' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label for="currency"> Currency </label>
                                <select class="form-control" name="currency" id="currency"  required autocomplete="dept_id" autofocus >
                                    <option value="" >Select Currency</option>
                                    @if (!empty($theme->currency))
                                    <option value="BDT" {{ $theme->currency=="BDT"?'selected':'' }}>&#x9f3;</option>
                                    <option value="USD" {{ $theme->currency=="USD"?'selected':'' }}><p>&#36;</p></option>
                                    <option value="EUR" {{ $theme->currency=="EUR"?'selected':'' }}><p>&#163;</p></option>
                                    @else
                                    <option value="BDT">&#x9f3;</option>
                                    <option value="USD"><p>&#36;</p></option>
                                    <option value="EUR"><p>&#163;</p></option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3 mb-3">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
