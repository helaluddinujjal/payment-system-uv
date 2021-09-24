@extends('admin.layouts.app')
@section('title','Create Batch')
@section('content')
<div class="row">
    <div class="col-md-8 offset-2">
        <form action="{{ route('admin.batch.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add a new batch</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="dept_id">Select a Department for Batch</label>
                        <select class="form-control" name="dept_id" id="dept_id">
                            <option value="" >Select a Department</option>
                            @foreach ($department as $dept)
                            <option value="{{$dept->id}}" >{{$dept->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="batch">Batch No</label>
                        <input type="text" name="name" class="form-control" id="batch" placeholder="Enter Batch No" required>
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
