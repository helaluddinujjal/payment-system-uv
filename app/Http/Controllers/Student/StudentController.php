<?php

namespace App\Http\Controllers\Student;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified']);
    }
    public function dashboard(){
        $students=User::where('dept_id',Auth::user()->dept_id)->where('batch_id',Auth::user()->batch_id)->paginate(15);
        return view('student.dashboard',compact('students'));
    }
}
