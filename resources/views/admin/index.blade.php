@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">



            @php
                
                $all_student = App\Models\Student::where('status', 1)
                    ->get()
                    ->count();
                
                $panding_student = App\Models\Student::where('status', 0)
                    ->get()
                    ->count();
                
                $all_branch = App\Models\Branch::where('status', 1)
                    ->get()
                    ->count();
                
                $panding_branch = App\Models\Branch::where('status', 0)
                    ->get()
                    ->count();
                
                $all_course = App\Models\CourseTitle::where('status', 1)
                    ->get()
                    ->count();
                
                $all_teacher = App\Models\Teacher::where('status', 1)
                    ->get()
                    ->count();
                
            @endphp

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #092689, #6f086c);">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4" style="color: #ffffff!important;">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Totel Student</h5>
                                        {{-- <p> Dashboard</p> --}}
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $all_student }}</h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end" style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/b.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right,#c11843, #061664);">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Totel Branch</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $all_branch }}</h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end" style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/megamenu-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #6f086c, #092689);">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Panding Branch</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $panding_branch }}</h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end" style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/profile-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right,#c11843, #061664);">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Panding Student</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $panding_student }}</h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end" style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/maintenance.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #6f086c, #092689);">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Course</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $all_course }}</h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end" style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/verification-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right,#c11843, #061664);">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Teacher</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $all_teacher }}</h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end"
                                    style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/a.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>



                <?php
                    $expense_amount_today = App\Models\Expense::where('status', 1)
                        ->whereNull('branch_id')
                        ->whereDate('created_at', date('Y-m-d'))
                        ->sum('expense_amount');
                    
                    $expense_amount_m = App\Models\Expense::where('status', 1)
                        ->whereNull('branch_id')
                        ->whereMonth('created_at', date('m'))
                        ->sum('expense_amount');
                    
                    $expense_amount_y = App\Models\Expense::where('status', 1)
                        ->whereYear('created_at', date('Y'))
                        ->whereNull('branch_id')
                        ->sum('expense_amount');
                    
                    $expense_amount_total = App\Models\Expense::where('status', 1)->whereNull('branch_id')->sum('expense_amount');
                ?>


                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #6f086c, #092689);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Today Expense</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">
                                            Tk. {{ $expense_amount_today }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #c11843, #061664);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Month Expense</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;"> Tk.
                                            {{ $expense_amount_m }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #c11843, #061664);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Year Expense</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;"> Tk.
                                            {{ $expense_amount_y }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #092689, #6f086c);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Expense</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">Tk.
                                            {{ $expense_amount_total }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>




                @php
                    $purchase_today = App\Models\PurchaseItem::whereDate('created_at', date('Y-m-d'))
                        ->whereNull('branch_id')
                        ->sum('total_price');
                    
                    $purchase_month = App\Models\PurchaseItem::whereMonth('created_at', date('m'))
                        ->whereNull('branch_id')
                        ->sum('total_price');
                    
                    $purchase_year = App\Models\PurchaseItem::whereYear('created_at', date('Y'))
                        ->whereNull('branch_id')
                        ->sum('total_price');
                    
                    $purchase_total = App\Models\PurchaseItem::whereNull('branch_id')->sum('total_price');
                @endphp

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #6f086c, #092689);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Today Purchase</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">
                                            Tk. {{ $purchase_today }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #c11843, #061664);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Month Purchase</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;"> Tk. {{ $purchase_month }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #c11843, #061664);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Year Purchase</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;"> Tk. {{ $purchase_year }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #092689, #6f086c);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Purchase</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">Tk.
                                            {{ $purchase_total }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>



                @php
                    $income_today = App\Models\StudentFeeCollections::whereDate('created_at', date('Y-m-d'))
                        ->whereNotNull('branch_id')->where('created_by','admin')
                        ->sum('paid');

                    $course_commission_today = App\Models\CourseCommission::whereDate('created_at', date('Y-m-d'))->where('created_by', 'admin')->where('tran_type', 'course_commission')
                        ->sum('amount');
                    
                    $income_month = App\Models\StudentFeeCollections::whereMonth('created_at', date('m'))
                        ->whereNull('branch_id')->where('created_by','admin')
                        ->sum('paid');

                    $course_commission_month = App\Models\CourseCommission::whereMonth('created_at', date('m'))->where('created_by', 'admin')->where('tran_type', 'course_commission')
                        ->sum('amount');
                    
                    $income_year = App\Models\StudentFeeCollections::whereYear('created_at', date('Y'))
                        ->whereNull('branch_id')->where('created_by','admin')
                        ->sum('paid');

                    $course_commission_year = App\Models\CourseCommission::whereYear('created_at', date('Y'))->where('created_by', 'admin')->where('tran_type', 'course_commission')
                        ->sum('amount');
                    
                    $income_total = App\Models\StudentFeeCollections::whereNull('branch_id')->sum('paid');
                    $registration_fee = App\Models\CourseCommission::whereNull('branch_id')->sum('amount');
                    $income_total += $registration_fee ?? 0;
                @endphp

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #6f086c, #092689);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Today Income</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">
                                            Tk. {{ $income_today + $course_commission_today }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #c11843, #061664);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Month Income</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;"> Tk. {{ $income_month }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #c11843, #061664);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Year Income</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;"> Tk. {{ $income_year + $course_commission_year }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #092689, #6f086c);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Income</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">Tk.
                                            {{ $income_total }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>



                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #6f086c, #092689);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Today Profit</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">
                                            Tk. {{ $income_today - $purchase_today - $expense_amount_today }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #c11843, #061664);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Month Profit</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;"> Tk.
                                            {{ $income_month - $purchase_month - $expense_amount_m }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #c11843, #061664);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Year Profit</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;"> Tk.
                                            {{ $income_year + $course_commission_year - $purchase_year - $expense_amount_y }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #092689, #6f086c);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Profit</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">Tk.
                                            {{ $income_total - $purchase_total - $expense_amount_total }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                @php
                    
                    $present_today = App\Models\Attendance::whereDate('created_at', date('Y-m-d'))
                        ->where('attendance_status', 1)
                        ->get()
                        ->count();
                    $absent_today = App\Models\Attendance::whereDate('created_at', date('Y-m-d'))
                    
                        ->where('attendance_status', 0)
                        ->get()
                        ->count();
                @endphp

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #092689, #6f086c);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;"> Today
                                            Present
                                        </h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">
                                            {{ $present_today }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-3">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary"
                            style="background-image: linear-gradient(to bottom right, #c11843, #061664);">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;"> Today
                                            Absent
                                        </h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">
                                            {{ $absent_today }}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- end row -->



            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
