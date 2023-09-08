@extends('student.student_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            @php
                
                // $branch_id = Auth::guard('branch')->user()->id;
                
                $student_id = Auth::guard('student')->user()->id;
                
                $courses = App\Models\Enrollment::where('student_id', $student_id)
                    ->with('course_title')
                    ->first(['course_title_id']);
                // dd($courses->course_title->title);
                
                $studentResults = App\Models\StudentResult::orderBy('id', 'desc')
                    ->where('student_id', $student_id)
                    // ->with('student')
                    ->first();
                // dd($studentResults->grade);
                
                $test_takers = App\Models\AssessmentTestTaker::where('student_id', $student_id)
                    ->orderBy('id', 'DESC')
                    ->first();
                // dd($test_takers);
                
                // $all_student = App\Models\Student::where('status', 1)
                //     ->where('branch_id', $branch_id)
                //     ->get()
                //     ->count();
                
                // $panding_student = App\Models\Student::where('status', 0)
                //     ->where('branch_id', $branch_id)
                //     ->get()
                //     ->count();
                
                // $all_branch = App\Models\Branch::where('status', 1)
                //     ->where('id', $branch_id)
                //     ->get()
                //     ->count();
                
                // $panding_branch = App\Models\Branch::where('status', 0)
                //     ->where('id', $branch_id)
                //     ->get()
                //     ->count();
                
                // $all_course = App\Models\CourseTitle::where('status', 1)
                //     ->where('branch_id', $branch_id)
                //     ->get()
                //     ->count();
                
                // $all_teacher = App\Models\Teacher::where('status', 1)
                //     ->where('branch_id', $branch_id)
                //     ->get()P
                //     ->count();
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
                        <div class="bg-soft-primary" style="background-color: rgb(9 33 149)!important;">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4" style="color: #ffffff!important;">
                                        <h5 class="text-primary" style="color: #ffffff!important;"> Total Student Result
                                        </h5>
                                        {{-- <p> Dashboard</p> --}}
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">
                                            {{ $studentResults->grade ?? 'None' }}
                                        </h4>
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
                        <div class="bg-soft-primary" style="background-color: rgb(9 33 149)!important;">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">MCQ Result Student
                                        </h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">
                                            {{ $test_takers->total_marks ?? 'None' }}
                                        </h4>
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
                        <div class="bg-soft-primary" style="background-color: rgb(9 33 149)!important;">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Our Course</h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">
                                            {{ $courses->course_title->title ?? 'None' }}
                                        </h4>
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
                {{-- 
                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary" style="background-color: rgb(9 33 149)!important;">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Teacher
                                        </h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $all_teacher }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end" style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/a.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary" style="background-color: rgb(9 33 149)!important;">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Income
                                        </h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $all_teacher }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end" style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/m.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary" style="background-color: rgb(9 33 149)!important;">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Expense
                                        </h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $all_teacher }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end"
                                    style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/n.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-4">
                    <div class="card overflow-hidden" style="box-shadow: 0 0 6px 2px;">
                        <div class="bg-soft-primary" style="background-color: rgb(9 33 149)!important;">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary" style="color: #ffffff!important;">Total Purchase
                                        </h5>
                                        &nbsp;
                                        &nbsp;

                                        <h4 class="mb-0" style="color: #ffffff!important;">{{ $all_teacher }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end"
                                    style="height: 158px; background-color: gold;!importent">
                                    <img src="{{ asset('backend/assets/images/o.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

 --}}



                <!-- end row -->

            </div>
        </div>
        <!-- end row -->


    </div>

    <!-- End Page-content -->
@endsection
