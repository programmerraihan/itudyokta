<?php

namespace App\Http\Controllers\BranchPanel\Result;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\CourseTitle;
use App\Models\StudentUnit;
use Illuminate\Http\Request;
use App\Models\StudentResult;
use Illuminate\Support\Facades\DB;
use App\Models\AssessmentTestTaker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchStudentResultController extends Controller
{
    // public function index()
    // {
    //     return view('admin.admin.result.entry ', [
    //         'courseTitles' => CourseTitle::where('status', 1)->get(),
    //         'branches' => Branch::where('status', 1)->get(),
    //         'batches' => Batch::where('status', 1)->get(),
    //         'schedules' => Schedule::where('status', 1)->get(),
    //         'sessions' => Session::where('status', 1)->get(),
    //         'units' => StudentUnit::where('status', 1)->get(),
    //     ]);
    // }

    // public function view(Request $request)
    // {
    //     // dd($request);


    //     $session_id           = $request->session_id;
    //     $branch_id            = $request->branch_id;
    //     $course_title_id      = $request->course_title_id;
    //     $batch_id             = $request->batch_id;
    //     $date                 = $request->date;

    //     $mcq_mark             = $request->mcq_mark;
    //     $assessment_mark      = $request->assessment_mark;
    //     $viva_mark            = $request->viva_mark;



    //     $students = Enrollment::where('session_id', $session_id)
    //         ->where('branch_id', $branch_id)
    //         ->where('course_title_id', $course_title_id)
    //         ->where('batch_id', $batch_id)
    //         ->with('student')
    //         ->get();

    //     // dd($students);
    //     return view('admin.admin.result.view', compact('students', 'date', 'mcq_mark', 'assessment_mark', 'viva_mark'));
    // }



    // public function store(Request $request)
    // {

    //     try {
    //         DB::commit();
    //         $date = $request->date;
    //         $mcqTotal = $request->mcq_mark;
    //         $assessmentTotal = $request->assessment_mark;
    //         $vivaTotal = $request->viva_mark;

    //         $results = $request->input('result');
    //         foreach ($results as $result) {
    //             $student_id = $result['student_id'];
    //             $mcq_mark = $result['mcq_mark'];
    //             $assessment_mark = $result['assessment_mark'];
    //             $viva_mark = $result['viva_mark'];


    //             $mcq_result = ($mcq_mark * 30) / $mcqTotal;
    //             $assessment_result = ($assessment_mark * 60) / $assessmentTotal;
    //             $viva_result = ($viva_mark * 10) / $vivaTotal;;

    //             $total_mark = round($mcq_result + $assessment_result + $viva_result);
    //             //dd($total_mark);
    //             switch ($total_mark) {
    //                 case $total_mark >= 80 and $total_mark <= 100:
    //                     $grade = 'A+';
    //                     break;
    //                 case $total_mark >= 70 and $total_mark <= 79:
    //                     $grade = 'A';
    //                     break;
    //                 case $total_mark >= 50 and $total_mark <= 59:
    //                     $grade = 'B';
    //                     break;
    //                 case $total_mark >= 40 and $total_mark <= 49:
    //                     $grade = 'C';
    //                     break;
    //                 case $total_mark >= 33 and $total_mark <= 39:
    //                     $grade = 'D';
    //                     break;
    //                 default:
    //                     $grade = 'Fail';
    //             }


    //             $data = ([
    //                 'student_id'         => $student_id,
    //                 'mcq_result'         => $mcq_result,
    //                 'assessment_result'  => $assessment_result,
    //                 'viva_result'        => $viva_result,
    //                 'total_mark'         => $total_mark,
    //                 'grade'              => $grade,
    //                 'user_id'            => Auth::guard('web')->id(),
    //                 'date'               => $date,
    //             ]);
    //             $studentResults = StudentResult::create($data);
    //         }
    //     } catch (\Exception $exception) {
    //         dd($exception->getMessage());
    //     }
    //     DB::commit();
    //     return redirect()->route('student_result.show')->with('message', ' Student Result Store  Successfully');
    // }

    public function show()
    {

        // $studentResults = StudentResult::orderBy('id', 'desc')->with('student')->get();
        // dd($studentResults);

        // return view('branch.branch-panel.result.show', [
        //     'studentResults' => StudentResult::orderBy('id', 'desc')->with('student')->get(),
        // ]);

        $branch_id = Auth::guard('branch')->user()->id;
        if ($branch_id) {
            return view('branch.branch-panel.result.show', [
                'studentResults' => StudentResult::orderBy('id', 'desc')->Where('branch_id', $branch_id)
                // ->with('student')
                ->get(),
            ]);
        } else {
            return view('branch.branch-panel.result.show', [
                'studentResults' => StudentResult::orderBy('id', 'desc')
                // ->with('student')
                ->get(),
            ]);
        }
    }

    public function resultShow()
    {
        $branch_id = Auth::guard('branch')->user()->id;

        $test_takers = AssessmentTestTaker::where('branch_id', $branch_id)->orderBy('id', 'DESC')->get();
        return view('branch.branch-panel.result.mcq_result', compact('test_takers'));
    }
}
