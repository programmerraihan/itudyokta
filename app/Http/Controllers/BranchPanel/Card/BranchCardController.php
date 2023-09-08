<?php

namespace App\Http\Controllers\BranchPanel\Card;

use App\Models\Unit;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\CourseTitle;
use App\Models\StudentUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentResult;
use Illuminate\Support\Facades\Auth;

class BranchCardController extends Controller
{
    public function add()
    {
        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.card.add-card', [
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'branches' => Branch::where('status', 1)->where('id', $id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $id)->get(),
            'sessions' => Session::where('status', 1)->where('branch_id', $id)->get(),
            'units' => StudentUnit::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }

    public function IdCardGenerate(Request $request)
    {
        //  return $request->all();

        $id = Auth::guard('branch')->user()->id;

        $org_info     = Branch::where('status', 1)->where('id',  $request->branch_id)->where('id', $id)->orderBy('id', 'DESC')->first();
        // dd($org_info);
        $session_id       = $request->session_id;
        $branch_id        = $id;
        $course_title_id  = $request->course_title_id;
        $batch_id         = $request->batch_id;


        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();
        // dd($students);
        return view('branch.branch-panel.card.print-id-card', compact('students', 'org_info'));
    }

    public function addAdmit()
    {

        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.card.add-admit-card', [
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'branches' => Branch::where('status', 1)->where('id', $id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $id)->get(),
            'sessions' => Session::where('status', 1)->where('branch_id', $id)->get(),
            'units' => StudentUnit::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }

    public function admitCardGenerate(Request $request)
    {
        // return $request->all();
        // $id = Auth::guard('branch')->user()->id;

        $org_info   = Branch::where('status', 1)->where('id',  $request->branch_id)->orderBy('id', 'DESC')->first();
        // dd($branches);
        $session_id         = $request->session_id;
        $branch_id          = $request->branch_id;
        $course_title_id    = $request->course_title_id;
        $batch_id           = $request->batch_id;


        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();
        // dd($students);
        return view('branch.branch-panel.card.print-admit-card', compact('students', 'org_info'));
    }

    public function addRegistration()
    {

        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.card.add-registration-card', [
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'branches' => Branch::where('status', 1)->where('id', $id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $id)->get(),
            'sessions' => Session::where('status', 1)->where('branch_id', $id)->get(),
            'units' => StudentUnit::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }

    public function registrationCardGenerate(Request $request)
    {
        // return $request->all();
        // $id = Auth::guard('branch')->user()->id;

        $org_info   = Branch::where('status', 1)->where('id',  $request->branch_id)->orderBy('id', 'DESC')->first();
        // dd($branches);
        $session_id         = $request->session_id;
        $branch_id          = $request->branch_id;
        $course_title_id    = $request->course_title_id;
        $batch_id           = $request->batch_id;


        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();
        // dd($students);
        return view('branch.branch-panel.card.print-registration-card', compact('students', 'org_info'));
    }

    public function addCertificate()
    {

        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.card.add-certificate-card', [
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'branches' => Branch::where('status', 1)->where('id', $id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $id)->get(),
            'sessions' => Session::where('status', 1)->where('branch_id', $id)->get(),
            'units' => StudentUnit::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }

    public function certificateCardGenerate(Request $request)
    {
        // return $request->all();
        // $id = Auth::guard('branch')->user()->id;

        $org_info   = Branch::where('status', 1)->where('id',  $request->branch_id)->orderBy('id', 'DESC')->first();
        // dd($branches);
        $session_id         = $request->session_id;
        $branch_id          = $request->branch_id;
        $course_title_id    = $request->course_title_id;
        $batch_id           = $request->batch_id;


        $students = StudentResult::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            // ->with('student')
            ->get();
        // dd($students);
        return view('branch.branch-panel.card.print-certificate-card', compact('students', 'org_info'));
    }
}
