@extends('admin.layouts.app')
@section('title',"batch-list")
@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                       Batch List
                        <a href="{{ route('admin.batch.create') }}" class="btn btn-success btn-border btn-round pull-right"><span>Add New</span></a>

                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Department</th>
                                <th scope="col">Batch No</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($batches->count()>0)
                                @foreach ($batches as $batch)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $batch->department?$batch->department->name:'' }}</td>
                                    <td>{{ $batch->batch }}</td>
                                    <td>
                                        <a href="{{ route('admin.batch.edit',$batch->id) }}" class="btn  btn-outline-info">Edit</a>
                                        <a href="#" onclick="deletebatch({{ $batch->id }})" class="btn  btn-outline-danger">Delete</a>
                                        <form id="delete-form-{{ $batch->id }}" action="{{ route('admin.batch.delete',$batch->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                @endforeach
                            @else
                                <tr><td colspan="3"><h3 class="text-center">No data has found!!!</h3></td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>

    function deletebatch(id){
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
