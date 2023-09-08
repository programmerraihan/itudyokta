<?php

namespace App\Http\Controllers\Admin\Sms;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\SmsModel;
use App\Models\BranchSMS;
use App\Models\Enrollment;
use App\Models\StudentFee;
use App\Models\CourseTitle;
use App\Models\StudentUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SmsSendController extends Controller
{
    public function index()
    {
        return view('admin.admin.sms.send', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $session_id = $request->session_id?? null;
        $branch_id   = $request->branch_id?? null;
        $course_title_id  = $request->course_title_id?? null;
        $batch_id   = $request->batch_id?? null;


        $students = Enrollment::where(function ($query) use ($request) {

            if ($request->session_id && $request->session_id != 'no') {
                $query->where('session_id', $request->session_id);
            }
            if ($request->branch_id && $request->branch_id != 'no') {
                $query->where('branch_id', $request->branch_id);
            }
            if ($request->batch_id && $request->batch_id != 'no') {
                $query->where('batch_id', $request->batch_id);
            }
            if ($request->course_title_id && $request->course_title_id != 'no') {
                $query->where('course_title_id', $request->course_title_id);
            }
        })
            ->with('student')
            ->get();


        foreach ($students as $student) {
            $data = ([
                'name'                => $student->student->name,
                'mobile'              => $student->student->mobile,
                'email'               => $student->student->email,
                'sms'                 => $request->text,
                'date'                => $request->date,
                'student_id'          => $student->student->id,
                'session_id'          => $session_id ?? null,
                'batch_id'            => $batch_id ?? null,
                'course_title_id'     => $course_title_id ?? null,
                'branch_id'           => $branch_id ?? null,

            ]);

            SmsModel::create($data);

            if ($student) {
                $sms_message = "{$request->text}";
                send_sms($student->student->mobile, $sms_message);
                $exception = [
                    'success' => 'Student Create Successfully',
                    'sms'     => $sms_message
                ];
            } else {
                $exception = ['error' => 'Database Error Found'];
            }
        }
        // die();
        return Redirect::back()->with('message', 'Our sms send  successfully');
    }





    public function singleIndex()
    {
        return view('admin.admin.sms.send-single', [
            'students' => Student::where('status', 1)->get(),
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
        ]);
    }

    public function singleStore(Request $request)
    {
        $session_id       = $request->session_id;
        $branch_id        = $request->branch_id;
        $course_title_id  = $request->course_title_id;
        $batch_id         = $request->batch_id;

        // $student_id       = $request->student_id;
        $students = Enrollment::where(function ($query) use ($request) {

            if ($request->session_id && $request->session_id != 'no') {
                $query->where('session_id', $request->session_id);
            }
            if ($request->branch_id && $request->branch_id != 'no') {
                $query->where('branch_id', $request->branch_id);
            }
            if ($request->batch_id && $request->batch_id != 'no') {
                $query->where('batch_id', $request->batch_id);
            }
            if ($request->course_title_id && $request->course_title_id != 'no') {
                $query->where('course_title_id', $request->course_title_id);
            }
        })
            ->whereIn('student_id', $request->student_id)
            ->with('student')
            ->get();



        // dd($students);

        foreach ($students as $student) {
            $data = ([
                'name'                => $student->student->name,
                'mobile'              => $student->student->mobile,
                'email'               => $student->student->email,
                'sms'                 => $request->text,
                'date'                => $request->date,
                'student_id'          => $student->student->id,
                'session_id'          => $session_id,
                'batch_id'            => $batch_id,
                'course_title_id'     => $course_title_id,
                'branch_id'           => $branch_id,

            ]);
     

            //for sms 
            if ($student) {
                $sms_message = "{$request->text}";
                send_sms($student->student->mobile, $sms_message);
                $exception = [
                    'success' => 'Student Create Successfully',
                    'sms'     => $sms_message
                ];
            } else {
                $exception = ['error' => 'Database Error Found'];
            }
        }
      
        return Redirect::back()->with('message', 'Our sms send  successfully');
    }

    public function show()
    {
        $sms = SmsModel::all();
        return view('admin.admin.sms.show', compact('sms'));
        // dd($sms);
    }


    public function branchSms()
    {
        return view('admin.admin.sms.branch-sms', [
            // 'batches' => Batch::where('status', 1)->get(),
        ]);
    }

    public function branchStore(Request $request)
    {
        $branches = Branch::where('status', 1)->get();

        foreach ($branches as $branch) {
            // dd($branch);

            $data = ([
                'name'                => $branch->name,
                'mobile'              => $branch->mobil,
                'email'               => $branch->email,
                'sms'                 => $request->text,
                'date'                => $request->date,
                'branch_id'           => $branch->id,
            ]);

            BranchSMS::create($data);

            if ($branch) {
                $sms_message = "{$request->text}";
                send_sms($branch->mobil, $sms_message);
                $exception = [
                    'success' => 'Student Create Successfully',
                    'sms'     => $sms_message
                ];
            } else {
                $exception = ['error' => 'Database Error Found'];
            }
        }

        return Redirect::back()->with('message', 'Our sms send  successfully');
    }

    public function branchSmsShow()
    {
        $sms = BranchSMS::all();
        return view('admin.admin.sms.branch_sms_show', compact('sms'));
        // dd($sms);
    }


    public function dueStudentSms()
    {
        return view('admin.admin.sms.due-student', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
        ]);
    }


    public function dueStore(Request $request)
    {


        $session_id = $request->session_id?? null;
        $branch_id   = $request->branch_id?? null;
        $course_title_id  = $request->course_title_id?? null;
        $batch_id   = $request->batch_id?? null;


        $students = StudentFee::where(function ($query) use ($request) {

            if ($request->session_id && $request->session_id != 'no') {
                $query->where('session_id', $request->session_id);
            }
            if ($request->branch_id && $request->branch_id != 'no') {
                $query->where('branch_id', $request->branch_id);
            }
            if ($request->batch_id && $request->batch_id != 'no') {
                $query->where('batch_id', $request->batch_id);
            }
            if ($request->course_title_id && $request->course_title_id != 'no') {
                $query->where('course_title_id', $request->course_title_id);
            }
        })
            ->with('student')
            ->get();

            // dd($students);



        foreach ($students as $student) {
            $data = ([
                'name'                => $student->student->name,
                'mobile'              => $student->student->mobile,
                'email'               => $student->student->email,
                'sms'                 => $request->text,
                'date'                => $request->date,
                'student_id'          => $student->student->id,
                'session_id'          => $session_id ?? null,
                'batch_id'            => $batch_id ?? null,
                'course_title_id'     => $course_title_id?? null,
                'branch_id'           => $branch_id ?? null,
                'due_status'         => 1,

            ]);
         

            SmsModel::create($data);

            if ($student) {
                $sms_message = "{$request->text}";
                send_sms($student->student->mobile, $sms_message);
                $exception = [
                    'success' => 'Student Create Successfully',
                    'sms'     => $sms_message
                ];
            } else {
                $exception = ['error' => 'Database Error Found'];
            }
        }
        // die();
        return Redirect::back()->with('message', 'Our sms send  successfully');
    }

    public function dueStudentShow()
    {
        $sms = SmsModel::where('due_status', 1)->get();
        return view('admin.admin.sms.show', compact('sms'));
        // dd($sms);
    }
}
