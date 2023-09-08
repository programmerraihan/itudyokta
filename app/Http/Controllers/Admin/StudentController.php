<?php

namespace App\Http\Controllers\Admin;


use PDF;
use File;
use Carbon\Carbon;
use App\Models\Bank;
use App\Models\Batch;
use Dotenv\Validator;
use App\Models\Branch;
use App\Models\Session;

use App\Models\Student;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\StudentFee;
use App\Models\AccountHead;
use App\Models\CourseTitle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AcTransaction;
use App\Models\StudentEduction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\StudentFeeCollections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{

    public function coursePrice(Request $request)
    {
        $id = $request->id;
        $course = CourseTitle::where('id', $id)->select('price', 'offer_price')->first();
        return response()->json($course);
    }

    public function coursesBatch(Request $request)
    {
        $batches = Batch::where('status', 1)->where('course_title_id', $request->course_title_id)->get();
        return response()->json($batches);
    }

    public function branchCourses(Request $request)
    {
        $course = CourseTitle::where('status', 1)->where('branch_id', $request->branch_id)->get();
        return response()->json($course);
    }




    public function batchSchedule(Request $request)
    {
        $schedules = Schedule::where('status', 1)->where('batch_id', $request->id)->get();
        return response()->json($schedules);
    }

    public function generatePDF()
    {
        // $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        // dd($data);
        // $pdf = PDF::loadView('myPDF', $data);
        // return $pdf->download('itsolutionstuff.pdf');
    }



    public function index()
    {
        return view('student.login');
    }

    public function dashboard()
    {
        return view('student.index')->with('message', 'Plz login first');
    }


    public function login(Request $request)
    {
        $check = $request->all();
        $student = Student::where('mobile', $request->mobile)->first();
        if($student && $student->status == 0) {
            return redirect()->back()->with('error', 'You are pending now!');
        }
        if (Auth::guard('student')->attempt(['mobile' => $check['mobile'], 'password' => $check['password']])) {
            return redirect('student/dashboard')->with('error', 'Student Login Successfully ');
        } else {
            return back()->with('error', 'Invalid Mobile or Password');
        }
    }

    public function studentLogout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('login_from_student')->with('error', 'Student Logout Successfully ');
    }

    public function studentRegister()
    {
        return view('student.student_register');
    }

    public function studentRegisterCreate(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:students,email'],
        ]);

        Student::insert([
            'name'                      => $request->name,
            'email'                     => $request->email,
            'password'                  => Hash::make($request->password),
            'remember_token'            => Str::random(10),
            'email_verified_at'         => now(),
            'created_at'                => Carbon::now(),
        ]);
        return redirect()->route('login_from_student')->with('error', 'Student Created Successfully ');
    }



    public function addStudent()
    {
        return view('admin.student.add', [
            'courseTitles'  => CourseTitle::where('status', 1)->get(),
            'branches'      => Branch::where('status', 1)->get(),
            'batches'       => Batch::where('status', 1)->get(),
            'schedules'     => Schedule::where('status', 1)->get(),
            'sessions'      => Session::where('status', 1)->get(),
            'banks'         => Bank::where('status', 1)->orderBy('id', 'DESC')->get(),
            'AccountHeads'  => AccountHead::where('status', 1)->get(),
        ]);
    }



    public function storeFrontend(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'mobile' => ['required', 'unique:students,mobile'],
        ]);

        try {
            DB::beginTransaction();
            $student = new Student();

            $student->raw_password            = $request->password;
            $student->password            = Hash::make($request->password);
            $student->remember_token      = Str::random(10);
            $student->email_verified_at   = now();
            $student->created_at          = Carbon::now();

            $student->name                       = $request->name;
            $student->email                      = $request->email;

            $student->father_name                = $request->father_name;
            $student->mother_name                = $request->mother_name;
            $student->present_address            = $request->present_address;
            $student->permanent_address          = $request->permanent_address;

            $student->date_of_birth              = $request->date_of_birth;
            $student->mobile                     = $request->mobile;
            $student->gender                     = $request->gender;
            $student->religion                   = $request->religion;
            $student->nationality                = $request->nationality;

            // $student->reg_no_student             = $request->reg_no_student;
            // $student->roll_no_student            = $request->roll_no_student;

            $student->course_title_id              = $request->course_title_id;
            $student->branch_id                    = $request->branch_id;

            //other
            $student->status                     = 0;
            $student->student_status             = 0;

            // Documents
            if ($request->hasFile('director')) {
                $file = $request->file('director');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/director/', $filename);
                $student->director = $filename;
            }


            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/student/', $filename);
                $student->image = $filename;
            }

            if ($request->hasFile('nid')) {
                $file = $request->file('nid');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/nid/', $filename);
                $student->nid = $filename;
            }

            if ($request->hasFile('certificate')) {
                $file = $request->file('certificate');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/certificate/', $filename);
                $student->certificate = $filename;
            }

            if ($request->hasFile('signature')) {
                $file = $request->file('signature');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/signature/', $filename);
                $student->signature = $filename;
            }
            $student->save();


            //Academic Information
            $academicInfo = new StudentEduction();

            $academicInfo->student_id                = $student->id;
            $academicInfo->board_name                = $request->board_name;
            $academicInfo->roll_no                   = $request->roll_no;
            $academicInfo->reg_no                    = $request->reg_no;
            $academicInfo->year                      = $request->year;
            $academicInfo->last_education_board      = $request->last_education_board;
            $academicInfo->last_education_roll       = $request->last_education_roll;
            $academicInfo->last_education_reg        = $request->last_education_reg;
            $academicInfo->last_education_year       = $request->last_education_year;
            $academicInfo->save();

            $course = CourseTitle::where('id', $request->course_title_id)->select('price', 'offer_price')->first();
            if ($course->offer_price) {
                $price = $course->offer_price;
            } else {
                $price = $course->price;
            }
            //Enrollment
            $enrollment = new Enrollment();
            $enrollment->student_id               = $student->id;
            $enrollment->course_title_id          = $request->course_title_id;
            $enrollment->session_id               = $request->session_id;
            $enrollment->branch_id                = $request->branch_id;
            $enrollment->batch_id                 = $request->batch_id;
            $enrollment->schedule_id              = $request->schedule_id;

            $enrollment->course_start_date        = $request->course_start_date;
            $enrollment->price                    = $price;
            $enrollment->payable_amount           = $request->payable_amount;
            $enrollment->due_amount               = $request->due_amount;
            $enrollment->next_due_date            = $request->next_due_date;
            $enrollment->save();

            //Student Fee
            $fee = new StudentFee();
            $fee->student_id               = $student->id;
            $fee->course_title_id          = $request->course_title_id;
            $fee->enrollment_id            = $enrollment->id;
            $fee->session_id               = $request->session_id;
            $fee->branch_id                = $request->branch_id;
            $fee->batch_id                 = $request->batch_id;
            $fee->amount                   = $price;
            $fee->paid                     = $request->payable_amount;
            $fee->due                      = $request->due_amount;
            $fee->title                    = 'Course Fee Generate';
            $fee->account_head_id          = $request->account_head_id;
            $fee->fee_date                 = $request->course_start_date;
            $fee->next_due_date            = $request->next_due_date;
            $fee->save();


            if ($request->payable_amount) {
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
                $memo = generateNumber();

                $data = ([
                    'memo_no'            => $memo,
                    'student_id'         => $student->id,
                    'fee_id'             => $fee->id,
                    'branch_id'          => $fee->branch_id,

                    'session_id'         => $fee->session_id,
                    'course_title_id'    => $fee->course_title_id,
                    'schedule_id'        => $fee->schedule_id,
                    'batch_id'           => $fee->batch_id,
                    'enrollment_id'      => $fee->enrollment_id,
                    'amount'             => $price,
                    'paid'               => $request->payable_amount,
                    'due'                => $price - $request->payable_amount,
                    'fund_id'            => $request->input('bank_id'),
                    'date'               => date('Y-m-d'),
                    'ac_head_id'         => $request->input('account_head_id'),
                    'collection_type'    => 'when_enroll',
                ]);

                $feeCollect = StudentFeeCollections::create($data);
            }

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            abort($exception->getMessage());
        }

        
        $message = optional($student->Branch)->name . ", এর কম্পিউটার ট্রেনিং কোর্সে আপনার অনলাইন রেজিস্ট্রেশন সম্পন্ন হয়েছে, User Name: ".$student->mobile." Password: " .$request->password . " আপনার লগিন " . route('login_from_student') . '';
        send_sms($request->mobile, $message, $request->branch_id);
        // $requestData = [
        //     'full_name'    => $request->name,
        //     'email'        => $request->email,
        //     'amount'       => $request->payable_amount,
        //     'metadata'     => [
        //         'order_id'   => $memo,
        //         'metadata_1' => 'foo',
        //         'metadata_2' => 'bar',
        //     ],
        //     'redirect_url' => route('uddoktapay.success'),
        //     'cancel_url'   => route('uddoktapay.cancel'),
        //     'webhook_url'  => 'http://coxs.test',
        // ];

        // $paymentUrl = init_payment($requestData);
        // return redirect($paymentUrl);

        // return Redirect::route('uddoktapay.pay');
        // Auth::guard('student')->login($student);
        return redirect()->route('home');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'mobile' => ['required', 'unique:students,mobile'],
        ]);
        try {
            DB::beginTransaction();
            $student = new Student();

            $student->raw_password            = $request->password;
            $student->password            = Hash::make($request->password);
            $student->remember_token      = Str::random(10);
            $student->email_verified_at   = now();
            $student->created_at          = Carbon::now();

            $student->name                       = $request->name;
            $student->email                      = $request->email;

            $student->father_name                = $request->father_name;
            $student->mother_name                = $request->mother_name;
            $student->present_address            = $request->present_address;
            $student->permanent_address          = $request->permanent_address;

            $student->date_of_birth              = $request->date_of_birth;
            $student->mobile                     = $request->mobile;
            $student->gender                     = $request->gender;
            $student->religion                   = $request->religion;
            $student->nationality                = $request->nationality;

            $student->reg_no_student             = $request->reg_no_student;
            $student->roll_no_student            = $request->roll_no_student;

            $student->course_title_id              = $request->course_title_id;
            $student->branch_id                    = $request->branch_id;

            //other
            $student->status                     = 0;
            $student->student_status             = 0;

            // Documents
            if ($request->hasFile('director')) {
                $file = $request->file('director');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/director/', $filename);
                $student->director = $filename;
            }


            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/student/', $filename);
                $student->image = $filename;
            }

            if ($request->hasFile('nid')) {
                $file = $request->file('nid');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/nid/', $filename);
                $student->nid = $filename;
            }

            if ($request->hasFile('certificate')) {
                $file = $request->file('certificate');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/certificate/', $filename);
                $student->certificate = $filename;
            }

            if ($request->hasFile('signature')) {
                $file = $request->file('signature');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/signature/', $filename);
                $student->signature = $filename;
            }
            $student->save();


            //Academic Information
            $academicInfo = new StudentEduction();

            $academicInfo->student_id                = $student->id;
            $academicInfo->board_name                = $request->board_name;
            $academicInfo->roll_no                   = $request->roll_no;
            $academicInfo->reg_no                    = $request->reg_no;
            $academicInfo->year                      = $request->year;
            $academicInfo->last_education_board      = $request->last_education_board;
            $academicInfo->last_education_roll       = $request->last_education_roll;
            $academicInfo->last_education_reg        = $request->last_education_reg;
            $academicInfo->last_education_year       = $request->last_education_year;
            $academicInfo->save();

            $course = CourseTitle::where('id', $request->course_title_id)->select('price', 'offer_price')->first();
            if ($course->offer_price) {
                $price = $course->offer_price;
            } else {
                $price = $course->price;
            }
            //Enrollment
            $enrollment = new Enrollment();
            $enrollment->student_id               = $student->id;
            $enrollment->course_title_id          = $request->course_title_id;
            $enrollment->session_id               = $request->session_id;
            $enrollment->branch_id                = $request->branch_id;
            $enrollment->batch_id                 = $request->batch_id;
            $enrollment->schedule_id              = $request->schedule_id;

            $enrollment->course_start_date        = $request->course_start_date;
            $enrollment->price                    = $price;
            $enrollment->payable_amount           = $request->payable_amount;
            $enrollment->due_amount               = $request->due_amount;
            $enrollment->next_due_date            = $request->next_due_date;
            $enrollment->save();

            // dd($request->bank_id);

            // $accountHead = AccountHead::where('status', 1)->first();
            //Student Fee
            $fee = new StudentFee();
            $fee->student_id               = $student->id;
            $fee->course_title_id          = $request->course_title_id;
            $fee->enrollment_id            = $enrollment->id;
            $fee->session_id               = $request->session_id;
            $fee->branch_id                = $request->branch_id;
            $fee->batch_id                 = $request->batch_id;
            $fee->amount                   = $price;
            $fee->paid                     = $request->payable_amount;
            $fee->due                      = $request->due_amount;
            $fee->title                    = 'Course Fee Generate';
            $fee->account_head_id          = $request->account_head_id;
            $fee->fee_date                 = $request->course_start_date;
            $fee->next_due_date            = $request->next_due_date;
            $fee->save();


            if ($request->payable_amount) {
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
                $memo = generateNumber();

                $data = ([
                    'memo_no'            => $memo,
                    'student_id'         => $student->id,
                    'fee_id'             => $fee->id,
                    'branch_id'          => $fee->branch_id,

                    'session_id'         => $fee->session_id,
                    'course_title_id'    => $fee->course_title_id,
                    'schedule_id'        => $fee->schedule_id,
                    'batch_id'           => $fee->batch_id,
                    'enrollment_id'      => $fee->enrollment_id,
                    'amount'             => $price,
                    'paid'               => $request->payable_amount,
                    'due'                => $price - $request->payable_amount,
                    'fund_id'            => $request->input('bank_id'),
                    'date'               => date('Y-m-d'),
                    'ac_head_id'         => $request->input('account_head_id'),
                    'collection_type'    => 'when_enroll',
                ]);
                $feeCollect = StudentFeeCollections::create($data);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
        $branch = Branch::findOrFail($request->branch_id);
        $date = date('Y-m-d');
        return view('admin.student.money_receipt', compact('student', 'feeCollect', 'branch', 'memo', 'date'));
    }



    public function show()
    {
        return view('admin.student.index', [
            'students' => Student::orderBy('id', 'desc')->where('status', 1)->with('StudentEduction', 'Enrollment')->get(),
        ]);
    }

    public function pending()
    {
        return view('admin.student.indexPanding', [
            'students' => Student::orderBy('id', 'desc')->where('status', 0)->with('StudentEduction', 'Enrollment')->get(),
        ]);
    }



    public function download($id)
    {
        //  dd($id);

        // $students = Student::orderBy('id', 'desc')->find($id);
        // //dd($student);

        // $files = [];
        // foreach ($students as $i => $student) {
        //    // dd($student);
        //      $files[$student->id] =  src="{{ asset('admin/image/student/' . $student->image) }}";

        // }

        //   dd($files);



        // src="{{ asset('admin/image/student/' . $student->image) }}"

        // $portfolioImages = PortfolioImage::where('portfolio_id',$id)->get();
        // $files = [];
        // foreach ($portfolioImages as $i => $portfolioImage) {
        //     $files[$portfolioImage->id] = public_path(). $portfolioImage->image_path;

        // }

        // // dd($files);

        // $portfolio  = Portfolio::find($id);
        // $folderName = $portfolio->id.'-'.str_replace(' ', '-',$portfolio->name);
        // $zip        = new ZipArchive;
        // $zipFile    = public_path().'/assets/fe/img/portfolio/'.$folderName.'/'.$folderName.'.zip';

        // if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE)
        // {

        //     //add files into a zip
        //     foreach ($files as $key => $value) {

        //         //replace word "full" with $portfolioImage->id
        //         $relativeNameInZipFile = str_replace('full',$key,basename($value));
        //         $zip->addFile($value, $relativeNameInZipFile);
        //     }

        //     $zip->close();
        // }

        // return response()->download($zipFile);
    }



    public function edit($id)
    {
        return view('admin.student.edit', [
            'student' =>     Student::with('studentEduction', 'enrollment', 'studentFee', 'acTransaction')->with('studentFeeCollections',  function ($q) {
                $q->where(['collection_type' => 'when_enroll']);
            })->find($id),
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'banks' => Bank::where('status', 1)->orderBy('id', 'DESC')->get(),
            'AccountHeads'  => AccountHead::where('status', 1)->get(),
        ]);
    }

    public function detail($id)
    {
        return view('admin.student.detail', [
            'student' =>     Student::with('StudentEduction', 'Enrollment', 'StudentFee', 'AcTransaction')->find($id),
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
        ]);
    } //End Method



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'mobile' => ['required', 'unique:students,mobile,'.$id],
        ]);

        DB::beginTransaction();
        try {

            $student = Student::find($id);

            if($request->password) {
                $student->raw_password                   = $request->password;
                $student->password                   = Hash::make($request->password);
            }
            $student->remember_token             = Str::random(10);
            $student->email_verified_at          = now();
            $student->created_at                 = Carbon::now();

            $student->name                       = $request->name;
            $student->email                      = $request->email;

            $student->father_name                = $request->father_name;
            $student->mother_name                = $request->mother_name;
            $student->present_address            = $request->present_address;
            $student->permanent_address          = $request->permanent_address;

            $student->date_of_birth              = $request->date_of_birth;
            $student->mobile                     = $request->mobile;
            $student->gender                     = $request->gender;
            $student->religion                   = $request->religion;
            $student->nationality                = $request->nationality;

            $student->reg_no_student             = $request->reg_no_student;
            $student->roll_no_student            = $request->roll_no_student;

            $student->course_title_id            = $request->course_title_id;
            $student->branch_id                  = $request->branch_id;

            // dd($student);

            //other
            $student->status                     = 1;
            $student->student_status             = 0;

            // Documents
            if ($request->hasFile('director')) {

                $destination = 'admin/image/director/' . $student->director;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('director');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/director/', $filename);
                $student->director = $filename;
            }


            if ($request->hasFile('image')) {

                $destination = 'admin/image/student/' . $student->image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/student/', $filename);
                $student->image = $filename;
            }

            if ($request->hasFile('nid')) {


                $destination = 'admin/image/nid/' . $student->nid;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('nid');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/nid/', $filename);
                $student->nid = $filename;
            }

            if ($request->hasFile('certificate')) {


                $destination = 'admin/image/certificate/' . $student->certificate;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('certificate');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/certificate/', $filename);
                $student->certificate = $filename;
            }

            if ($request->hasFile('signature')) {


                $destination = 'admin/image/signature/' . $student->signature;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('signature');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/image/signature/', $filename);
                $student->signature = $filename;
            }
            $student->save();

            //Student Eduction
            $studentEdu = StudentEduction::where('student_id', $id)->first();

            $academicInfo = StudentEduction::find($studentEdu->id);

            $academicInfo->student_id                = $student->id;
            $academicInfo->board_name                = $request->board_name;
            $academicInfo->roll_no                   = $request->roll_no;
            $academicInfo->reg_no                    = $request->reg_no;
            $academicInfo->year                      = $request->year;
            $academicInfo->last_education_board      = $request->last_education_board;
            $academicInfo->last_education_roll       = $request->last_education_roll;
            $academicInfo->last_education_reg        = $request->last_education_reg;
            $academicInfo->last_education_year       = $request->last_education_year;
            $academicInfo->save();

            $course = CourseTitle::where('id', $request->course_title_id)->select('price', 'offer_price')->first();
            if ($course->offer_price) {
                $price = $course->offer_price;
            } else {
                $price = $course->price;
            }

            $enrollment = Enrollment::where('student_id', $id)->first();

            $pre_due = $enrollment->due_amount;
            $pre_paid = $enrollment->payable_amount;


            $enrollment->student_id               = $student->id;
            $enrollment->course_title_id          = $request->course_title_id;
            $enrollment->session_id               = $request->session_id;
            $enrollment->branch_id                = $request->branch_id;
            $enrollment->batch_id                 = $request->batch_id;
            $enrollment->schedule_id              = $request->schedule_id;

            $enrollment->course_start_date        = $request->course_start_date;
            $enrollment->price                    = $price;
            $enrollment->payable_amount           = $request->payable_amount;
            $enrollment->due_amount               = $request->due_amount;
            $enrollment->next_due_date            = $request->next_due_date;
            $enrollment->save();

            //Student Fee 


            if ($pre_due > $request->due_amount) {
                $due = $request->due_amount - $pre_due;
            } elseif ($pre_due < $request->due_amount) {
                $due = $request->due_amount - $pre_due;
            } else {
                $due = 0;
            }

            if ($pre_paid > $request->payable_amount) {
                $paid = $request->payable_amount - $pre_paid;
            } elseif ($pre_paid < $request->payable_amount) {
                $paid = $request->payable_amount - $pre_paid;
            } else {
                $paid = 0;
            }

            $fee = StudentFee::where('student_id', $id)->first();

            $fee->student_id               = $student->id;
            $fee->course_title_id          = $request->course_title_id;
            $fee->enrollment_id            = $enrollment->id;
            $fee->session_id               = $request->session_id;
            $fee->branch_id                = $request->branch_id;
            $fee->batch_id                 = $request->batch_id;
            $fee->amount                   = $price;
            $fee->paid                     = $fee->paid + $paid;
            $fee->due                      = $fee->due + $due;
            $fee->title                    = 'Course Fee Generate';
            $fee->account_head_id          = $request->account_head_id;
            $fee->fee_date                 = $request->course_start_date;
            $fee->next_due_date            = $request->next_due_date;
            $fee->save();

            if ($request->payable_amount) {
                $feeCollect = StudentFeeCollections::where('collection_type', 'when_enroll')->where('student_id', $student->id)->first();
                if ($feeCollect) {
                    $feeCollect->update([
                        'session_id'         => $fee->session_id,
                        'course_title_id'    => $fee->course_title_id,
                        'schedule_id'        => $fee->schedule_id,
                        'batch_id'           => $fee->batch_id,
                        'branch_id'          =>  $fee->branch_id,

                        'enrollment_id'      => $fee->enrollment_id,
                        'amount'             => $price,
                        'paid'               => $request->payable_amount,
                        'due'                => $price - $request->payable_amount,
                        'fund_id'            => $request->input('bank_id'),
                        'date'               => date('Y-m-d'),
                        'ac_head_id'         => $request->input('account_head_id'),
                    ]);
                } else {
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
                    $memo = generateNumber();

                    $data = ([
                        'memo_no'            => $memo,
                        'student_id'         => $student->id,
                        'fee_id'             => $fee->id,
                        'session_id'         => $fee->session_id,
                        'course_title_id'    => $fee->course_title_id,
                        'branch_id'          => $fee->branch_id,
                        'schedule_id'        => $fee->schedule_id,
                        'batch_id'           => $fee->batch_id,
                        'enrollment_id'      => $fee->enrollment_id,
                        'amount'             => $price,
                        'paid'               => $request->payable_amount,
                        'due'                => $price - $request->payable_amount,
                        'fund_id'            => $request->input('bank_id'),
                        'date'               => date('Y-m-d'),
                        'ac_head_id'         => $request->input('account_head_id'),
                        'collection_type'    => 'when_enroll',
                    ]);

                    StudentFeeCollections::create($data);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
        DB::commit();
        return redirect('/student-index')->with('message', ' student info Update successfully');
    }



    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Student::updateStudentStatus($id));
    }

    public function destroy($id)
    {
        try {
            $student = Student::find($id);
            if ($student->status == 1 || $student->status == 0) {
                $student->status = 3;
            }
            $student->delete();
            return redirect()->back()->with('message', 'Student info Delete Successfully.!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
