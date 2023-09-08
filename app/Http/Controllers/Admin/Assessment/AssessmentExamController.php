<?php

namespace App\Http\Controllers\Admin\Assessment;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Models\AssessmentExam;
use App\Http\Controllers\Controller;
use App\Models\AssessmentQuestionMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AssessmentExamController extends Controller
{
    public function create()
    {
        $sessions = Session::Where('status', 1)->get();
        $batches = Batch::Where('status', 1)->get();
        $courses = CourseTitle::Where('status', 1)->get();
        $branches = Branch::where('status', 1)->get();
        $questions = AssessmentQuestionMaster::orderBy('id', 'DESC')->whereStatus(true)->get();
        return view('admin.assessments.exams.index', compact('sessions', 'batches', 'courses', 'branches', 'questions'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'               => ['required', 'string', 'max:255'],
                'session_id'         => ['required', 'string', 'max:255'],
                'branch_id'          => ['required', 'string', 'max:255'],
                'course_title_id'    => ['required', 'string', 'max:255'],
                'batch_id'           => ['required', 'string', 'max:255'],
                'question_id'        => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                'name'            => $request['name'],
                'session_id'      => $request['session_id'],
                'batch_id'        => $request['batch_id'],
                'branch_id'       => $request['branch_id'],
                'course_title_id' => $request['course_title_id'],
                'status'          => 1,
                'created_by'      => Auth::id(),
                'question_id'      => $request->question_id,
            ];

            $check = AssessmentExam::create($data);
            return redirect()->route('assessment.exam.index')->with('message', 'Data Successfully added!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }




    public function index()
    {
        $exams = AssessmentExam::get();
        return view('admin.assessments.exams.show', compact('exams'));
    }

    public function status($id)
    {
        try {
            $exam = AssessmentExam::find($id);
            if ($exam->status == 1) {
                $exam->status = 0;
            } else {
                $exam->status = 1;
            }
            $exam->save();

            return redirect()->back()->with('message', 'Data updated Successfully!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    public function edit($id)
    {
        try {
            $exam = AssessmentExam::find($id);
            $sessions = Session::get();
            $batches = Batch::Where('status', 1)->get();
            $questions = AssessmentQuestionMaster::orderBy('id', 'DESC')->whereStatus(true)->get();

            return view('admin.assessments.exams.edit', compact('sessions',  'exam', 'batches', 'questions'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        //return  $id;
        try {
            $exam = AssessmentExam::findOrFail($id);

            // dd($exam);

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'session_id' => ['required', 'string', 'max:255'],
                'question_id' => ['required', 'string', 'max:255'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $exam->update([
                'name'       => $request['name'],
                'session_id' => $request['session_id'],
                'batch_id'   => $request['batch_id'],
                'status'     => 1,
                'updated_by' => Auth::id(),
                'question_id' => $request->question_id
            ]);

            return redirect()->route('assessment.exam.index')->with('message', 'Data Successfully Updated!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        // dd($id);
        try {
            $exam = AssessmentExam::find($id);
            // dd($exam);
            $exam->delete();
            return redirect()->route('assessment.exam.index')->with('message', 'Deleted Successfully!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
