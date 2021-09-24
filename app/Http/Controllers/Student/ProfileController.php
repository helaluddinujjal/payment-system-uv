<?php

namespace App\Http\Controllers\Student;

use App\User;
use App\Batch;
use Carbon\Carbon;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    //
    public function index(){
        $department=Department::all();
        $batches=Batch::where('dept_id',Auth::user()->dept_id)->get();
        return view('student.profile',compact('department','batches'));
    }
    public function update(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'student_id' => ['required', 'integer'],
            'dept_id' => ['required', 'integer'],
            'batch_id' => ['required', 'integer'],
            'semester_id' => ['required', 'integer'],
            'gender' => ['required'],
            'mobile' => ['required','numeric','min:11'],
            'image' => ['mimes:png,jpg,jpeg'],
            ]);
            $id=Auth::user()->id;
            $student=User::where('id',$id)->first();

                $image=$request->file('image');
                if ($image) {
                    $slug=str_slug($request->name);
                if (isset($slug)) {
                    $time=Carbon::now()->toDateString();
                    $imageName=$slug.'-'.$time.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                    $path=public_path('assets/image/profile/');
                    if (file_exists($path.$student->image)) {
                        unlink($path.$student->image);
                    }
                    Image::make($image)->save($path.$imageName);
                }
                }else {
                    $imageName=$student->image;
                }

            if ($request->email!=$student->email) {
                $student->email=$request->email;
            }else {

                $student->email=$student->email;
            }
            if ($request->student_id!=$student->student_id) {
                $student->student_id=$request->student_id;
            }else {

            $student->student_id=$student->student_id;
            }
            $student->name=$request->name;
            $student->dept_id=$request->dept_id;
            $student->batch_id=$request->batch_id;
            $student->semester_id=$request->semester_id;
            $student->image=$imageName;
            $student->gender=$request->gender;
            $student->mobile=$request->mobile;
            $student->save();
            Toastr::success('Profile Updated!!!','success');
            return redirect()->back();
        }



        public function passwordUpdate(Request $request){
            $this->validate($request,[
                'old_password'=>'required',
                'password'=>'required|confirmed'
            ]);
            $hashPass=Auth::user()->password;
            if(Hash::check($request->old_password, $hashPass)){
                if(!Hash::check($request->password, $hashPass)){
                    $user=User::find(Auth::id());
                    $user->password= Hash::make($request->password);
                    $user->save();
                    Toastr::success('Your Password has updated','Success');
                    Auth::logout();
                    return redirect()->route('login');
                }else{
                    Toastr::error('New password should be different from old password');
                    return redirect()->back();
                }
            }else{
                Toastr::error('Old password not matched','Error');
                return redirect()->back();
            }
        }
    }
