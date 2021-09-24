<?php

namespace App\Http\Controllers\Admin;

use App\Batch;
use App\Department;
use App\TuitionFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class BatchController extends Controller
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
        $batches=Batch::orderBy('dept_id','desc')->get();
        return view('admin.batch.index',compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department=Department::all();
        return view('admin.batch.create',compact('department'));
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
            'name'=>'required',

        ],[
            'name.required'=>'Please input batch name',
        ]);

        $batch=new Batch;
        $batch->batch=$request->name;
        $batch->dept_id=$request->dept_id;
        $batch->save();
       Toastr::success('Batch has been Stored... ','success');
        return redirect()->route('admin.batch');
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
        $batch=Batch::find($id);
        return view('admin.batch.edit',compact('department','batch'));
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
            'name'=>'required',

        ],[
            'semester.required'=>'Please input semester'
        ]);

        $batch= batch::find($id);
        $batch->batch=$request->name;
        $batch->dept_id=$request->dept_id;
        $batch->save();
       Toastr::success('Batch has been Updated... ','success');
        return redirect()->route('admin.batch');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batch=Batch::find($id);
        $tutions=TuitionFee::where('batch_id',$batch->id);
        foreach ($tutions as $tution) {
           $tution->delete();
        }
        $batch->delete();
        Toastr::success('Batch has been Deleted... ','success');
        return redirect()->back();
    }
}
