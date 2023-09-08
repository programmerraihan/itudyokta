<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Bank;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Schedule;
use App\Models\AccountHead;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentAdmissionController extends Controller
{
    public function index()
    {


        // dd($freeCourses);
        return view('frontend.admission', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'banks'         => Bank::where('status', 1)->orderBy('id', 'DESC')->get(),
            'AccountHeads'  => AccountHead::where('status', 1)->get(),
        ]);
    }

    public function coursePrice(Request $request)
    {

        // dd($request);
        $id = $request->id;
        $course = CourseTitle::where('id', $id)->select('price', 'offer_price')->first();
        return response()->json($course);
    }

    public function branchBatch(Request $request)
    {

        $batches = Batch::where('status', 1)->where('branch_id', $request->id)->get();

        return response()->json($batches);
    }

    public function batchSchedule(Request $request)
    {

        $schedules = Schedule::where('status', 1)->where('batch_id', $request->id)->get();
        //dd($schedules);
        return response()->json($schedules);
    }
}
