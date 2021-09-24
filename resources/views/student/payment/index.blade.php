@extends('student.layouts.app')
@section('title',"Payment  History")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                       Payments
                        <a href="{{ route('student.payment') }}" class="btn btn-success btn-border btn-round pull-right"><span>Pay Now</span></a>

                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Transection Id</th>
                                <th scope="col">Payment Type</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($payment->count()>0)
                                @foreach ($payment as $pay)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $pay->user->name }}</td>
                                    <td>{{ $pay->semester->name }}</td>
                                    <td>{{ $pay->currency($pay->currency).$pay->amount }}</td>
                                    <td>{{ $pay->status }}</td>
                                    <td>{{ $pay->transaction_id }}</td>
                                    <td>{{ $pay->payment_type?$pay->payment_type:'' }}</td>
                                    <td>{{ $pay->created_at?$pay->created_at->format('d/m/Y'):'' }}</td>
                                    <td>

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

