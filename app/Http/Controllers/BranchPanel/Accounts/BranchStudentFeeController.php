<?php

namespace App\Http\Controllers\BranchPanel\Accounts;

use App\Models\Bank;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\StudentFee;
use App\Models\AccountHead;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Models\AcTransaction;
use App\Models\StudentEduction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentFeeCollections;
use Illuminate\Support\Facades\Validator;

class BranchStudentFeeController extends Controller
{

    public function FeeGenerate()
    {

        $branch_id = Auth::guard('branch')->user()->id;

        return view('branch.branch-panel.accounts.student_fee_generate.index', [
            'students' => Student::where('status', 1)->where('branch_id',  $branch_id)->get(),
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id',  $branch_id)->get(),
            'branches' => Branch::where('status', 1)->where('id',  $branch_id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id',  $branch_id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id',  $branch_id)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'accountHeads' => AccountHead::where('status', 1)->get(),
        ]);
    }

    public function FeeSave(Request $request)
    {

        // dd($request->all());

        $enrollment =  Enrollment::where('student_id', $request->student_id)->orderBy('id', 'DESC')->limit(1)->first();
        $data = ([
            'session_id'             => $request->input('session_id'),
            'student_id'             => $request->input('student_id'),
            'branch_id'              => $request->input('branch_id'),
            'course_title_id'        => $request->input('course_title_id'),
            'batch_id'               => $request->input('batch_id'),
            'student_id'             => $request->input('student_id'),
            'account_head_id'        => $request->input('account_head_id'),
            'fee_date'               => $request->input('fee_date'),
            'title'                  => $request->input('title'),
            'amount'                 => $request->input('amount'),
            'due'                    => $request->input('amount'),
            'enrollment_id'          => $enrollment->id,

        ]);
        // dd($data);
        $studentFees = StudentFee::create($data);

        return redirect()->back()->with('message', 'Fees Generate Successful..!');
    }


    public function index()
    {

        $branch_id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.accounts.student_fee.index', [
            'students' => Student::where('status', 1)->where('branch_id',  $branch_id)->get(),
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id',  $branch_id)->get(),
            'branches' => Branch::where('status', 1)->where('id',  $branch_id)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id',  $branch_id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id',  $branch_id)->get(),
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

        // dd($students);

