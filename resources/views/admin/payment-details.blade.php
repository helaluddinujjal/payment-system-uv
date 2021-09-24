@extends('admin.layouts.app')
@section('title',"Payment  History")
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Department: {{ $dept->name }} & Batch: {{ $batch->batch }} - Payments Details
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="multi-filter-select" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Student Id</th>
                                <th >Name</th>
                                <th >Semester</th>
                                <th >Amount</th>
                                <th >Status</th>
                                <th >Transection Id</th>
                                <th >Payment Type</th>
                                <th >Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th >#</th>
                                <th >Student Id</th>
                                <th >Name</th>
                                <th >Semester</th>
                                <th >Amount</th>
                                <th >Status</th>
                                <th >Transection Id</th>
                                <th >Payment Type</th>
                                <th >Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($payment as $pay)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $pay->user->student_id }}</td>
                                <td>{{ $pay->user->name }}</td>
                                <td>{{ $pay->semester->name }} </td>
                                <td>{{ $pay->currency($pay->currency).$pay->amount }}</td>
                                <td>{{ $pay->status }}</td>
                                <td>{{ $pay->transaction_id }}</td>
                                <td>{{ $pay->payment_type?$pay->payment_type:'' }}</td>
                                <td>{{ $pay->created_at?$pay->created_at->format('d/m/Y'):'' }}</td>

                        </tr>

                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Datatables -->
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
<!-- Azzara JS -->
<script src="{{ asset('assets/js/ready.min.js') }}"></script>
<script >
    $(document).ready(function() {

        $('#multi-filter-select').DataTable( {
            "pageLength": 5,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                        );

                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                    } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        });

    });
</script>
@endpush
