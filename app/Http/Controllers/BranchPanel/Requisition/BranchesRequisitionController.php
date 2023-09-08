<?php

namespace App\Http\Controllers\BranchPanel\Requisition;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\CourseTitle;
use App\Models\Requisition;
use App\Models\StudentUnit;
use Illuminate\Http\Request;
use App\Models\RequisitionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesRequisitionController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.requisition.index', [
            'students' => Student::where('status', 1)->get(),
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->where('id', $id)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
        ]);
    }

    public function getStudents(Request $request)
    {
        // dd($request->all());
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
            if ($request->course_id && $request->course_id != 'no') {
                $query->where('course_title_id', $request->course_id);
            }
        })
            ->with('student')
            ->get();

        return view('branch.branch-panel.requisition.student', compact('students'));
    }

    public function store(Request $request)
    {
        try {
            $data = ([
                'branch_id'          => $request->branch_id,
                'session_id'         => $request->session_id,
                'course_title_id'    => $request->course_title_id,
                'batch_id'           => $request->batch_id,
                'date'               => date('Y-m-d'),
                'text'               => $request->text,
            ]);
            $requisition = Requisition::create($data);
            $students = $request->student;
            foreach ($students as $student) {

                $data = ([
                    'requisition_id'   => $requisition->id,
                    'student_id'        => $student,
                ]);
                RequisitionDetail::create($data);
            }
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function show()
    {

        $branch_id = Auth::guard('branch')->user()->id;
        $requisition = Requisition::where('status', 1)->with('requisitionDetail')->where('branch_id',  $branch_id)->get();
        return view('branch.branch-panel.requisition.show', compact('requisition'));
    }

    public function detail($id)
    {

        $branch_id = Auth::guard('branch')->user()->id;
        $requisition = Requisition::with('requisitionDetail')->where('branch_id',  $branch_id)->get()->find($id);
        // dd($requisition);
        return view('branch.branch-panel.requisition.detail', compact('requisition'));
    }

    public function complete()
    {

        $branch_id = Auth::guard('branch')->user()->id;
        $requisition = Requisition::where('status', 0)->where('branch_id',  $branch_id)->with('requisitionDetail')->get();
        return view('branch.branch-panel.requisition.complete', compact('requisition'));
    }
}
