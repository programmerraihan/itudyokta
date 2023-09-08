<?php

namespace App\Http\Controllers\BranchPanel\Attendance;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TeacherAttendance;
use App\Http\Controllers\Controller;

class BranchTeacherAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('attendance.teacher.entry');
    }

    public function view(Request $request)
    {
        $date = $request->date;
        $teachers = Teacher::get();
        return view('attendance.teacher.view', compact('teachers', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // $dt = Carbon::now();

    // var_dump($dt->toDateTimeString() == $dt);          // bool(true) => uses     __toString()
    // echo $dt->toDateString();                          // 1975-12-25
    // echo $dt->toFormattedDateString();                 // Dec 25, 1975
    // echo $dt->toTimeString();                          // 14:15:16
    // echo $dt->toDateTimeString();                      // 1975-12-25 14:15:16
    // echo $dt->toDayDateTimeString();                   // Thu, Dec 25, 1975 2:15 PM

    public function store(Request $request)
    {
        $attendance = $request->input('attendance');
        $dt = Carbon::now();
        foreach ($attendance as $attend) {

            TeacherAttendance::create([
                'attendance_status' => $attend['attendance_status'],
                'attendance_date' => $request->date,
                'attendance_time'  => $dt->toTimeString(),
                'teacher_id' => $attend['attendance_id'],
                'status' => 1,
                'user_id' => 1,
            ]);
        }

        return redirect()->route('teacher_attendance.index')->with('message', 'Add Successfully');
    }

    public function PresentAbsentGenerate()
    {
        return view('attendance.teacher.present_absent.present_absent_view_generate');
    }

    public function PresentAbsentView(Request $request)
    {
        $date = $request->date;

        $teachers = Teacher::get();

        //dd($attendances);
        return view('attendance.teacher.present_absent.present_absent_view', compact('teachers', 'date'));
    }
}
