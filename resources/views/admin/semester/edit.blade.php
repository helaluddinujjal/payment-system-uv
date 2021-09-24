@extends('admin.layouts.app')
@section('title','Edit semester')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <form action="{{ route('admin.semester.update',$semester->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit semester</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="semester">Semester Name</label>
                            <input type="text" name="name" class="form-control" id="semester" value="{{ $semester->name }}">
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
