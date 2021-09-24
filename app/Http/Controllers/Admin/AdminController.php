<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Batch;
use App\Payment;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function dashboard(){
        $department=Department::all();
        $batches=Batch::all();
        return view('admin.dashboard',compact('department','batches'));
    }

    public function paymentDetails($dept_id,$batch_id){
        $dept=Department::where('id',$dept_id)->first();
        $batch=Batch::where('dept_id',$dept_id)->where('id',$batch_id)->first();
        $payment=Payment::where('dept_id',$dept_id)->where('batch_id',$batch_id)->get();
        return view('admin.payment-details',compact('payment','dept','batch'));
    }
    public function allStudent(){
        $student=User::all();
        return view('admin.all-student',compact('student'));
    }
    public function studentDelete($id){
        $student=User::find($id);
        $path=public_path('assets/image/profile/');
        if (file_exists($path.$student->image)) {
            unlink($path.$student->image);
        }
        $student->delete();
        Toastr::success('Student has been deleted','success');
        return redirect()->back();
    }
}
