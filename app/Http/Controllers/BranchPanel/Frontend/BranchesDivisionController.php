<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesDivisionController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $divisions =  Division::where('branch_id', $id)->get();
        //$divisions = Division::all();
        return view('branch.branch-panel.home.division.index', compact('divisions'));
    }
    //End Method


    public function addDivision()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.division.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $division = new Division();
        $division->branch_id =  Auth::guard('branch')->user()->id;
        $division->name              =  $request->input('name');
        $division->status             =  $request->input('status');
        $division->save();
        return redirect('branches/division-index')->with('message', 'Our Division info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $division = Division::find($id);
        
        return view('branch.branch-panel.home.division.edit', compact('division'));
    } //End Method



    public function update(Request $request, $id)
    {

        $division = Division::find($id);
        $division->branch_id =  Auth::guard('branch')->user()->id;

        $division->name              =  $request->input('name');
        $division->status             =  $request->input('status');
    

        $division->save();
        return redirect('branches/division-index')->with('message', ' Our division info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Division::updateDivisionStatus($id));
    }

    public function destroy($id)
    {
        $this->division = Division::find($id);
       
        $this->division->delete();
        return redirect('branches/division-index')->with('message', 'division info Delete Successfully');
    }

}
