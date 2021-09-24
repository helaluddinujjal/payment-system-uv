@extends('student.layouts.app')
@section('title','Student Payment')
@push('styles')
<style>
    h4.data{
        padding: 5px 0;
        background: #e8e8e8!important;
        border-color: #e8e8e8!important;
        border-radius: 5px;
    }
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-md-8 offset-2">
        <h4 class="page-title">Payment Procedure</h4>
        <div class="card card-with-nav">
            <div class="card-body">
                <form action="{{ url('/pay') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Name</label>
                                <h4 class="data mt-2 mb-1">{{ Auth::user()->name }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Email</label>
                                <h4 class="data mt-2 mb-1">{{ Auth::user()->email }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Student Id</label>
                                <h4 class="data mt-2 mb-1">{{ Auth::user()->student_id }}</h4>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Phone</label>
                                <h4 class="data mt-2 mb-1">{{ Auth::user()->mobile }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Department</label>
                                <h4 class="data mt-2 mb-1">{{ Auth::user()->batch->department->name }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Batch</label>
                                <h4 class="data mt-2 mb-1">{{ Auth::user()->batch->batch }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Tuition Fees of Semester</label>
                                <select class="form-control" name="semester" id="semester">
                                    <option value="">Select semester</option>
                                    @foreach (App\TuitionFee::where('dept_id',Auth::user()->dept_id)->where('batch_id',Auth::user()->batch_id)->orderBy('semester_id','asc')->get() as $fee)
                                    <option value="{{ $fee->semester_id }}" {{ $fee->semester_id==Auth::user()->semester_id?'selected':'' }}>{{ $fee->semester->name }} </option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                @php
                                    $pay=App\TuitionFee::where('dept_id',Auth::user()->dept_id)->where('batch_id',Auth::user()->batch_id)->first();
                                @endphp
                                @if (isset($pay->fee))
                                @php
                                    $theme=App\ThemeSetting::find(1);
                                @endphp
                                <label>Semester Fees (<span>{{isset($theme->currency)? App\ThemeSetting::currency($theme->currency):"৳" }}</span>)</label>
                                <input type="text" name="fee" id="fee" value=" {{ $pay->fee }}">
                                 <span id="currency" class="badge badge-warning">{{ isset($theme->currency)? $theme->currency:"BDT"  }}</span>
                                @else
                                <label>Semester Fees</label>
                                <p class="text-warning">Authority Not set </p>
                                @endif

                            </div>
                        </div>

                    </div>
                <div class="text-right mt-3 mb-3">
                    <button type="submit" class="btn btn-success btn-block">Pay Now</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>

@endsection

@push('scripts')
<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
<script>
     $("#fee").prop("readonly", true);
    jQuery('#semester').change(function(){
        var semester = $('#semester').val();

        $('#fee').val('');
        //alert(semester);
        var option= '';
        var url="{{ url('/') }}/";
        $.get( url+"get-fee/"+semester, function( data ) {
            data=JSON.parse(data);
            //alert(data.fee);
console.log(data.fee);
function currencyCon(currency){
    if(currency=="BDT"){
        return "<span>&#x9f3;</span>";
    }else if(currency=="USD"){
        return "&#36;";
    }else{
        return "&#163;";
    }
}
$('#curr_icon').html(currencyCon(data.currency));
$('#currency').html(data.currency);
$('#fee').val(data.fee);
        });
    });

</script>
@endpush
