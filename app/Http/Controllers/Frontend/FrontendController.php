<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Bank;
use App\Models\Blog;
use App\Models\City;
use App\Models\About;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Notice;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Session;
use App\Models\Director;
use App\Models\District;
use App\Models\Division;
use App\Models\Schedule;
use App\Models\HomeSlide;
use App\Models\OurSpeech;
use App\Models\OurProject;
use App\Models\OurService;
use App\Models\AccountHead;
use App\Models\CourseTitle;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssessmentExam;
use App\Models\OurAchievement;
use App\Models\AssessmentQuestion;
use App\Models\RegistrationCenter;
use App\Models\AssessmentTestTaker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssessmentQuestionMaster;
use App\Models\AssessmentSubmittedAnswer;
use App\Models\Enrollment;
use App\Models\OfflineExamResult;
use App\Models\Student;
use App\Models\StudentResult;
use Illuminate\Support\Facades\Validator;


class FrontendController extends Controller
{


    public function index()
    {
        $speech = OurSpeech::where('status', 0)->limit(1)->first();

        $achievement = OurAchievement::where('status', 1)->limit(1)->first();
        $slider = HomeSlide::where('status', 1)->limit(3)->get();
        $projects = OurProject::where('status', 1)->limit(20)->get();
        // dd($projects);
        $services = OurService::where('status', 1)->limit(20)->get();

        $galleries = Gallery::where('status', 1)->limit(6)->get();
        $testimonials = Testimonial::where('status', 1)->limit(2)->get();
        $notices = Notice::where('status', 1)->limit(2)->get();
        $centers = RegistrationCenter::where('status', 1)->get();
        $offLineCourses = CourseTitle::where('status', 1)->where('course_type', 0)->limit(4)->get();
        $onLineCourses = CourseTitle::where('status', 1)->where('course_type', 1)->limit(4)->get();
        $freeCourses = CourseTitle::where('status', 1)->where('course_type', 2)->limit(4)->get();
        $directors = Director::where('status', 1)->where('director_type', 0)->limit(12)->get();
        $regionals = Director::where('status', 1)->where('director_type', 1)->get();
        return view(
            'frontend.index',
            compact('slider', 'speech', 'centers',  'offLineCourses', 'onLineCourses', 'freeCourses', 'projects', 'services', 'directors', 'regionals', 'galleries', 'testimonials', 'achievement', 'notices')
        );
    } //end function


    public function indexAbout()
    {
        $about = About::limit(1)->first();
        // dd( $about);
        return view('frontend.about', compact('about'));
    } //end function

    public function indexCenter()
    {
        $divisions = Division::where('status', 1)->get();
        $districts = District::where('status', 1)->get();
        $citys = City::where('status', 1)->get();
        return view('frontend.center_registration',  compact('divisions', 'districts', 'citys'));
    } //end function


    public function indexCourse()
    {
        $offLineCourses = CourseTitle::where('status', 1)->where('course_type', 0)->get();
        $onLineCourses = CourseTitle::where('status', 1)->where('course_type', 1)->get();
        $freeCourses = CourseTitle::where('status', 1)->where('course_type', 2)->get();
        return view('frontend.course', compact('offLineCourses', 'onLineCourses',  'freeCourses'));
    } //end function

    public function blogDetail($id)
    {
        $blog = Blog::where('status', 1)->where('id', $id)->first();
        // dd($service);

        return view('frontend.blog_detail', compact('blog'));
    } //end function




    public function courseDetail($id)
    {
        $course = CourseTitle::where('status', 1)->where('id', $id)->first();
        return view('frontend.course_details', compact('course'));
    } //end function

    public function serviceDetail($id)
    {
        $service = OurService::where('status', 1)->where('id', $id)->first();
        // dd($service);

        return view('frontend.service_detail', compact('service'));
    } //end function

    public function projectDetail($id)
    {
        $project = OurProject::where('status', 1)->where('id', $id)->first();
        // dd($service);

        return view('frontend.project_detail', compact('project'));
    } //end function



    public function speechDetail($id)
    {
        // dump($id);
        // die();
        $speech = OurSpeech::where('id', $id)->first();

        //dd($speech);
        return view('frontend.speech_details', compact('speech'));
    } //end function



    public function noticeDetail($id)
    {
        // dump($id);
        // die();
        $notice = Notice::where('id', $id)->first();

        // dd($notice);
        // dd($notice);
        return view('frontend.notice_details', compact('notice'));
    } //end f



