<?php

namespace App\Http\Controllers\Admin\Attendance;

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

class StudentAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:student-attendance-entry", ["only" => ["index"]]);
    }
    
    public function index()
    {
        return view('admin.admin.attendance.student.entry ', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->get(),
        ]);
    }

    public function view(Request $request)
    {
        //dd($request);


        $session_id     = $request->session_id;
        $branch_id       = $request->branch_id;
        $course_title_id      = $request->course_title_id;
        $batch_id       = $request->batch_id;
        $date           = $request->date;

        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();

        // dd($students);
        return view('admin.admin.attendance.student.view', compact('students', 'date', 'branch_id'));
    }


    public function store(Request $request)
    {

        // dd($request);


        $attendance = $request->input('attendance');
        $a = Attendance::get();
        // dd(Auth::guard('user')->name);

        foreach ($attendance as $attend) {

            Attendance::create([
                'attendance_status' => $attend['attendance_status'],
                'in_time'           => $attend['in_time'],
                'out_time'          => $attend['out_time'],
                'attendance_date'   => $request->date,
                'stu_details_id'    => $attend['attendance_id'],
                'status'            => 1,
                'branch_id'            => $request->branch_id,
                'user_id'           => Auth::guard('web')->id(),
            ]);
        }
        return redirect()->route('student_attendance.index')->with('message', ' Attendance Add Successfully');
    }

    public function PresentAbsentGenerate()
    {

        return view('admin.admin.attendance.student.present_absent.present_absent_view_generate', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->get(),
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
        return view('admin.admin.attendance.student.present_absent.present_absent_view', compact('students', 'date'));
    }

    public function InOutGenerate()
    {

        return view('admin.admin.attendance.student.in_out.in_out_generate', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->get(),
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
        return view('admin.admin.attendance.student.in_out.in_out_view', compact('students', 'date'));
    }
}
