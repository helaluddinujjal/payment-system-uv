<?php

namespace App\Http\Controllers\Student;

use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.payment.payment');
    }
    public function paymentHistory()
    {
        $payment=Payment::where('student_id',Auth::user()->student_id)->orderBy('id','asc')->get();
        return view('student.payment.index',compact('payment'));
    }






}
