<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Support\Facades\Auth;

class ClassScheduleController extends Controller
{



    public function index()
    {
        $schedules = Schedule::with('courseTitle', 'batch')->orderBy('id', 'DESC')->get();
        return view('admin.admin.schedule.index', compact('schedules'));
    }


    public function addSchedule()
    {
        return view('admin.admin.schedule.add', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
        ]);
    }


    public function store(Request $request)
    {
        $day = $request->day;
        $admin_id = Auth::guard('web')->user()->id;
        $data = [
            'admin_id' => $admin_id,
            'courseTitle_id' => $request->input('courseTitle_id'),
            'batch_id' => $request->input('batch_id'),
            'day' => $day,

        ];
        $item = Schedule::create($data);
        return redirect('/schedule-index')->with('message', 'Schedule info create successfully');
    }
    //End Method



    public function edit($id)
    {
        return view('admin.admin.schedule.edit', [
            'schedule'     => Schedule::find($id),
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
        ]);
    }



    public function update(Request $request, $id)
    {
        $day = $request->day;
        $admin_id = Auth::guard('web')->user()->id;
        $data = [
            'admin_id' => $admin_id,
            'courseTitle_id' => $request->input('courseTitle_id'),
            'batch_id' => $request->input('batch_id'),
            'day' => $day,

        ];
        $item = Schedule::find($id)->updated($data);
        return redirect('/schedule-index')->with('message', ' Schedule info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Schedule::updateScheduleStatus($id));
    }
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect('/schedule-index')->with('message', 'Schedule Unit info Delete Successfully');
    }
}
