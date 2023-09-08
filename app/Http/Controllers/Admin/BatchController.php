<?php

namespace App\Http\Controllers\Admin;

use App\Models\Batch;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use App\Models\Branch as ModelsBranch;
use App\Models\CourseTitle;
use App\Models\StudentUnit;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::all();
        return view('admin.admin.batch.index', compact('batches'));
    }  //End Method


    public function addBatch()
    {
        return view('admin.admin.batch.add', [
            'branches' => Branch::where('status', 1)->get(['id', 'name']),
            'sessions' => Session::where('status', 1)->get(),
            'units'    => StudentUnit::where('status', 1)->get(),
            'courses'    => CourseTitle::where('status', 1)->get(),

        ]);
    } //End Method


    public function store(Request $request)
    {
        // return $request->all();
        $batch = new Batch();

        $batch->branch_id         =  $request->input('branch_id');
        $batch->session_id       =  $request->input('session_id');
        $batch->course_title_id  =  $request->input('course_title_id');
        $batch->name             =  $request->input('name');
        $batch->detail           =  $request->input('detail');
        $batch->status           =  $request->input('status');
        $batch->save();
        return redirect('/batch-index')->with('message', 'Batch info create successfully');
    } //End Method

    public function edit($id)
    {
        return view('admin.admin.batch.edit', [

            'batch'     => Batch::find($id),
            'branches'  => Branch::where('status', 1)->get(['id', 'name']),
            'sessions'  => Session::where('status', 1)->get(),
            'courses'   => CourseTitle::where('status', 1)->get(),

        ]);
    } //End Method



    public function update(Request $request, $id)
    {
        $batch = Batch::find($id);
        $batch->branch_id         =  $request->input('branch_id');
        $batch->session_id       =  $request->input('session_id');
        $batch->course_title_id  =  $request->input('course_title_id');
        $batch->name             =  $request->input('name');
        $batch->detail           =  $request->input('detail');
        $batch->status           =  $request->input('status');
        $batch->save();
        return redirect('/batch-index')->with('message', ' Batch info Update successfully');
    } //End Method


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Batch::updateBatchStatus($id));
    } //End Method

    public function destroy($id)
    {
        $this->batch = Batch::find($id);
        $this->batch->delete();
        return redirect('/batch-index')->with('message', 'Batch Unit info Delete Successfully');
    } //End Method


    public function getBatches(Request $request)
    {
        $batches = Batch::where('course_title_id', $request->course_title_id)->get();

        if (count($batches) > 0) {
            return response()->json($batches);
        }
    }
}
