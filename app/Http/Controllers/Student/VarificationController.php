<?php

namespace App\Http\Controllers\Student;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class VarificationController extends Controller
{
    //
    public function varify($token){
        $student=User::where('remember_token',$token)->first();
        if (!is_null($student)) {
            $student->status=1;
            $student->remember_token=null;
            $student->save();
            Toastr::success('Your registration successfully completed',"Success");
            return redirect()->route('login');
        }else {
            Toastr::error('Sorry!!! your token not matched. ',"Error");
            return redirect()->route('login');
        }
    }
}
