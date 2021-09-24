@extends('admin.layouts.app')
@section('title',"All Student")
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> All Student List
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="multi-filter-select" class="display table table-striped table-hover text-center" >
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Image</th>
                                <th >Name</th>
                                <th >Student Id</th>
                                <th >Email</th>
                                <th >Mobile</th>
                                <th >Department</th>
                                <th >Batch</th>
                                <th >Gender</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th >#</th>
                                <th >Image</th>
                                <th >Name</th>
                                <th >Student Id</th>
                                <th >Email</th>
                                <th >Mobile</th>
                                <th >Department</th>
                                <th >Batch</th>
                                <th >Gender</th>
                                <th >Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($student as $stu)
                            @php
                                $path=public_path('assets/image/profile/');
                            @endphp
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>
                                    <div class="avatar-sm">
                                        @if (!empty($stu->image)&&file_exists($path.$stu->image))
                                        <img src="{{ asset('assets/image/profile/'.$stu->image) }}" alt="image profile" class="avatar-img rounded-circle">

                                        @else
                                        <img src="{{ asset('assets/image/demo.png') }}" alt="image profile" class="avatar-img rounded-circle">
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $stu->name }}</td>
                                <td>{{ $stu->student_id }}</td>
                                <td>{{ $stu->email }}</td>
                                <td>{{ $stu->mobile }}</td>
                                <td>{{ $stu->batch->department->name }}</td>
                                <td>{{ $stu->batch->batch }}</td>
                                <td>{{ $stu->gender }}</td>
                                <td>
                                    <a href="#" onclick="deletetuition({{ $stu->id }})" class="btn  btn-outline-danger">Delete</a>
                                        <form id="delete-form-{{ $stu->id }}" action="{{ route('admin.student.delete',$stu->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                </td>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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

    function deletestu(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
               document.getElementById('delete-form-'+id).submit();
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your file is safe :)',
                'error'
                )
            }
        })
    }
</script>
@endpush
