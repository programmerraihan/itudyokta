<?php

namespace App\Http\Controllers\Student\Mcq;

use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\AssessmentExam;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentTestTaker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssessmentQuestionMaster;
use App\Models\AssessmentSubmittedAnswer;
use Illuminate\Support\Facades\Validator;

class StudentMcqController extends Controller
{
    public function index()
    {
        $id = Auth::guard('student')->user()->id;
        $student_id = Enrollment::where('student_id', $id)->get(['course_title_id']);
        $questions = AssessmentExam::with('question')->orderBy('id', 'DESC')
            ->get();
        return view('student.student.mcq.index', compact('questions'));
    }

    public function studentMcqTest($id)
    {
        $id = $id;
        // $question_master = AssessmentQuestionMaster::where('id', $id)->orderBy('id', 'DESC')->limit(1)->first();
        return view('student.student.mcq.infoGet', compact('id'));
    }

    function mcqQuestion(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [

                'roll' => ['required'],
                'phone' => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $exam = AssessmentExam::findOrFail($id);
            if(!$exam) {
                abort(404, 'Sorry! Exam Not Found!');
            }
            $Student_id = Auth::guard('student')->user()->id;
            $student = Student::where('id', $Student_id)->where('mobile', $request->phone)->first(['mobile', 'roll_no_student', 'present_address', 'name', 'email']);
            $name   = $student->name;
            $address = $student->present_address;
            $roll  = $student->roll_no_student;
            $phone  = $student->mobile;
            $email  = $student->email;
            $student_id = $Student_id;
            
            $question_master = AssessmentQuestionMaster::where('id', $exam->question_id)->orderBy('id', 'DESC')->limit(1)->first();            
            $questions = AssessmentQuestion::where('assessment_question_master_id', $question_master->id)->orderBy('question_no', 'ASC')->get();

            return view('student.student.mcq.test', compact('question_master', 'exam', 'questions',  'name', 'address', 'email', 'phone', 'student_id', 'roll'));
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }
    }

    public function mcqAnswerSubmit(Request $request)
    {
        $Student = Student::where('id', $request->student_id)->first(['branch_id']);
        try {
            $test_taker = AssessmentTestTaker::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'student_id' => $request->student_id,
                'roll' => $request->roll,
                'branch_id' => $Student->branch_id,
                "assessment_exam_id" => $request->assessment_exam_id,
            ]);
            $answers =  $request->answer;
            foreach ($answers as $q_id => $answer) {
                AssessmentSubmittedAnswer::create([
                    'assessment_test_taker_id' => $test_taker->id,
                    'assessment_question_id' => $q_id,
                    'answer' => $request->answer[$q_id],
                ]);
            }

            return redirect()->route('student.mcq.submitted')->with('message', 'Answer Submitted Successfully!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function indexMcq()
    {
        $id = Auth::guard('student')->user()->id;
        $test_takers = AssessmentTestTaker::where('student_id', $id)->orderBy('id', 'DESC')->get();
        return view('student.student.mcq.result', compact('test_takers'));
    }
}
