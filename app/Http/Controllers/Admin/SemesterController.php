<?php

namespace App\Http\Controllers\Admin;

use App\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SemesterController extends Controller
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
        $semesters=Semester::all();
        return view('admin.semester.index',compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.semester.create');
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
            'name.required'=>'Please input semester name'
        ]);

        $semester=new semester;
        $semester->name=$request->name;
        $semester->save();
       Toastr::success('Semester has been Stored... ','success');
        return redirect()->route('admin.semester');
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

        $semester=Semester::find($id);
        return view('admin.semester.edit',compact('semester'));
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
            'name.required'=>'Please input semester name'
        ]);

        $semester= Semester::find($id);
        $semester->name=$request->name;
        $semester->save();
       Toastr::success('Semester has been Updated... ','success');
        return redirect()->route('admin.semester');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semester=Semester::find($id);
        $semester->delete();
        Toastr::success('Semester has been Deleted... ','success');
        return redirect()->back();
    }
}
