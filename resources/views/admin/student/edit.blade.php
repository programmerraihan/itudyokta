@extends('admin.admin_master')


@section('css')
    <style type="text/css">
        fieldset {
            min-width: 0px;
            padding: 15px;
            margin: 7px;
            border: 2px solid #a66df5;
        }

        legend {
            float: none;
            background-image: linear-gradient(to bottom right, #062689, #5b076f);
            padding: 4px;
            width: 50%;
            color: rgb(255, 255, 255);
            border-radius: 7px;
            font-size: 17px;
            font-weight: 700;
            text-align: center;
        }

        label {
            font-weight: 700;
        }

        /* date css Start  */

        input[type="date"]::-webkit-datetime-edit,
        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-clear-button {
            color: #fff;
            position: relative;
        }

        input[type="date"]::-webkit-datetime-edit-year-field {
            position: absolute !important;
            border-left: 1px solid #8c8c8c;
            padding: 2px;
            color: #000;
            left: 56px;
        }

        input[type="date"]::-webkit-datetime-edit-month-field {
            position: absolute !important;
            border-left: 1px solid #8c8c8c;
            padding: 2px;
            color: #000;
            left: 26px;
        }


        input[type="date"]::-webkit-datetime-edit-day-field {
            position: absolute !important;
            color: #000;
            padding: 2px;
            left: 4px;

        }

        /* date css End  */
    </style>
@endsection

@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            @if ($message = Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{-- @dd($message) --}}
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Edit Student</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Edit Student</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="">
                            <div class="invoice-title">

                                <h4>
                                    <a href="{{ route('student.index') }}" class=" float-right btn btn-primary">Student</a>
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-lg-12">
                    <form method="POST" action="{{ route('student.update', ['id' => $student->id]) }}"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="col-lg-12">
                            <fieldset>
                                <legend>Personal Information
                                </legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Name <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $student->name }}" name="name"
                                                            placeholder="Name" class="form-control" id="name">

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_name">Father's Name <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $student->father_name }}"
                                                            name="father_name" placeholder="Father's Name"
                                                            class="form-control" id="father_name">

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_name">Mother's Name <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $student->mother_name }}"
                                                            name="mother_name" placeholder="Mother's Name"
                                                            class="form-control" id="mother_name">

                                                    </div>
                                                </div>

                                            </div>





                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="present_address"> Present Address <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $student->present_address }}"
                                                            name="present_address" placeholder=" Present Address"
                                                            class="form-control" id="present_address">

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="permanent_address"> Permanent Address <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $student->permanent_address }}"
                                                            name="permanent_address" placeholder=" Permanent Address"
                                                            class="form-control" id="permanent_address">

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="date"> Date Of Birth <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $student->date_of_birth }}"
                                                            name="date_of_birth" placeholder=" Date Of Birth"
                                                            class="form-control" id="date">

                                                    </div>
                                                </div>

                                               

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="email">Personal Email <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="email" value="{{ $student->email }}"
                                                            name="email" placeholder="Personal Email "
                                                            class="form-control" id="email">

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="formrow-inputState">Gender<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select id="formrow-inputState" name="gender"
                                                            class="form-control">
                                                            <option value="" disabled selected>-- Select Gender --
                                                            </option>

                                                            <option value="Male"
                                                                {{ $student->gender == 'Male' ? 'selected' : '' }}>Male
                                                            </option>
                                                            <option value="Female"
                                                                {{ $student->gender == 'Female' ? 'selected' : '' }}>
                                                                Female</option>
                                                            <option value="Other"
                                                                {{ $student->gender == 'Other' ? 'selected' : '' }}>Other
                                                            </option>
                                                        </select>

                                                        @error('gender')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="formrow-inputState">Religion<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select id="formrow-inputState" name="religion"
                                                            class="form-control">
                                                            <option value="" disabled selected>-- Select Religion --
                                                            </option>

                                                            <option value="Islam"
                                                                {{ $student->religion == 'Islam' ? 'selected' : '' }}>
                                                                Islam</option>
                                                            <option value="Sanatan"
                                                                {{ $student->religion == 'Sanatan' ? 'selected' : '' }}>
                                                                Sanatan</option>
                                                            <option value="Buddhism"
                                                                {{ $student->religion == 'Buddhism' ? 'selected' : '' }}>
                                                                Buddhism</option>
                                                            <option value="Christian"
                                                                {{ $student->religion == 'MaChristianle' ? 'selected' : '' }}>
                                                                Christian</option>
                                                            <option value="Other"
                                                                {{ $student->religion == 'Other' ? 'selected' : '' }}>
                                                                Other</option>
                                                        </select>

                                                        @error('gender')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nationality">Nationality <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $student->nationality }}"
                                                            name="nationality" placeholder="Nationality"
                                                            class="form-control" id="nationality">

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mobile">Personal Mobile Number <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" name="mobile"
                                                            placeholder=" Personal Mobile Number"
                                                            value="{{ $student->mobile }}" class="form-control"
                                                            id="mobile">

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="password">Password<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value=""
                                                            name="password" placeholder="Password"
                                                            class="form-control" id="password">

                                                    </div>
                                                </div>
                                            </div>








                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        @foreach ($student->studentEduction as $item)
                            <div class="col-lg-12">
                                <fieldset>
                                    <legend>Academic Information</legend>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="board_name">S.S.C/J.S.C(Board) <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" value="{{ $item->board_name }}"
                                                                name="board_name" placeholder="S.S.C/J.S.C(Board)"
                                                                class="form-control" id="board_name">

                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="roll_no">Roll No <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" value="{{ $item->roll_no }}"
                                                                name="roll_no" placeholder="Roll No:"
                                                                class="form-control" id="roll_no">

                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="reg_no">Reg. No: <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" value="{{ $item->reg_no }}"
                                                                name="reg_no" placeholder="Reg. No:"
                                                                class="form-control" id="reg_no">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="year">Year <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" value="{{ $item->year }}"
                                                                name="year" placeholder="Year" class="form-control"
                                                                id="year">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="last_education_board">Last Education <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                value="{{ $item->last_education_board }}"
                                                                name="last_education_board"
                                                                placeholder="Last Education (Board)" class="form-control"
                                                                id="last_education_board">

                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="last_education_roll">Roll No <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number"
                                                                value="{{ $item->last_education_roll }}"
                                                                name="last_education_roll" placeholder="Roll No:"
                                                                class="form-control" id="last_education_roll">

                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="last_education_reg">Reg. No: <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" value="{{ $item->last_education_reg }}"
                                                                name="last_education_reg" placeholder="Reg. No:"
                                                                class="form-control" id="last_education_reg">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="last_education_year">Year <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                value="{{ $item->last_education_year }}"
                                                                name="last_education_year" placeholder="Year"
                                                                class="form-control" id="last_education_year">

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        @endforeach




                        <div class="col-lg-12">
                            <fieldset>
                                <legend>Course Information</legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body ">

                                            @foreach ($student->enrollment as $item)
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="course titleid">Course<span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <select id="course_title_id" name="course_title_id"
                                                                class="form-control course">
                                                                <option value="" disabled selected>-- Select Course
                                                                    --
                                                                </option>

                                                                @foreach ($courseTitles as $courseTitle)
                                                                    <option value="{{ $courseTitle->id }}"
                                                                        {{ $courseTitle->id == $item->course_title_id ? 'selected' : '' }}>
                                                                        {{ $courseTitle->title }}</option>
                                                                @endforeach

                                                                {{-- <input type="hidden" value="{{ $courseTitle->price }}" id="coursePrice{{ $courseTitle->id }}">
                                                                    <input type="hidden" value="{{ $courseTitle->offer_price }}" id="courseOfferPrice{{ $courseTitle->id }}"> --}}
                                                            </select>

                                                            @error('course')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="month">Course Start Date <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="date" name="course_start_date"
                                                                value="{{ $item->course_start_date }}"
                                                                placeholder="dd/M/year" class="form-control"
                                                                id="month">

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="price">Price <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" name="price"
                                                                value="{{ $item->price }}" placeholder="Price"
                                                                class="form-control" id="price" disabled>

                                                        </div>
                                                    </div>
                                                    {{-- 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="offer_price">Offer Price <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" name="offer_price"
                                                                value="{{ $item->offer_price }}"
                                                                placeholder="offer price" class="form-control"
                                                                id="offer_price" disabled>

                                                        </div>
                                                    </div> --}}

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="payable_amount">Payable Amount <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" name="payable_amount"
                                                                value="{{ $item->payable_amount }}"
                                                                placeholder="Payable Amount" class="form-control"
                                                                id="payable_amount">

                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="due_amount">Due Amount<span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" name="due_amount"
                                                                value="{{ $item->due_amount }}" placeholder="Due Amount"
                                                                class="form-control" id="due_amount">

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="next_due_date">Next Due Date <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="date" name="next_due_date"
                                                                value="{{ $item->next_due_date }}"
                                                                placeholder="Next Due Date" class="form-control"
                                                                id="next_due_date">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="batch">Branch <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <select id="branch_id" name="branch_id"
                                                                class="form-control branch ">
                                                                <option value="" disabled selected>-- Select Branch
                                                                    --
                                                                </option>

                                                                @foreach ($branches as $branch)
                                                                    <option value="{{ $branch->id }}"
                                                                        {{ $branch->id == $item->branch_id ? 'selected' : '' }}>
                                                                        {{ $branch->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="next_due_date">Batch <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <select id="batch_id" name="batch_id" class="form-control">
                                                                <option value="" disabled selected>-- Select Batch --
                                                                </option>

                                                                @foreach ($batches as $batch)
                                                                    <option value="{{ $batch->id }}"
                                                                        {{ $batch->id == $item->batch_id ? 'selected' : '' }}>
                                                                        {{ $batch->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="batch">Schedule <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            @php
                                                                // foreach ($schedules as $schedule){
                                                                //     $days = json_encode($schedule->day);
                                                                //     dump($days);
                                                                // }
                                                                // die();
                                                            @endphp
                                                            <select id="schedule_id" name="schedule_id"
                                                                class="form-control">
                                                                <option value="" disabled selected>-- Select Schedule
                                                                    --
                                                                </option>

                                                                @foreach ($schedules as $schedule)
                                                                    <option value="{{ $schedule->id }}"
                                                                        {{ $schedule->id == $item->schedule_id ? 'selected' : '' }}>
                                                                        {{ json_encode($schedule->day) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input_file">
                                                                <label for="session">Session <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                            </div>
                                                            <select id="formrow-inputState" name="session_id"
                                                                class="form-control">
                                                                <option value="" disabled selected>-- Select Session
                                                                    --
                                                                </option>

                                                                @foreach ($sessions as $session)
                                                                    <option value="{{ $session->id }}"
                                                                        {{ $session->id == $item->session_id ? 'selected' : '' }}>
                                                                        {{ $session->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach

                                            {{-- @dd($student); --}}



                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-12">
                            <fieldset>
                                <legend>Documents</legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="image">Profile Picture <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <input type="file" name="image"
                                                            placeholder="Profile Picture" class="form-control"
                                                            id="image">

                                                        <img src="{{ asset('admin/image/student/' . $student->image) }}"
                                                            width="100px" alt="Slide Image">

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="nid">NID <span class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <input type="file" name="nid" placeholder="NID"
                                                            class="form-control" id="nid">

                                                        <img src="{{ asset('admin/image/nid/' . $student->nid) }}"
                                                            width="100px" alt="Slide Image">

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="certificate">Certificate <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <input type="file" name="certificate" placeholder="Price"
                                                            class="form-control" id="certificate">

                                                        <img src="{{ asset('admin/image/certificate/' . $student->certificate) }}"
                                                            width="100px" alt="Slide Image">

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="signature">Signature <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <input type="file" name="signature" placeholder="Signature"
                                                            class="form-control" id="signature">

                                                        <img src="{{ asset('admin/image/signature/' . $student->signature) }}"
                                                            width="100px" alt="Slide Image">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" hidden checked type="radio" name="status"
                                    id="inlineCheckbox1" value="1">
                                <label class="form-check-label" hidden for="inlineCheckbox1">Published</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" hidden type="radio" name="status"
                                    id="inlineCheckbox2" value="0">
                                <label class="form-check-label" hidden for="inlineCheckbox2">Unpublished</label>
                            </div>
                        </div>

                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" hidden checked type="radio" name="student_status"
                                    id="inlineCheckbox3" value="0">
                                <label class="form-check-label" hidden for="inlineCheckbox3">Published</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" hidden type="radio" name="student_status"
                                    id="inlineCheckbox4" value="1">
                                <label class="form-check-label" hidden for="inlineCheckbox4">Unpublished</label>
                            </div>
                        </div>

                        {{-- @dd($student) --}}



                        <div class="col-lg-12">
                            <fieldset>
                                <legend>To Be Filled up by Cox's Online Dot Com</legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body ">


                                            @foreach ($student->studentFeeCollections as $ac)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input_file">
                                                                <label for="reg_no_student">Reg. No: <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                            </div>
                                                            <input type="numer" value="{{ $student->reg_no_student }}"
                                                                name="reg_no_student" placeholder="Reg. No:"
                                                                class="form-control" id="reg_no_student">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input_file">
                                                                <label for="roll_no_student">Roll No: <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                            </div>
                                                            <input type="numer" value="{{ $student->roll_no_student }}"
                                                                name="roll_no_student" placeholder="Roll No:"
                                                                class="form-control" id="roll_no_student">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input_file">
                                                                <label for="session">Fund <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                            </div>
                                                            <select id="bank_id" name="bank_id" class="form-control">
                                                                <option value="" disabled selected>-- Select Fund --
                                                                </option>
                                                                @foreach ($banks as $bank)
                                                                    <option value="{{ $bank->id }}"
                                                                        {{ $bank->id == $ac->fund_id ? 'selected' : '' }}>
                                                                        {{ $bank->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- @endforeach --}}

                                                {{-- @foreach ($student->acTransaction as $ac) --}}
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="input_file">
                                                                <label for="session">Account Head <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                            </div>
                                                            <select id="account_head_id" name="account_head_id"
                                                                class="form-control">
                                                                <option value="" disabled selected>-- Select Account
                                                                    Head --
                                                                </option>
                                                                @foreach ($AccountHeads as $AccountHead)
                                                                    <option value="{{ $AccountHead->id }}"
                                                                        {{ $AccountHead->id == $ac->ac_head_id ? 'selected' : '' }}>
                                                                        {{ $AccountHead->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="input_file">
                                                                <label for="signature_director">Signature of Center
                                                                    Director<span class="text-danger">*</span>
                                                                </label>
                                                            </div>
                                                            <input type="file" name="director" placeholder="Price"
                                                                class="form-control" id="signature_director">

                                                            <img src="{{ asset('admin/image/director/' . $student->director) }}"
                                                                width="100px" alt="Slide Image">
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach

                                        </div>

                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        &nbsp;
                        &nbsp;

                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                {{-- <div class="card">
                                <div class="card-body "> --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="text-center">
                                                <button style="width: 250px" type="submit"
                                                    class="btn btn-primary">Update
                                                    STUDENT </button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div>
                                </div> --}}
                                </div>
                            </div>
                        </div>
                        &nbsp;
                    </form>

                </div>
            </div>


        </div>
    </div>

    </div>
@endsection
