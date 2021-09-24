@extends('admin.layouts.app')
@section('title',"Tuition Fee List")
@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                       Tuition List
                        <a href="{{ route('admin.tuition.create') }}" class="btn btn-success btn-border btn-round pull-right"><span>Add New</span></a>

                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Department</th>
                                <th scope="col">Batch</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Tuition Fee</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($tuitions->count()>0)
                            @php
                            $theme=App\ThemeSetting::find(1);
                        @endphp
                                @foreach ($tuitions as $tuition)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $tuition->batch?$tuition->batch->department->name:'' }}</td>
                                    <td>{{ $tuition->batch?$tuition->batch->batch:'' }}</td>
                                    <td>{{ $tuition->semester?$tuition->semester->name:'' }}</td>
                                    <td>{{isset($theme->currency)? App\ThemeSetting::currency($theme->currency):"৳" }} {{ $tuition->fee }}</td>
                                    <td>
                                        <a href="{{ route('admin.tuition.edit',$tuition->id) }}" class="btn  btn-outline-info">Edit</a>
                                        <a href="#" onclick="deletetuition({{ $tuition->id }})" class="btn  btn-outline-danger">Delete</a>
                                        <form id="delete-form-{{ $tuition->id }}" action="{{ route('admin.tuition.delete',$tuition->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                @endforeach
                            @else
                                <tr><td colspan="6"><h3 class="text-center">No data has found!!!</h3></td></tr>
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

    function deletetuition(id){
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
