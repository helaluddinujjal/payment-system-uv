@if (count($errors)>0)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
@if (Session::has('success'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            </div>
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            </div>
        </div>
    </div>
@endif
