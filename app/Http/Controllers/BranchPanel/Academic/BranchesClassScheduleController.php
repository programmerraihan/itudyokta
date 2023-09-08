<?php

namespace App\Http\Controllers\BranchPanel\Academic;

use App\Models\Batch;
use App\Models\Schedule;
use App\Models\OurProject;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesClassScheduleController extends Controller
{



    public function index()
    {

        $id = Auth::guard('branch')->user()->id;
        $schedules =  Schedule::with('courseTitle', 'batch')->orderBy('id', 'DESC')->where('branch_id', $id)->get();


        // $schedules = Schedule::all();
        return view('branch.branch-panel.academic-module.schedule.index', compact('schedules'));
    }
    //End Method

    public function addSchedule()
    {
        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.academic-module.schedule.add', [
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }
    //End Method

    public function store(Request $request)
    {
        $day = $request->day;
        $id = Auth::guard('branch')->user()->id;
        $data = [
            'branch_id' => $id,
            'courseTitle_id' => $request->input('courseTitle_id'),
            'batch_id' => $request->input('batch_id'),
            'day' => $day,

        ];

        $item = Schedule::create($data);


        return redirect('branches/schedule-index')->with('message', 'schedule info create successfully');
    }
    //End Method



    public function edit($id)
    {
        return view('branch.branch-panel.academic-module.schedule.edit', [
            'schedule'     => Schedule::find($id),
            'courseTitles' => CourseTitle::where('status', 1)->get(),
        ]);
    } //End Method



    public function update(Request $request, $id)
    {
        $day = $request->day;
        $branch_id = Auth::guard('branch')->user()->id;
        $data = [
            'branch_id' => $branch_id,
            'courseTitle_id' => $request->input('courseTitle_id'),
            'batch_id' => $request->input('batch_id'),
            'day' => $day,

        ];

        $item = Schedule::find($id)->updated($data);

        return redirect('branches/schedule-index')->with('message', ' Schedule info Update successfully');
    } //End Method


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Schedule::updateScheduleStatus($id));
    } //End Method

    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect('branches/Schedule-index')->with('message', 'Schedule Unit info Delete Successfully');
    } //End Method

}
