@extends('admin.layouts.app')
@section('title','Create Department')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <form action="{{ route('admin.dept.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add a new department</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="dept">Department Name</label>
                            <input type="text" name="name" class="form-control" id="dept" placeholder="Enter Department Name">
                        </div>

                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
