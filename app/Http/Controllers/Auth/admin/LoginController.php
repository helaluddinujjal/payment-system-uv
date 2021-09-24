<?php

namespace App\Http\Controllers\Auth\admin;

use App\User;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\VarifyRegistration;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
      /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');

        }elseif(Auth::check()){
            return redirect()->route('student.dashboard');

        }else {
            return view('auth.admin.login');
        }

    }


    public function login(Request $request)
    {
//d('test;');
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])) {
            //login admin
            //session()->flash('success','Logged in successfully');
            Toastr::success('Logged in successfully','Success');
            return redirect()->intended(route('admin.dashboard'));
        }else{
          //  session()->flash('error','Invalid login !!!');
          Toastr::error('Invalid login !!!','Error');
            return redirect()->back();
        }
    }


        /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return  redirect()->route('admin.login');
    }

}