        if (count($students) > 0) {
            return response()->json($students);
        }
    }

    public function create(Request $request)
    {


        $student = Student::where('id', $request->student_id)->where('status', 1)->orderBy('id', 'DESC')->limit(1)->first();
        $banks = Bank::where('status', 1)->orderBy('id', 'DESC')->get();
        $studentEduction = StudentEduction::where('id', $request->student_id)->orderBy('id', 'DESC')->limit(1)->first();
        $fees = StudentFee::where('student_id', $request->student_id)->get();

        // dd($fees);
        return view('branch.branch-panel.accounts.student_fee.collect', compact('fees', 'student', 'studentEduction', 'banks'));
    }


    public function feeCollect(Request $request)
    {
        // return $request->all();
        // dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'bank_id' => ['required'],
                'date'    => ['required']
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            function generateNumber()
            {
                $memo_no = mt_rand(10000000, 99999999);
                if (NumberExists($memo_no)) {
                    return generateNumber();
                }
                return $memo_no;
            }

            function NumberExists($memo_no)
            {
                return StudentFeeCollections::where('memo_no', $memo_no)->exists();
            }

            $values = $request->array;

            $memo = generateNumber();
            $date = $request->input('date');

            foreach ($values as $value) {
                $fee_id = $value['fee_id'];
                $paid = $value['paid_amount'];
                $fine = $value['fine'];
                $waiver = $value['waiver'];
                $waiver_note = $value['waiver_note'];
                $fee = StudentFee::where('id', $fee_id)->first();
                // dd($fee);

                $data = ([
                    'memo_no'            => $memo,
                    'student_id'         => $fee->student_id,
                    'fee_id'             => $fee->id,
                    'session_id'         => $fee->session_id,
                    'course_title_id'    => $fee->course_title_id,
                    'branch_id'          => $fee->branch_id,
                    'schedule_id'        => $fee->schedule_id,
                    'batch_id'           => $fee->batch_id,
                    'enrollment_id'      => $fee->enrollment_id,
                    'amount'             => $fee->amount,
                    'paid'               => $paid,
                    // 'due'                => $fee->due,
                    'discount'           => $waiver,
                    'discount_note'      => $waiver_note,
                    'fine'               => $fine,
                    'fund_id'            => $request->input('bank_id'),
                    'date'               => $request->input('date'),
                    'ac_head_id'         => $request->input('account_head_id'),
                    'collection_type'    => 'after_enroll',
                    'created_by'         => 'branch',
                ]);
                // dd($data);

                if ($paid) {
                    $feeCollect = StudentFeeCollections::create($data);
                }

                // dd($feeCollect);


                $fee->update([
                    'due'       => ($fee->due - $paid - $waiver + $fine),
                    'paid'      => ($fee->paid + $paid),
                ]);

                // $data = ([
                //     'memo_no'            => $memo,
                //     'voucher_no'         => $memo,
                //     'student_id'         => $fee->student_id,
                //     'ac_head_id'         => $request->input('account_head_id'),
                //     'fund_id'            => $request->input('bank_id'),
                //     'fee_date'           => $request->input('date'),
                //     'trans_date'         => $request->input('date'),
                //     'note'               => "Student Payment Collection",
                //     'expense_person'     => "Admin",
                //     'amount'             => $paid,
                //     'entry_type'         => 1
                // ]);
                // $acTransaction = AcTransaction::create($data);

                // $request->student_id;
                $student = Student::where('id', $fee->student_id)->first();
                // dd($student->mobile);
                // $request->branch_id;
                $branch = Branch::where('id',  $fee->branch_id)->first();

                // dd($branch);


                if ($student->mobile) {
                    $sms_message = "{$branch->name} কম্পিউটার কোর্সর  বকেয়া  বাবদ আপনার , {$request->paid_amount} (Amount)টাকা পরিশোধ হয়েছে , ধন্যবাদ ";
                    send_sms($student->mobile, $sms_message);

                    $exception = [
                        'success' => 'Student Create Successfully',
                        'sms'     => $sms_message
                    ];
                } else {
                    $exception = ['error' => 'Mobile Number Not Found'];
                }
            }

            
            $memo_no = $feeCollect->memo_no;
            $memo = $feeCollect->memo_no;
            $item = StudentFeeCollections::where('memo_no', $memo_no)->with('courseTitles')->first();
            $items = StudentFeeCollections::where('memo_no', $memo_no)->with('courseTitles')->get();


            // return redirect()->back()->with('message', 'Payment Added Successful..!');
            return view('branch.branch-panel.accounts.student_fee.reset', compact('student', 'feeCollect', 'branch', 'memo', 'date','item','items'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function invoice()
    {
        $branch_id = Auth::guard('branch')->user()->id;
        DB::statement("SET SQL_MODE=''");
        $studentFee = StudentFeeCollections::where('status', 1)->where('branch_id',  $branch_id)->groupBy('memo_no')->orderBy('id', 'desc')->get();

        // dd($studentFee);
        return view('branch.branch-panel.accounts.student_fee.invoice', compact('studentFee'));
    }

    public function detail($memo_no)
    {
        $branch_id = Auth::guard('branch')->user()->id;
        $items = StudentFeeCollections::where('memo_no', $memo_no)->where('branch_id',  $branch_id)->get();
        $item = StudentFeeCollections::where('memo_no', $memo_no)->where('branch_id',  $branch_id)->first();
        $date = $item->date;
        $memo = $memo_no;
        $student =  Student::Where('status', 1)->where('id', $item->student_id)->first();
        $branch =  branch::Where('status', 1)->where('id', $item->branch_id)->first();
        return view('branch.branch-panel.accounts.student_fee.reset', compact('student', 'item', 'items', 'branch', 'memo', 'date'));
    }
}
