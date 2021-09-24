<?php

namespace App\Http\Controllers\Auth;

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
    protected $redirectTo = '/student/dashboard';

      /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if (Auth::check()) {

            return redirect()->route('student.dashboard');
        }elseif(Auth::guard('admin')->check()){
            return redirect()->route('admin.dashboard');

        }else {
            $department=Department::all();
            return view('auth.login',compact('department'));
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email'=>'required',
    //         'password'=>'required',
    //     ]);

    //     $student=User::where('email',$request->email)->first();
    //     if($student->status==1){
    //     if (Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password])) {
    //         //login student
    //         session()->flash('success','Logged in successfully');
    //         Toastr::success('Logged in successfully','success');

    //         return redirect()->intended(route('student.profile.index'));
    //     }else{
    //         Toastr::error('Invalid login !!!','error');
    //         return redirect('login');
    //     }
    //     } else if(!is_null($student)){
    //         $student->notify(new VarifyRegistration($student));
    //         Toastr::info('A new confirmation email sent to you.please check and confirm the email','Info');
    //         return redirect('login');

    //     }else{
    //         Toastr::error('Please login first !!!','error');
    //         return redirect('/');
    //     }

    // }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){
            return ['student_id'=>$request->get('email'),'password'=>$request->get('password')];
        }
        return $request->only($this->username(), 'password');
    }

}
