<?php

namespace App\Http\Controllers\Admin;

use App\Batch;
use App\Semester;
use App\Department;
use App\TuitionFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class TuitionFeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tuitions=TuitionFee::orderBy('dept_id','desc')->get();
        return view('admin.tuition.index',compact('tuitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department=Department::all();
        $batches=Batch::all();
        $semesters=Semester::all();
        return view('admin.tuition.create',compact('department','batches','semesters'));
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'dept_id'=>'required',
            'batch_id'=>'required',
            'semester'=>'required',
            'currency'=>'required',
            'fee'=>'required|numeric',

        ]);

        $tuitions=new TuitionFee;
        $tuitions->batch_id=$request->batch_id;
        $tuitions->dept_id=$request->dept_id;
        $tuitions->semester_id=$request->semester;
        $tuitions->fee=$request->fee;
        $tuitions->currency=$request->currency;
        $tuitions->save();
       Toastr::success('Tuition Fee has been Stored... ','success');
        return redirect()->route('admin.tuition');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department=Department::all();
        foreach ($department as $dept) {

            $batch=Batch::where('dept_id',$dept->id)->first();
        }
        $tuition=TuitionFee::find($id);
        $semesters=Semester::all();
       // return  $tuition;
        return view('admin.tuition.edit',compact('department','batch','tuition','semesters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dept_id'=>'required',
            'batch_id'=>'required',
            'semester'=>'required',
            'currency'=>'required',
            'fee'=>'required|numeric',
        ]);

        $tuition= TuitionFee::find($id);
        $tuition->batch_id=$request->batch_id;
        $tuition->dept_id=$request->dept_id;
        $tuition->semester_id=$request->semester;
        $tuition->fee=$request->fee;
        $tuition->currency=$request->currency;
        $tuition->save();
       Toastr::success('Tuition Fee has been Updated... ','success');
        return redirect()->route('admin.tuition');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tuition=TuitionFee::find($id);
        $tuition->delete();
        Toastr::success('Tuition Fee has been Deleted... ','success');
        return redirect()->back();
    }
}
