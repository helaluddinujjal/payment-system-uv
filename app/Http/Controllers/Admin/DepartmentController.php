<?php

namespace App\Http\Controllers\Admin;

use App\Batch;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class DepartmentController extends Controller
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
        $department=Department::all();
        return view('admin.department.index',compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
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
            'name.required'=>'Please input Department name'
        ]);

        $department=new Department;
        $department->name=$request->name;
        $department->save();
       Toastr::success('Name has been Stored... ','success');
        return redirect()->route('admin.dept');
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

        $dept=Department::find($id);
        return view('admin.department.edit',compact('dept'));
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
            'name.required'=>'Please input Department name'
        ]);

        $department= Department::find($id);
        $department->name=$request->name;
        $department->save();
       Toastr::success('Name has been Updated... ','success');
        return redirect()->route('admin.dept');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept=Department::find($id);
        $batch=Batch::where('dept_id',$dept->id);
        foreach ($batch as $btc) {
           $btc->delete();
        }
        $dept->delete();
        Toastr::success('Name has been Deleted... ','success');
        return redirect()->back();
    }
}
