<?php

namespace App\Http\Controllers\BranchPanel\Academic;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\CourseTitle;
use App\Models\StudentUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch as ModelsBranch;

class BranchesBatchController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $batches =  Batch::where('branch_id', $id)->get();
        return view('branch.branch-panel.academic-module.batch.index', compact('batches'));
    }  //End Method


    public function addBatch()
    {
        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.academic-module.batch.add', [
            'branches' => Branch::where('status', 1)->where('id', $id)->get(['id', 'name']),
            'sessions' => Session::where('status', 1)->get(),
            'units'    => StudentUnit::where('status', 1)->where('branch_id', $id)->get(),
            'courses'    => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }


    public function store(Request $request)
    {
        $batch = new Batch();
        $batch->branch_id        =  $request->input('branch_id');
        $batch->session_id       =  $request->input('session_id');
        $batch->course_title_id  =  $request->input('course_title_id');
        $batch->name             =  $request->input('name');
        $batch->detail           =  $request->input('detail');
        $batch->status           =  $request->input('status');
        $batch->save();
        return redirect('branches/batch-index')->with('message', 'Batch info create successfully');
    } //End Method

    public function edit($id)
    {

        // $batch     = Batch::find($id);
        // dd($batch);
        $branch_id = Auth::guard('branch')->user()->id;

        
        $batch     = Batch::find($id);
        $branches  = Branch::where('status', 1)->where('id', $branch_id)->get(['id', 'name']);
        $sessions  = Session::where('status', 1)->get();
        $units     = StudentUnit::where('status', 1)->where('branch_id', $branch_id)->get();


        return view('branch.branch-panel.academic-module.batch.edit', compact('batch', 'branches', 'sessions', 'units') );
    } //End Method



    public function update(Request $request, $id)
    {
        $batch = Batch::find($id);
        $batch->branch_id         =  $request->input('branch_id');
        $batch->session_id       =  $request->input('session_id');
      
        $batch->name             =  $request->input('name');
        $batch->detail           =  $request->input('detail');
        $batch->status           =  $request->input('status');
        $batch->save();
        return redirect('branches/batch-index')->with('message', ' Batch info Update successfully');
    } //End Method


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Batch::updateBatchStatus($id));
    } //End Method

    public function destroy($id)
    {
        $batch = Batch::find($id);
        $batch->delete();
        return redirect('branches/batch-index')->with('message', 'Batch Unit info Delete Successfully');
    } //End Method
}
