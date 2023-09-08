<?php

namespace App\Http\Controllers\Admin\Assessment;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Session;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\AssessmentExam;
use App\Models\AssessmentQuestion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\AssessmentQuestionDetail;
use App\Models\AssessmentQuestionMaster;
use Illuminate\Support\Facades\Validator;

class AssessmentQuestionController extends Controller
{


    public function index()
    {
        $questions = AssessmentQuestionMaster::orderBy('id', 'DESC')->with('assessment_exam')->get();
        // dd($questions);
        return view('admin.assessments.questions.show', compact('questions'));
    }

    public function create()
    {
        return view('admin.assessments.questions.add');
    }

    public function questionAddBtn()
    {
        return response()->json();
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $ques       = $request->ques;
            $total_m    = 0;

            if ($ques) {
                foreach ($ques as $i => $que) {
                    $total_m += $que['mark'];
                }
            }
            $data = ([
                'name'              => $request['name'],
                'hour'              => $request['hour'],
                'minute'            => $request['minute'],
                'passege'           => $request['passege'],
                'total_marks'       => $total_m,
                'status'            => 1,
                'created_by'        => Auth::id()
            ]);
            $question_master = AssessmentQuestionMaster::create($data);

            $question_master_id = $question_master->id;
            if ($ques) {
                foreach ($ques as $i => $que) {
                    $question = ([
                        'question'                       => $que['question'],
                        'question_no'                    => $i,
                        'mark'                           => $que['mark'],
                        'answer'                         => $que['answer'],
                        'type'                           => 'que',
                        'assessment_question_master_id'  => $question_master_id,
                        'status'                         => 1,
                        'created_by'                     => Auth::id()
                    ]);
                    $question =  AssessmentQuestion::create($question);

                    $question_id = $question->id;
                    $mcq_options = $que['option'];

                    foreach ($mcq_options as  $i => $option) {
                        $option = ([
                            'option'                     => $option,
                            'assessment_question_id'     => $question_id,
                        ]);
                        AssessmentQuestionDetail::create($option);
                    }
                }
            }
            DB::commit();
            return redirect()->route('assessment.question.index')->with('message', 'Data Successfully added!');
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function status($id)
    {
        try {
            $exam = AssessmentQuestionMaster::find($id);
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
            $question       = AssessmentQuestionMaster::find($id);
            $ass_questions  = AssessmentQuestion::where('assessment_question_master_id', $id)->orderBy('question_no', 'ASC')->get();
            $last_question  = AssessmentQuestion::where('assessment_question_master_id', $id)->orderBy('question_no', 'DESC')->first();
            return view('admin.assessments.questions.edit', compact('question', 'ass_questions', 'last_question'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $last_question  = AssessmentQuestion::where('assessment_question_master_id', $id)->orderBy('question_no', 'DESC')->first();
            $question_master = AssessmentQuestionMaster::findOrFail($id);
            $total_m    = 0;

            $ques       = $request->ques;
            if ($ques) {
                foreach ($ques as $i => $que) {
                    $total_m += $que['mark'];
                }
            }
            $data = ([
                'name'              => $request['name'],
                'hour'              => $request['hour'],
                'minute'            => $request['minute'],
                'passege'           => $request['passege'],
                'total_marks'       => $total_m,
                'status'            => 1,
                'created_by'        => Auth::id()
            ]);


            $question_master = $question_master->update($data);
            $questions = AssessmentQuestion::where('assessment_question_master_id', $id)->get();

            if ($questions) {
                foreach ($questions as  $question) {
                    foreach ($ques as $i => $que) {
                        if ($question->question_no == $i) {
                            $question->update([
                                'question'                       => $que['question'],
                                'mark'                           => $que['mark'],
                                'answer'                         => $que['answer'],
                                'type'                           => 'que',
                                'assessment_question_master_id'  => $id,
                                'status'                         => 1,
                                'created_by'                     => Auth::id()
                            ]);
                            $question_id = $question->id;
                            $que_options = $que['option'];
                            $db_que_options = AssessmentQuestionDetail::where('assessment_question_id', $question_id)->get();
                            foreach ($db_que_options as  $j => $db_option) {
                                foreach ($que_options as $k => $option) {
                                    if ($j + 1 == $k) {
                                        $db_option->update([
                                            'option'                     => $option,
                                            'assessment_question_id'     => $question_id,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // New Question Add by updating question script
            $mcqs       = $request->mcq;

            if ($mcqs) {
                foreach ($mcqs as $i => $mcq) {
                    $total_m += $mcq['mark'];
                }
            }
            $question_master_id = $id;
            if ($mcqs) {

                foreach ($mcqs as $j => $mcq) {
                    $j;
                    $data = ([
                        'question'                       => $mcq['question'],
                        'question_no'                    => $last_question->question_no + $j,
                        'mark'                           => $mcq['mark'],
                        'answer'                         => $mcq['answer'],
                        'type'                           => 'que',
                        'assessment_question_master_id'  => $question_master_id,
                        'status'                         => 1,
                        'created_by'                     => Auth::id()
                    ]);
                    $question =  AssessmentQuestion::create($data);

                    $question_id = $question->id;
                    $mcq_options = $mcq['option'];
                    foreach ($mcq_options as  $i => $option) {
                        $option = ([
                            'option'                     => $option,
                            'assessment_question_id'     => $question_id,
                        ]);
                        AssessmentQuestionDetail::create($option);
                    }
                }
            }

            DB::commit();

            return redirect()->route('assessment.question.index')->with('message', 'Data Successfully added!');
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }



    public function delete($id)
    {
        try {
            DB::commit();
            $assessmentQuestionMaster = AssessmentQuestionMaster::find($id);

            $assessmentQuestions = AssessmentQuestion::where('assessment_question_master_id', $id)->get();
            foreach ($assessmentQuestions as $item) {

                $assessmentQuestionDetails =  AssessmentQuestionDetail::where('assessment_question_id', $item->id)->get();
                foreach ($assessmentQuestionDetails as $item) {
                    $item->delete();
                }
            }
            foreach ($assessmentQuestions as $item) {
                $item->delete();
            }
            AssessmentQuestionMaster::where('id', $assessmentQuestionMaster->id)->delete();
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception->getMessage());
        }
        return redirect()->back()->with('message', 'Question info delete successfully.');
    }
}
