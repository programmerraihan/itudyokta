<?php

namespace App\Http\Controllers\Admin\Assessment;

use Illuminate\Http\Request;
use App\Models\AssessmentQuestion;
use Illuminate\Support\Facades\DB;
use App\Models\AssessmentTestTaker;
use App\Http\Controllers\Controller;
use App\Models\AssessmentQuestionMaster;
use App\Models\AssessmentSubmittedAnswer;

class AssessmentResultController extends Controller
{

    public function index()
    {
        $test_takers = AssessmentTestTaker::orderBy('id', 'DESC')->get();
        return view('admin.assessments.result.show', compact('test_takers'));
    }


    public function edit($id)
    {
        try {
            $test_taker      = AssessmentTestTaker::find($id);
            $answers         = AssessmentSubmittedAnswer::where('assessment_test_taker_id', $id)->with('assessment_question')->get();
            $ans             = AssessmentSubmittedAnswer::where('assessment_test_taker_id', $id)->limit(1)->first();
            $question        = AssessmentQuestion::where('id', $ans->assessment_question_id)->limit(1)->first();
            $question_master = AssessmentQuestionMaster::where('id', $question->assessment_question_master_id)->orderBy('id', 'DESC')->limit(1)->first();
            return view('admin.assessments.result.edit', compact('answers', 'test_taker',  'question_master'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    public function update(Request $request, $id)
    {
        try {
            $total = 0;
            $given_marks = $request->given_mark;
            foreach ($given_marks as $q_id => $given_mark) {
                $total += $request->given_mark[$q_id];
                $answer = AssessmentSubmittedAnswer::where('assessment_question_id', $q_id)
                    ->where('assessment_test_taker_id', $id)->limit(1)->first();
                $answer->update([
                    'marks' => $request->given_mark[$q_id]
                ]);
            }

            $test_taker = AssessmentTestTaker::find($id);
            $test_taker->update([
                'total_marks' => $total
            ]);

            return redirect()->route('submitted.assessment.index')->with('message', 'Data Successfully Updated!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function delete($id)
    {
        try {
            DB::commit();
            $test_taker = AssessmentTestTaker::find($id);

            $assessmentSubmittedAnswer = AssessmentSubmittedAnswer::where('assessment_test_taker_id', $id)->get();

            foreach ($assessmentSubmittedAnswer as $item) {
                $item->delete();
            }
            AssessmentTestTaker::where('id', $test_taker->id)->delete();
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception->getMessage());
        }
        return redirect()->back()->with('message', 'Question info delete successfully.');
    }
}
