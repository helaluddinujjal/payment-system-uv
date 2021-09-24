<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\ThemeSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;

class ThemeSettingController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
     public function index(){
        $theme= ThemeSetting::find(1);
        return view('theme-setting.setting',compact('theme'));
     }

     public function update(Request $request){
            $this->validate($request,[
                'currency'=>'required',
                'logo'=>'mimes:png,jpg,jpeg,gif',
                'url'=>'url',
            ]);
            $theme=ThemeSetting::where('id',1)->first();

        $image=$request->file('logo');
                 if ($image) {
                    $time=Carbon::now()->toDateString();
                    $imageName='Logo'.'-'.$time.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                    $path=public_path('assets/image/theme/');
                    if (file_exists($path.$theme->logo)) {
                        unlink($path.$theme->logo);
                    }
                    Image::make($image)->save($path.$imageName);
                }else {
                    $imageName='';
                }
            ThemeSetting::updateOrCreate(['id'=>1],[
                    'currency'=>$request->currency,
                    'url'=>$request->url,
                    'logo'=>$imageName,
            ]);
            Toastr::success('Settings saved!!!','success');
            return redirect()->back();
     }
}
