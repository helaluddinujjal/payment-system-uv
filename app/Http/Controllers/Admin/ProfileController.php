<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function index(){
        return view('admin.profile');
    }
    public function update(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required','numeric','min:11'],
            'image' => ['mimes:png,jpg,jpeg'],
            ]);
            $id=Auth::user()->id;
            $admin=Admin::where('id',$id)->first();

                $image=$request->file('image');
                if ($image) {
                    $slug=str_slug($request->name);
                   if (isset($slug)) {
                       $time=Carbon::now()->toDateString();
                       $imageName=$slug.'-'.$time.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                       //create directoru if not exists
                       $path=public_path('assets/image/profile/');
                        if (file_exists($path.$admin->image)) {
                            unlink($path.$admin->image);
                        }
                        Image::make($image)->save($path.$imageName);
                       
                   }
                }else {
                    $imageName=$admin->image;
                }
            if ($request->email!=$admin->email) {
                $admin->email=$request->email;
            }else {

                $admin->email=$admin->email;
            }

            $admin->name=$request->name;
            $admin->image=$imageName;
            $admin->mobile=$request->mobile;
            $admin->save();
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
                    $admin=Admin::find(Auth::id());
                    $admin->password= Hash::make($request->password);
                    $admin->save();
                    Toastr::success('Your Password has updated','Success');
                    Auth::logout();
                    return redirect()->route('admin.login');
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
