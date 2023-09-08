<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function index()
    {

        $divisions = Division::all();
        return view('admin.frontend.home.division.index', compact('divisions'));
    }
    //End Method


    public function addDivision()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.frontend.home.division.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $division = new Division();
        $division->name              =  $request->input('name');
        $division->status             =  $request->input('status');
        $division->save();
        return redirect('/division-index')->with('message', 'Our Division info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $division = Division::find($id);
        return view('admin.frontend.home.division.edit', compact('division'));
    } //End Method



    public function update(Request $request, $id)
    {

        $division = Division::find($id);

        $division->name              =  $request->input('name');
        $division->status             =  $request->input('status');
    

        $division->save();
        return redirect('/division-index')->with('message', ' Our division info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Division::updateDivisionStatus($id));
    }

    public function destroy($id)
    {
        $this->division = Division::find($id);
       
        $this->division->delete();
        return redirect('/division-index')->with('message', 'division info Delete Successfully');
    }

}
