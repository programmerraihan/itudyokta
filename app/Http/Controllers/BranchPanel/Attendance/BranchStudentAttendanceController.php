<?php

namespace App\Http\Controllers\BranchPanel\Attendance;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\CourseTitle;
use App\Models\StudentUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchStudentAttendanceController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.attendance.student.entry ', [
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'branches' => Branch::where('status', 1)->where('id', $id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $id)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }

    public function view(Request $request)
    {
        // dd($request);


        $session_id        = $request->session_id;
        $branch_id         = $request->branch_id;
        $course_title_id   = $request->course_title_id;
        $batch_id          = $request->batch_id;
        $date              = $request->date;

        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();

        // dd($students);
        return view('branch.branch-panel.attendance.student.view', compact('students', 'date', 'branch_id'));
    }


    public function store(Request $request)
    {

        // dd($request);

        $attendance = $request->input('attendance');
        $a = Attendance::get();
        // dd(Auth::guard('user')->name);

        $id = Auth::guard('branch')->user()->id;

        foreach ($attendance as $attend) {

            $data = ([
                'attendance_status' => $attend['attendance_status'],
                'in_time'           => $attend['in_time'],
                'out_time'          => $attend['out_time'],
                'attendance_date'   => $request->date,
                'stu_details_id'    => $attend['attendance_id'],
                'status'            => 1,
                'branch_id'         => $request->branch_id,
            ]);
            // dd($data);

            // $cheek = Attendance::all();
            // dd($cheek);

            Attendance::create($data);
        }
        return redirect()->route('student_attendance_branch.index')->with('message', ' Attendance Add Successfully');
    }

    public function PresentAbsentGenerate()
    {
        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.attendance.student.present_absent.present_absent_view_generate', [
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'branches' => Branch::where('status', 1)->where('id', $id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $id)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }


    public function PresentAbsentView(Request $request)
    {

        $session_id             = $request->session_id;
        $branch_id              = $request->branch_id;
        $course_title_id        = $request->course_title_id;
        $batch_id               = $request->batch_id;
        $date                   = $request->date;

        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();


        //dd($attendances);
        return view('branch.branch-panel.attendance.student.present_absent.present_absent_view', compact('students', 'date'));
    }

    public function InOutGenerate()
    {
        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.attendance.student.in_out.in_out_generate', [
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'branches' => Branch::where('status', 1)->where('id', $id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $id)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }

    public function InOutView(Request $request)
    {
        $session_id             = $request->session_id;
        $branch_id              = $request->branch_id;
        $course_title_id        = $request->course_title_id;
        $batch_id               = $request->batch_id;
        $date                   = $request->date;

        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();


        //dd($group_id);
        return view('branch.branch-panel.attendance.student.in_out.in_out_view', compact('students', 'date'));
    }
}
