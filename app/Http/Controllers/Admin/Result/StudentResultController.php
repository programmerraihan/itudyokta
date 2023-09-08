<?php

namespace App\Http\Controllers\Admin\Result;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\CourseTitle;
use App\Models\StudentUnit;
use Illuminate\Http\Request;
use App\Models\StudentResult;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentResultController extends Controller
{
    public function index()
    {

        // $courseTitles = CourseTitle::where('status', 1)->get();
        // $branches = Branch::where('status', 1)->get();
        // $batches = Batch::where('status', 1)->get();
        // $schedules = Schedule::where('status', 1)->get();
        // $sessions = Session::where('status', 1)->get();
        // $units = StudentUnit::where('status', 1)->get();
        // dd($courseTitles);

        return view('admin.admin.result.entry ', [
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
        // dd($request);


        $session_id           = $request->session_id;
        $branch_id            = $request->branch_id;
        $course_title_id      = $request->course_title_id;
        $batch_id             = $request->batch_id;
        $date                 = $request->date;

        $mcq_mark             = $request->mcq_mark;
        $assessment_mark      = $request->assessment_mark;
        $viva_mark            = $request->viva_mark;



        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();

       // dd($students);
        return view('admin.admin.result.view', compact('students', 'date', 'mcq_mark', 'assessment_mark', 'viva_mark', 'session_id', 'branch_id', 'course_title_id', 'batch_id'));
    }



    public function store(Request $request)
    {
       // dd($request);
        try {
            DB::commit();
            $date = $request->date;
            $mcqTotal = $request->mcq_mark;
            $assessmentTotal = $request->assessment_mark;
            $vivaTotal = $request->viva_mark;

            $results = $request->input('result');
            foreach ($results as $result) {
                $student_id = $result['student_id']; //this is enrollment id
                $mcq_mark = $result['mcq_mark'];
                $assessment_mark = $result['assessment_mark'];
                $viva_mark = $result['viva_mark'];


                $mcq_result = ($mcq_mark * 30) / $mcqTotal;
                $assessment_result = ($assessment_mark * 60) / $assessmentTotal;
                $viva_result = ($viva_mark * 10) / $vivaTotal;;

                $total_mark = round($mcq_result + $assessment_result + $viva_result);
                //dd($total_mark);
                switch ($total_mark) {
                    case $total_mark >= 80 and $total_mark <= 100:
                        $grade = 'A+';
                        break;
                    case $total_mark >= 70 and $total_mark <= 79:
                        $grade = 'A';
                        break;
                    case $total_mark >= 50 and $total_mark <= 59:
                        $grade = 'B';
                        break;
                    case $total_mark >= 40 and $total_mark <= 49:
                        $grade = 'C';
                        break;
                    case $total_mark >= 33 and $total_mark <= 39:
                        $grade = 'D';
                        break;
                    default:
                        $grade = 'Fail';
                }

                $data = ([
                    'student_id'         => $student_id,
                    'mcq_result'         => $mcq_result,
                    'assessment_result'  => $assessment_result,
                    'viva_result'        => $viva_result,
                    'total_mark'         => $total_mark,
                    'grade'              => $grade,
                    'user_id'            => Auth::guard('web')->id(),
                    'date'               => $date,
                    'batch_id'           => $request->batch_id,
                    'course_title_id'    => $request->course_title_id,
                    'session_id'         => $request->session_id,
                    'branch_id'          => $request->branch_id,

                ]);
                $studentResults = StudentResult::create($data);

                $request->branch_id;
                $branch = Branch::where('id',  $request->branch_id)->first();
                $student = Student::where('id', $student_id)->first();

                // dd($student->roll_no_student);




                if ($student) {
                    $sms_message = "{$branch->name} আপনি কম্পিউটার কোর্সর পরীক্ষায় অংশগ্রহণ করে সফলতার সাথে উত্তীণ হয়েছেন , রোল নং :{$student->roll_no_student} রেজাল্ট: {$grade} ভিজিট :http://coxs.test/student/login Click Student Result ";
                    send_sms($student->mobile, $sms_message);

                    $exception = [
                        'success' => 'Student Create Successfully',
                        'sms'     => $sms_message
                    ];
                } else {
                    $exception = ['error' => 'Database Error Found'];
                }
            }
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
        DB::commit();
        return redirect()->route('student_result.show')->with('message', ' Student Result Store  Successfully');
    }

    public function storeIssueDate(Request $request) 
    {
        $request->validate([
            "id" => ["required"],
            "issue_date" => ["required"],
            "held_from" => ["required"],
            "held_to" => ["required"],
        ]);
        $studentResult = StudentResult::findOrFail($request->id);
        $studentResult->issue_date = $request->issue_date;
        $studentResult->held_from = $request->held_from;
        $studentResult->held_to = $request->held_to;
        $studentResult->save();
        return redirect()->back()->with("message", "Successfull!");
    }

    public function show()
    {


        $studentResults =  StudentResult::orderBy('id', 'desc')
        ->get();
        return view('admin.admin.result.show',compact('studentResults'));
    }
    
    public function update(Request $request) 
    {
        $request->validate([
            "id" => ["required"],
            "mcq_result" => ["required"],
            "assessment_result" => ["required"],
            "viva_result" => ["required"],
            "grade" => ["required"],
        ]);
        $studentResult = StudentResult::findOrFail($request->id);
        $studentResult->assessment_result = $request->assessment_result;
        $studentResult->viva_result = $request->viva_result;
        $studentResult->grade = $request->grade;
        $studentResult->mcq_result = $request->mcq_result;
        $studentResult->total_mark = $request->mcq_result + $request->viva_result + $request->assessment_result;
        $studentResult->save();
        return redirect()->back()->with("message", "Successfull!");
    }

    public function destroy($id)
    {
        $this->homework = StudentResult::find($id);
        //dd($this->service);
        $this->homework->delete();
        return redirect()->back()->with("message", "Result info Delete Successfully!");
    }
}
