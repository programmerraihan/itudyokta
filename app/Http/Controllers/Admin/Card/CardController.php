<?php

namespace App\Http\Controllers\Admin\Card;

use App\Models\Unit;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\CourseTitle;
use App\Models\StudentUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OfflineExamResult;
use App\Models\Student;
use App\Models\StudentResult;

class CardController extends Controller
{
    public function add()
    {
        return view('admin.card.add-card', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->get(),
        ]);
    }

    public function IdCardGenerate(Request $request)
    {
        // return $request->all();
        $org_info = Branch::where('status', 1)
            ->where('id', $request->branch_id)
            ->orderBy('id', 'DESC')
            ->first();
        // dd($branches);
        $session_id = $request->session_id;
        $branch_id = $request->branch_id;
        $course_title_id = $request->course_title_id;
        $batch_id = $request->batch_id;

        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();
        // dd($students);
        return view('admin.card.print-id-card', compact('students', 'org_info'));
    }

    public function addAdmit()
    {
        return view('admin.card.add-admit-card', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->get(),
        ]);
    }

    public function admitCardGenerate(Request $request)
    {
        // return $request->all();
        $org_info = Branch::where('status', 1)
            ->where('id', $request->branch_id)
            ->orderBy('id', 'DESC')
            ->first();
        // dd($branches);
        $session_id = $request->session_id;
        $branch_id = $request->branch_id;
        $course_title_id = $request->course_title_id;
        $batch_id = $request->batch_id;

        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();
        // dd($students);
        return view('admin.card.print-admit-card', compact('students', 'org_info'));
    }

    public function addRegistration()
    {
        return view('admin.card.add-registration-card', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->get(),
        ]);
    }

    public function registrationCardGenerate(Request $request)
    {
        $org_info = Branch::where('status', 1)
            ->where('id', $request->branch_id)
            ->orderBy('id', 'DESC')
            ->first();
        $session_id = $request->session_id;
        $branch_id = $request->branch_id;
        $course_title_id = $request->course_title_id;
        $batch_id = $request->batch_id;

        $students = Enrollment::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->with('student')
            ->get();
        return view('admin.card.print-registration-card', compact('students', 'org_info'));
    }

    public function addCertificate()
    {
        $studentResults = null;
        $offlineResult = null;
        if (request()->filter) {
            $search = request()->search;
            $studentResults = StudentResult::with('student')
                ->whereIn('student_id', function ($query) use ($search) {
                    $query
                        ->select('id')
                        ->from('students')
                        ->where('name', 'LIKE', $search . '%')
                        ->orWhere('mobile', 'LIKE', $search . '%')
                        ->orWhere('roll_no_student', 'LIKE', $search . '%')
                        ->orWhere('reg_no_student', 'LIKE', $search . '%');
                })
                ->get();
            $offlineResult = OfflineExamResult::with('student')
                ->whereIn('student_id', function ($query) use ($search) {
                    $query
                        ->select('id')
                        ->from('students')
                        ->where('name', 'LIKE', $search . '%')
                        ->orWhere('mobile', 'LIKE', $search . '%')
                        ->orWhere('roll_no_student', 'LIKE', $search . '%')
                        ->orWhere('reg_no_student', 'LIKE', $search . '%');
                })
                ->get();
        }
        return view('admin.card.add-certificate-card', compact('studentResults', 'offlineResult'));
    }

    public function printCertificate($id)
    {
        if(request()->type == "online") {
            $studentResult = StudentResult::with(['student'])
            ->where('id', $id)
            ->first();
        }
        if(request()->type == "offline") {
            $studentResult = OfflineExamResult::with(['student'])
            ->where('id', $id)
            ->first();
        }
        
        return view('admin.card.certificate', compact('studentResult'));
    }

    public function certificateCardGenerate(Request $request)
    {
        $search = $request->search;

        $student = Student::where('name', 'LIKE', $search . '%')
            ->orWhere('mobile', 'LIKE', $search . '%')
            ->orWhere('roll_no_student', 'LIKE', $search . '%')
            ->orWhere('reg_no_student', 'LIKE', $search . '%')
            ->first();

        if (!$student) {
            abort(404);
        }

        $org_info = Branch::where('status', 1)
            ->where('id', $student->branch_id)
            ->orderBy('id', 'DESC')
            ->first();
        $session_id = $student->session_id;
        $branch_id = $student->branch_id;
        $course_title_id = $student->course_title_id;
        $batch_id = $student->batch_id;

        $results = StudentResult::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->get();

        return view('admin.card.print-certificate-card', compact('results', 'org_info'));
    }

    public function addTestimonial()
    {
        return view('admin.card.add-testimonial-card', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->get(),
        ]);
    }

    public function testimonialCardGenerate(Request $request)
    {
        $org_info = Branch::where('status', 1)
            ->where('id', $request->branch_id)
            ->orderBy('id', 'DESC')
            ->first();
        $session_id = $request->session_id;
        $branch_id = $request->branch_id;
        $course_title_id = $request->course_title_id;
        $batch_id = $request->batch_id;

        $results = StudentResult::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            ->get();
        return view('admin.card.print-testimonial-card', compact('results', 'org_info'));
    }

    public function addMarkSheet()
    {
        return view('admin.card.add-markSheet-card', [
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'units' => StudentUnit::where('status', 1)->get(),
        ]);
    }

    public function markSheetCardGenerate(Request $request)
    {
        // return $request->all();

        $org_info = Branch::where('status', 1)
            ->where('id', $request->branch_id)
            ->orderBy('id', 'DESC')
            ->first();
        // dd($org_info);
        $session_id = $request->session_id;
        $branch_id = $request->branch_id;
        $course_title_id = $request->course_title_id;
        $batch_id = $request->batch_id;

        $results = StudentResult::where('session_id', $session_id)
            ->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->where('batch_id', $batch_id)
            // ->with('student')
            ->get();

        // dd($students);

        // dd($students->grade);
        return view('admin.card.print-markSheet-card', compact('results', 'org_info'));
    }
}
