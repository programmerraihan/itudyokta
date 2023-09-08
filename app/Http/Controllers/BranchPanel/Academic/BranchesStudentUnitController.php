<?php

namespace App\Http\Controllers\BranchPanel\Academic;

use File;
use App\Models\StudentUnit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesStudentUnitController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $units =  StudentUnit::where('branch_id', $id)->get();
        return view('branch.branch-panel.academic-module.unit.index', compact('units'));
    }

    public function addStudentUnit()
    {
        return view('branch.branch-panel.academic-module.unit.add');
    }

    public function store(Request $request)
    {
        $unit = new StudentUnit();
        $unit->branch_id         =  Auth::guard('branch')->user()->id;
        $unit->name              =  $request->input('name');
        $unit->status            =  $request->input('status');
        $unit->save();
        return redirect('branches/student-Unit-index')->with('message', 'Student Unit info create successfully');
    }

    public function edit($id)
    {
        $unit = StudentUnit::find($id);
        return view('branch.branch-panel.academic-module.unit.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $unit = StudentUnit::find($id);
        $unit->branch_id         =  Auth::guard('branch')->user()->id;
        $unit->name              =  $request->input('name');
        $unit->status            =  $request->input('status');
        $unit->save();
        return redirect('branches/student-Unit-index')->with('message', ' Student Unit info Update successfully');
    }

    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', StudentUnit::updateStudentUnitStatus($id));
    }

    public function destroy($id)
    {
        $unit = StudentUnit::find($id);
        $unit->delete();
        return redirect('branches/student-Unit-index')->with('message', 'Student Unit info Delete Successfully');
    }
}
