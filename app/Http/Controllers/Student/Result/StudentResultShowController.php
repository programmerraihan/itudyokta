<?php

namespace App\Http\Controllers\Student\Result;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Models\StudentResult;
use App\Models\AssessmentTestTaker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentResultShowController extends Controller
{
    public function show()
    {
        $student_id = Auth::guard('student')->user()->id;
        // dd($student_id);

        $studentResults = StudentResult::orderBy('id', 'desc')->where('student_id',  $student_id)
        // ->with('student')
        ->get();
        //dd($studentResults);

        return view('student.student.result.result', compact('studentResults'));
    }

    public function from()
    {

        $student_id = Auth::guard('student')->user()->id;
        return view('student.student.from.show', [
            'students' => Student::orderBy('id', 'desc')->where('status', 1)->where('id',  $student_id)->with('StudentEduction', 'Enrollment')->get(),
        ]);
    }

    public function detail($id)
    {
        return view('student.student.from.detail', [
            'student' =>     Student::with('StudentEduction', 'Enrollment', 'StudentFee', 'AcTransaction')->find($id),
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
        ]);
    } //End Met
}
