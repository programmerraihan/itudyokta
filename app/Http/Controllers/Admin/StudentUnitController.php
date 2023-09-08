<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\StudentUnit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentUnitController extends Controller
{
    public function index()
    {
        $units = StudentUnit::all();
        return view('admin.admin.unit.index', compact('units'));
    }  //End Method


    public function addStudentUnit()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.admin.unit.add');
    } //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $unit = new StudentUnit();
        $unit->name              =  $request->input('name');
        $unit->status             =  $request->input('status');
        $unit->save();
        return redirect('/student-Unit-index')->with('message', 'Student Unit info create successfully');
    } //End Method

    public function edit($id)
    {
        $unit = StudentUnit::find($id);
        return view('admin.admin.unit.edit', compact('unit'));
    } //End Method



    public function update(Request $request, $id)
    {
        $unit = StudentUnit::find($id);
        $unit->name              =  $request->input('name');
        $unit->status             =  $request->input('status');
        $unit->save();
        return redirect('/student-Unit-index')->with('message', ' Student Unit info Update successfully');
    } //End Method


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', StudentUnit::updateStudentUnitStatus($id));
    } //End Method

    public function destroy($id)
    {
        $this->unit = StudentUnit::find($id);
        //dd($this->service);
        $this->unit->delete();
        return redirect('/student-Unit-index')->with('message', 'Student Unit info Delete Successfully');
    } //End Method

}
