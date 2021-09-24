@extends('admin.layouts.app')
@section('title',"Create Tution Fee")

@section('content')
<div class="row">
    <div class="col-md-8 offset-2">
        <form action="{{ route('admin.tuition.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Create a Tuition Fee</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-control" name="dept_id" id="dept_id"  required autocomplete="dept_id" autofocus style="padding: 0.5rem 0;">
                            <option value="" >Select a Department</option>
                            @foreach ($department as $dept)
                            <option value="{{$dept->id}}" >{{$dept->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-none" id="batch-hide">
                        <label for="batch_id">Select a Batch</label>
                        <select class="form-control  input-border-bottom" name="batch_id" id="batch_id"  required autocomplete="batch_id" autofocus style="padding: 0.5rem 0;">
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="semester" id="semester"  required autocomplete="semester" autofocus style="padding: 0.5rem 0;">
                            <option value="" >Select a Semester</option>
                            @foreach ($semesters as $semester)
                            <option value="{{$semester->id}}" >{{$semester->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        @php
                        $theme=App\ThemeSetting::find(1);
                    @endphp
                        <label for="fee">Tution Fee ({{isset($theme->currency)? App\ThemeSetting::currency($theme->currency):"৳" }} )</label>
                        <input type="number" name="fee" class="form-control" id="fee" placeholder="Enter Fee">
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
@push('scripts')
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
@endpush
