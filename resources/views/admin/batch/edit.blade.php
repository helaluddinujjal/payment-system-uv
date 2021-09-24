@extends('admin.layouts.app')
@section('title','Edit Batch')
@section('content')
<div class="row">
    <div class="col-md-8 offset-2">
        <form action="{{ route('admin.batch.update',$batch->id) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Batch</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="dept_id">Select a Department for Batch</label>
                        <select class="form-control" name="dept_id" id="dept_id">
                            @foreach ($department as $dept)
                            <option value="{{$dept->id}}" {{$batch->dept_id==$dept->id?'selected':''}}>{{$dept->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="batch">Batch No</label>
                        <input type="text" name="name" class="form-control" id="batch" value="{{ $batch->batch }}">
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
