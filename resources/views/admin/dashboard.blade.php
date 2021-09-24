@extends('admin.layouts.app')
@section('title',"Dashboard")
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total Students</p>
                                            <h4 class="card-title">{{ App\User::all()->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="far fa-newspaper"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total Department</p>
                                            <h4 class="card-title">{{ App\Department::all()->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="far fa-chart-bar"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total Batch</p>
                                            <h4 class="card-title">{{ App\Batch::all()->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="far fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Earn Tuition Fee</p>
                                            <h4 class="card-title">{{ App\Payment::sum('amount') }} BDT</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-8 offset-2">
                        <h1 class="text-center mb-3 badge-info">Departments State</h1>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Batch</th>
                                    <th scope="col">Total Student</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($department->count()>0)
                                    @foreach ($department as $dept)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $dept->name }}</td>
                                        <td>{{ $dept->batches->count() }}</td>
                                        <td>{{ $dept->users->count() }}</td>
                                        {{--  @foreach ($dept->batches as $batch)
                                        <td>{{ $batch->batch }}</td>

                                        @endforeach  --}}
                                    </tr>

                                    @endforeach
                                @else
                                    <tr><td colspan="3"><h3 class="text-center">No data has found!!!</h3></td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-8 offset-2">
                        <h1 class="text-center mb-3 badge-warning">Batches State</h1>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Batch</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Total Student</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($batches->count()>0)
                                    @foreach ($batches as $batch)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $batch->batch }}</td>
                                       <td>{{ $batch->department->name }}</td>
                                       <td>{{ $batch->users?$batch->users->count():0 }}</td>
                                        {{--  @foreach ($dept->batches as $batch)
                                        <td>{{ $batch->batch }}</td>

                                        @endforeach  --}}
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
    </div>
</div>
@endsection


