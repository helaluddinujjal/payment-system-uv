<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Batch;
use Carbon\Carbon;
use App\Department;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Notifications\VarifyRegistration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

     /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $department=Department::all();
        $batches=Batch::all();
        return view('auth.register',compact('department','batches'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'student_id' => ['required', 'integer','unique:users'],
            'dept_id' => ['required', 'integer'],
            'batch_id' => ['required', 'integer'],
            'gender' => ['required'],
            'mobile' => ['required','numeric','min:11'],
            'image' => ['mimes:png,jpg,jpeg'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = request();
        $image=$request->file('image');
        $slug=str_slug($data['name']);
        if (isset($image)) {
            $time=Carbon::now()->toDateString();
            $imageName=$slug.'-'.$time.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //create directoru if not exists
            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }
            //image resize and upload
            Storage::disk('public')->put('profile/'.$imageName,file_get_contents($image));

        }else{
            $imageName='';
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'student_id' => $data['student_id'],
            'dept_id' => $data['dept_id'],
            'batch_id' => $data['batch_id'],
            'gender' => $data['gender'],
            'mobile' => $data['mobile'],
            'image' => $imageName,
            'status' => 0,
            'remember_token' => str_random(50),
            'password' => Hash::make($data['password']),
        ]);
        // $student->notify(new VarifyRegistration($student));
        // Toastr::success('A confirmation email has been sent.Please check your email','Success');
        //     return redirect()->back();
    }
}
