<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AccountHead;
use App\Models\AssessmentExam;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentSubmittedAnswer;
use App\Models\AssessmentTestTaker;
use App\Models\Bank;
use App\Models\Batch;
use App\Models\Blog;
use App\Models\Branch;
use App\Models\CourseTitle;
use App\Models\Director;
use App\Models\Gallery;
use App\Models\Notice;
use App\Models\OfflineExamResult;
use App\Models\OurProject;
use App\Models\OurService;
use App\Models\OurSpeech;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    public $branch_id = null;

    public function __construct()
    {
        $branch_name = request()->branch != 'main' ? request()->branch : 'main';
        if($branch_name != 'main') {
            $branch = Branch::where('slug', $branch_name)->first();
            if(!$branch) {
                // abort(404, "Branch not found!");
            }else {
                $this->branch_id = $branch->id;
            }
        }
    }


    /**
     * home page
     */
    public function index()
    {
        if(request()->branch != 'main') {
            $branch = Branch::where('slug', request()->branch)->first();
            if(!$branch) {
                abort(404, "Branch not found!");
            }
        }

        $data["speech"] = OurSpeech::where("branch_id", $this->branch_id)->first();
        $data["offlineCourses"] = CourseTitle::where('status', 1)->where("branch_id", $this->branch_id)->where('course_type', 0)->limit(4)->get();
        $data["onlineCourses"] = CourseTitle::where("branch_id", $this->branch_id)->where('status', 1)->where('course_type', 1)->limit(4)->get();
        $data["freeCourses"] = CourseTitle::where("branch_id", $this->branch_id)->where('status', 1)->where('course_type', 2)->limit(4)->get();
        $data["services"] = OurService::where('status', 1)->limit(20)->get();
        $data["projects"] = OurProject::where("branch_id", $this->branch_id)->where('status', 1)->limit(20)->get();
        $data["branches"] = Branch::all();
        $data["directors"] = Director::where("branch_id", $this->branch_id)->get();
        $data["galleries"] = Gallery::where('status', 1)->limit(9)->get();
        return view("website.index", $data);
    }

    /**
     * speech details page
     */
    public function speechDetails($id) 
    {
        $speech = OurSpeech::findOrFail($id);
        return view("website.speechDetail", compact("speech"));
    }

    /**
     * course details page
     */
    public function courseDetails($id)
    {
        $course = CourseTitle::where('status', 1)->where('id', $id)->first();
        return view("website.courseDetail", compact("course"));
    }

    /**
     * about page
     */
    public function about()
    {
        $about = About::where("branch_id", $this->branch_id)->first();
        return view("website.about", compact("about"));
    }

    /**
     * course page
     */
    public function course() 
    {
        $offlineCourses = CourseTitle::where("branch_id", $this->branch_id)->where('course_type', 0)->get();
        $onlineCourses = CourseTitle::where("branch_id", $this->branch_id)->where('course_type', 1)->get();
        $freeCourses = CourseTitle::where("branch_id", $this->branch_id)->where('course_type', 2)->get();
        return view("website.course", compact("offlineCourses", "onlineCourses", "freeCourses"));
    }

    /**
     * admission page
     */
    public function admission()
    {
        return view("website.admission", [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'banks'         => Bank::where('status', 1)->orderBy('id', 'DESC')->get(),
            'AccountHeads'  => AccountHead::where('status', 1)->get(),
        ]);
    }

    /**
     * online exam
     */
    public function onlineExam()
    {
        $exams = AssessmentExam::orderBy('id', 'DESC')->get();
        return view("website.onlineExam", compact("exams"));
    }

    /**
     * student exam test
     */
    public function onlineExamTest($id)
    {
        return view("website.onlineExamTest", compact("id"));
    }

    /**
     * online exam start
     */
    public function onlineExamStart(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name   = $request->name;
        $address = $request->address;
        $email  = $request->email;
        $phone  = $request->phone;
        $exam = AssessmentExam::with('question')->findOrFail($id);
        $question_master = $exam->question;
        $questions = AssessmentQuestion::where('assessment_question_master_id', $question_master->id)->orderBy('question_no', 'ASC')->get();
        return view('website.exam', compact('question_master', 'questions',  'name', 'address', 'email', 'phone', 'exam'));
    }

    /**
     * online exam submit
     */
    public function onlineExamSubmit(Request $request)
    {
        try {
            $test_taker = AssessmentTestTaker::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'assessment_exam_id' => $request->exam_id,
            ]);

            $answers =  $request->answer;
            foreach ($answers as $q_id => $answer) {
                AssessmentSubmittedAnswer::create([
                    'assessment_test_taker_id' => $test_taker->id,
                    'assessment_question_id' => $q_id,
                    'answer' => $request->answer[$q_id],
                ]);
            }

            return redirect()->route('website.online-exam')->with('message', 'Answer Submitted Successfully!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * result page
     */
    public function result()
    {
        $studentResult = null;
        $studentOffline = null;
        if(request()->roll) {
            $student = Student::where('roll_no_student', request()->roll)->first();
            if($student) {
                $studentResult = StudentResult::where('student_id', $student->id)
                ->where('course_title_id', $student->course_title_id)
                ->where('branch_id', $student->branch_id)
                ->first();
                $studentOffline = OfflineExamResult::select('offline_exam_results.*')->where("offline_exam_results.student_id", $student->id)
                ->where("enrollments.course_title_id", $student->course_title_id)
                ->join("enrollments", "enrollments.id", "offline_exam_results.enrollment_id")
                ->first();
            }
            
        }
        return view("website.result", compact('studentResult', 'studentOffline'));
    }

    /**
     * center registration page
     */
    public function centerRegistration()
    {
        return view("website.centerRegistration");
    }

    /**
     * blog page
     */
    public function blog()
    {
        $blogs = Blog::where('status', 1)->get();
        return view("website.blog", compact("blogs"));
    }

    /**
     * blog detail page
     */
    public function blogDetail($id)
    {
        $blog = Blog::findOrFail($id);
        return view("website.blogDetail", compact("blog"));
    }

    /**
     * contact us
     */
    public function contactUs()
    {
        return view("website.contact");
    }

    /**
     * notice page
     */
    public function notice()
    {
        $notices = Notice::where('status', 1)->where("branch_id", $this->branch_id)->limit(2)->paginate(10);
        return view("website.notice", compact("notices"));
    }

    /**
     * notice details
     */
    public function noticeDetails($id)
    {
        $notice = Notice::findOrFail($id);
        return view("website.noticeDetails", compact("notice"));
    }

}