    public function indexResult()
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
        return view('frontend.result', compact("studentResult", "studentOffline"));
    }

    public function resultSubmit($id)
    {
        if(request()->type == "offline") {
            $studentResult = OfflineExamResult::where('id', $id)->first();
            return  view('frontend.result_find', compact('studentResult'));
        }
        $studentResult = StudentResult::where('id', $id)->first();
        return  view('frontend.result_find', compact('studentResult'));
    }






    public function indexOnlineExam()
    {
        $exams = AssessmentExam::orderBy('id', 'DESC')
            ->get();
        return view('frontend.online-exam', compact('exams'));
    }


    public function studentExamTest($id)
    {
        $id = $id;
        // $question_master = AssessmentQuestionMaster::where('id', $id)->orderBy('id', 'DESC')->limit(1)->first();
        return view('frontend.exam-test.exam-test', compact('id'));
    }


    function assessmentQuestion(Request $request, $id)
    {
        try {
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
            return view('frontend.exam-test.assessment_question', compact('question_master', 'questions',  'name', 'address', 'email', 'phone', 'exam'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function answerSubmit(Request $request)
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

            return redirect()->route('home')->with('message', 'Answer Submitted Successfully!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }






    public function indexBlog()
    {

        $blogs = Blog::where('status', 1)->get();

        // $blogs->body = Str::limit($blogs->body, 50);
        // dd($blogs->body);

        return view('frontend.blog', compact('blogs'));
    } //end function

    public function indexContact()
    {
        return view('frontend.contact');
    } //end function






    ////////==============================Branch Frontend Controller ====================================//////////
    ////////============================== Start ====================================//////////

    public function branchIndex($slug)
    {
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;
        $branch_slug = $slug;

        $speech             = OurSpeech::where('branch_id', $branch_id)->limit(1)->first();

        $achievement        = OurAchievement::where('status', 1)->where('branch_id', $branch_id)->limit(1)->first();
        $slider             = HomeSlide::where('status', 1)->where('branch_id', $branch_id)->limit(3)->get();
        $projects           = OurProject::where('status', 1)->where('branch_id', $branch_id)->limit(16)->get();
        $services           = OurService::where('status', 1)->where('branch_id', $branch_id)->limit(4)->get();
        $galleries          = Gallery::where('status', 1)->where('branch_id', $branch_id)->limit(6)->get();
        $testimonials       = Testimonial::where('status', 1)->where('branch_id', $branch_id)->limit(2)->get();
        $notices            = Notice::where('status', 1)->where('branch_id', $branch_id)->limit(2)->get();
        // $centers            = RegistrationCenter::where('status', 1)->where('branch_id', $id)->get();
        $offLineCourses     = CourseTitle::where('status', 1)->where('course_type', 0)->where('branch_id', $branch_id)->limit(4)->get();
        $onLineCourses      = CourseTitle::where('status', 1)->where('course_type', 1)->where('branch_id', $branch_id)->limit(4)->get();
        $freeCourses        = CourseTitle::where('status', 1)->where('course_type', 2)->where('branch_id', $branch_id)->limit(4)->get();
        $directors          = Director::where('status', 1)->where('director_type', 0)->where('branch_id', $branch_id)->limit(4)->get();
        $regionals          = Director::where('status', 1)->where('director_type', 1)->where('branch_id', $branch_id)->limit(4)->get();
        return view(
            'branch.frontend.page.index',
            compact('branch_id', 'slug', 'slider', 'speech',  'offLineCourses', 'onLineCourses', 'freeCourses', 'projects', 'services', 'directors', 'regionals', 'galleries', 'testimonials', 'achievement', 'notices', 'branch_slug')
        );
    } //end function

    public function branchAbout($slug)
    {
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;

        $about = About::where('status', 1)->where('branch_id', $branch_id)->limit(1)->first();

        //     dd($about);
        // dd($about);
        // dd($branch_id);
        // $about = About::where('status', 1)
        //         ->whereIn('branch_id', function($query) use($slug){
        //             $query->select('id')                
        //             ->from(with(new Branch())->getTable())
        //             ->where('slug', $slug);
        //         })->limit(1)->first();

        return view('branch.frontend.page.about', compact('slug', 'about'));
    } //end function

    public function branchCourse($slug)
    {
        $branch_slug = $slug;
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;

        $offLineCourses = CourseTitle::where('status', 1)->where('branch_id', $branch_id)->where('course_type', 0)->get();
        $onLineCourses = CourseTitle::where('status', 1)->where('branch_id', $branch_id)->where('course_type', 1)->get();
        $freeCourses = CourseTitle::where('status', 1)->where('branch_id', $branch_id)->where('course_type', 2)->get();
        return view('branch.frontend.page.course', compact('slug', 'offLineCourses', 'onLineCourses',  'freeCourses', 'branch_slug'));
    } //end function



    public function branchContact($slug)
    {
        return view('branch.frontend.page.contact', compact('slug'));
    }

    public function branchBlog($slug)
    {
        $branch_slug = $slug;
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;

        $blogs = Blog::where('status', 1)->where('branch_id', $branch_id)->get();
        return view('branch.frontend.page.blog', compact('slug', 'branch_slug', 'blogs'));
    } //end function

    public function branchAdmission($slug)
    {

        // $branch = Branch::where('slug', $slug)->select('id')->first();
        // $branch_id = $branch->id;

        return view('branch.frontend.page.admission', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'slug' => $slug,
            'banks'         => Bank::where('status', 1)->orderBy('id', 'DESC')->get(),
            'AccountHeads'  => AccountHead::where('status', 1)->get(),
        ]);
    } //end function

    public function branchResult($slug)
    {
        // $blog = Blog::where('status', 1)->get();
        return view('branch.frontend.page.result', compact('slug'));
    } //end function

    public function branchOnlineExam($slug)
    {
        // $blog = Blog::where('status', 1)->get();
        return view('branch.frontend.page.online-exam', compact('slug'));
    } //end function












}
