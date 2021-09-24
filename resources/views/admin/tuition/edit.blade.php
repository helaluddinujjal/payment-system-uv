@extends('admin.layouts.app')
@section('title','Edit Tuition Fee')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <form action="{{ route('admin.tuition.update',$tuition->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Tuition Fee</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="dept_id">Select a Department</label>
                            <select class="form-control" name="dept_id" id="dept_id"  required autocomplete="dept_id" autofocus style="padding: 0.5rem 0;">
                                @foreach ($department as $dept)
                                <option value="{{$dept->id}}" {{$dept->id==$tuition->dept_id?'selected':''  }}>{{$dept->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="batch_id">Select a Batch</label>
                            <select class="form-control  input-border-bottom" name="batch_id" id="batch_id"  required autocomplete="batch_id" autofocus style="padding: 0.5rem 0;">
                                <option value="{{$batch->id}}" {{$batch->id==$tuition->batch_id?'selected':''  }}>{{$batch->batch}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="semester" id="semester"  required autocomplete="semester" autofocus style="padding: 0.5rem 0;">

                                @foreach ($semesters as $sem)
                                <option value="{{$sem->id}}"  {{ $tuition->semester_id==$sem->id?'selected':'' }}>{{$sem->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            @php
                        $theme=App\ThemeSetting::find(1);
                    @endphp
                            <label for="fee">Tuition Fee({{isset($theme->currency)? App\ThemeSetting::currency($theme->currency):"৳" }})</label>
                            <input type="number" name="fee" class="form-control" id="fee" value="{{ $tuition->fee }}">
                        </div>

                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    jQuery('#dept_id').change(function(){
        var dept = $('#dept_id').val();
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
@endpush
