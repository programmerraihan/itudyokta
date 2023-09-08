<?php

namespace App\Http\Controllers\BranchPanel\Accounts;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Expense;
use App\Models\Session;
use App\Models\Student;
use App\Models\Purchase;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\StudentFee;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Models\AcTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentFeeCollections;

class BranchReportController extends Controller
{
    // Student Fees Collection Report
    public function collectionReport()
    {

        $branch_id = Auth::guard('branch')->user()->id;

        return view('branch.branch-panel.accounts.student_collection_report.index', [
            'students' => Student::where('status', 1)->where('branch_id', $branch_id)->get(),
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $branch_id)->get(),
            'branches' => Branch::where('status', 1)->where('id', $branch_id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $branch_id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $branch_id)->get(),
            'sessions' => Session::where('status', 1)->get(),
        ]);
    }

    public function collectionGet(Request $request)
    {
        $student_id = $request->student_id;
        $fees = StudentFee::where('student_id', $request->student_id)->get();
        return view('branch.branch-panel.accounts.student_collection_report.view', compact('student_id', 'fees'));
    }

    public function collectionPrint(Request $request)
    {
        $fees = StudentFee::where('student_id', $request->student_id)->get();

        return view('branch.branch-panel.accounts.student_collection_report.print', compact('fees'));
    }





    public function procurementAll()
    {

        $branch_id = Auth::guard('branch')->user()->id;
        $purchases = Purchase::orderBy('id', 'desc')->where('branch_id', $branch_id)->with('purchaseItems')->get();
        return view('branch.branch-panel.report.procurement-all', compact('purchases'));
    }

    public function procurementReport(Request $request)
    {

        $branch_id = Auth::guard('branch')->user()->id;

        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $purchases = Purchase::whereBetween('purchase_date', [$from_date, $to_date])->where('branch_id', $branch_id)->orderBy('id', 'desc')->with('purchaseItems')->get();
        return view('branch.branch-panel.report.allreportsResult', compact('purchases'));
    }



    public function expenseAll()
    {

        $branch_id = Auth::guard('branch')->user()->id;
        $expenses = Expense::orderBy('id', 'desc')->where('branch_id', $branch_id)->get();
        return view('branch.branch-panel.report.expense-all', compact('expenses'));
    }

    public function expenseReport(Request $request)
    {
        $branch_id = Auth::guard('branch')->user()->id;
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $expenses = Expense::whereBetween('created_at', [$from_date, $to_date])->where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        return view('branch.branch-panel.report.allreportsexpense', compact('expenses'));
    }

    public function collectionReportAll()
    {

        $branch_id = Auth::guard('branch')->user()->id;

        $courseTitles = CourseTitle::where('status', 1)->get();
        $branches = Branch::where('status', 1)->where('id', $branch_id)->get();
        $batches = Batch::where('status', 1)->get();
        $schedules = Schedule::where('status', 1)->get();
        $sessions = Session::where('status', 1)->get();

        // $fees = StudentFee::where('status', 1)->get();
        // dd($fees);
        return view('branch.branch-panel.report.all_studen_report', compact('sessions', 'schedules', 'branches', 'courseTitles', 'batches'));
    }

    public function dueStudentList(Request $request)
    {

    //    dd($request);



        $org_info   = Branch::where('status', 1)->where('id',  $request->branch_id)->orderBy('id', 'DESC')->first();
        // dd($branches);
       


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
            ->orderBy('id', 'DESC')
            ->whereColumn('paid', '<', 'amount')
            ->get();

          //  dd($students);




        return view('branch.branch-panel.report.due_student_list', compact('students'));
    }


    public function draftStudent()
    {

        // $branch_id = Auth::guard('branch')->user()->id;
        $students = Student::orderBy('id', 'desc')->where('status', 1)->get();
        return view('branch.branch-panel.report.draft_student_list', compact('students'));
    }



    public function incomeAll()
    {

        $branch_id = Auth::guard('branch')->user()->id;
        $purchases = Purchase::orderBy('id', 'desc')->where('branch_id', $branch_id)->with('purchaseItems')->get();
        return view('branch.branch-panel.report.income-all', compact('purchases'));
    }

    public function incomeReport(Request $request)
    {
        $branch_id = Auth::guard('branch')->user()->id;
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $purchases = Purchase::whereBetween('purchase_date', [$from_date, $to_date])->where('branch_id', $branch_id)->orderBy('id', 'desc')->with('purchaseItems')->get();
        return view('branch.branch-panel.report.income_report', compact('purchases'));
    }
}
