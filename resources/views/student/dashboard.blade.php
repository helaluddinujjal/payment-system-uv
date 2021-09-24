@extends('student.layouts.app')
@section('title',"Dashboard")
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
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
												<p class="card-category">All Students</p>
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
												<p class="card-category">All {{ Auth::user()->batch->department->name }} Students</p>
												<h4 class="card-title">{{ App\User::where('dept_id',Auth::user()->dept_id)->count() }}</h4>
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
												<p class="card-category">Own Class Student</p>
												<h4 class="card-title">{{ $students->count() }}</h4>
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
												<p class="card-category">Tuition Fee</p>
												<h4 class="card-title">{{ App\TuitionFee::currency(Auth::user()->batch->tuition?Auth::user()->batch->tuition_fee->currency:'' ) }} {{ Auth::user()->batch->tuition_fee?Auth::user()->batch->tuition_fee->fee:'' }}</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <h1 class="mb-5 text-white text-center text-info">Stay Connect With Batch Mate.... </h1>
                    </div>
                    @foreach ($students as $student)

                    <div class="col-md-4">
                        <div class="bd-example">
                            <div class="card">
								@php
                                    $path=public_path('assets/image/profile/');
                                @endphp
                                @if (!empty($student->image)&&file_exists($path.$student->image))

                                <img class="card-img-top" src="{{ asset('assets/image/profile/'.$student->image) }}" alt="...">
                                @else
                                <img class="card-img-top" src="{{ asset('assets/image/demo.png') }}" alt="..." >
                                @endif
                                <div class="card-body text-center">
                                    <h3>Name:{{ $student->name }}</h3>
                                    <p class="card-text">#ID-<strong>{{ $student->student_id }}</strong></p>
                                    <p><strong>Email- </strong><a href="mailto:">{{ $student->email }}</a></p>
                                    @if (!empty($student->mobile))
                                    <p><strong>Call- </strong><a href="tel:+88">{{ $student->mobile }}</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

