<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Models\Batch;
use App\Models\Branch;
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
use App\Models\Expense;
use App\Models\StudentFeeCollections;

use function PHPUnit\Framework\returnSelf;

class ReportController extends Controller
{
    // Student Fees Collection Report
    public function collectionReport()
    {
        return view('admin.admin.accounts.student_collection_report.index', [
            'students' => Student::where('status', 1)->get(),
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
        ]);
    }

    public function collectionGet(Request $request)
    {
        $student_id = $request->student_id;
        $fees = StudentFee::where('student_id', $request->student_id)->get();
        return view('admin.admin.accounts.student_collection_report.view', compact('student_id', 'fees'));
    }

    public function collectionPrint(Request $request)
    {
        $fees = StudentFee::where('student_id', $request->student_id)->get();
        return view('admin.admin.accounts.student_collection_report.print', compact('fees'));
    }


    public function procurementAll()
    {
        $purchases = Purchase::orderBy('id', 'desc')->with('purchaseItems')->get();
        return view('admin.admin.report.procurement-all', compact('purchases'));
    }

    public function procurementReport(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $purchases = Purchase::whereBetween('purchase_date', [$from_date, $to_date])->orderBy('id', 'desc')->with('purchaseItems')->get();
        return view('admin.admin.report.allreportsResult', compact('purchases'));
    }



    public function expenseAll()
    {
        $expenses = Expense::orderBy('id', 'desc')->get();
        return view('admin.admin.report.expense-all', compact('expenses'));
    }

    public function expenseReport(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $expenses = Expense::whereBetween('created_at', [$from_date, $to_date])->orderBy('id', 'desc')->get();
        return view('admin.admin.report.allreportsexpense', compact('expenses'));
    }

    public function collectionReportAll()
    {
        $courseTitles = CourseTitle::where('status', 1)->get();
        $branches = Branch::where('status', 1)->get();
        $batches = Batch::where('status', 1)->get();
        $schedules = Schedule::where('status', 1)->get();
        $sessions = Session::where('status', 1)->get();

        // $fees = StudentFee::where('status', 1)->get();
        // dd($fees);
        return view('admin.admin.report.all_studen_report', compact('sessions', 'schedules', 'branches', 'courseTitles', 'batches'));
    }

    public function dueStudentList(Request $request)
    {

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


        return view('admin.admin.report.due_student_list', compact('students'));
    }


    public function draftStudent()
    {
        $students = Student::orderBy('id', 'desc')->where('status', 1)->get();
        return view('admin.admin.report.draft_student_list', compact('students'));
    }



    public function incomeAll()
    {
        $purchases = Purchase::orderBy('id', 'desc')->with('purchaseItems')->get();
        return view('admin.admin.report.income-all', compact('purchases'));
    }

    public function incomeReport(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $purchases = Purchase::whereBetween('purchase_date', [$from_date, $to_date])->orderBy('id', 'desc')->with('purchaseItems')->get();
        return view('admin.admin.report.income_report', compact('purchases'));
    }
}
