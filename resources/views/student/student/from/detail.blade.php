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


        .custom-form {}

        .card-body {
            background: antiquewhite !important;
        }

        .form-control form-control-sm:disabled,
        .form-control form-control-sm[readonly] {
            background-color: #faebd7;
            opacity: 1;
        }
        body{
  -webkit-print-color-adjust:exact !important;
  print-color-adjust:exact !important;
}

fieldset > legend {
    padding: 2px;
}

.form-group {
    margin-bottom: 5px;
}

.form-group > label {
    margin-bottom: 5px;
}
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
                        <h4 class="mb-0 font-size-18">Add Student</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Student</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>





            <div class="row">
                <div class="col-md-12">
                    <div class="d-print-none">
                        <div class="float-right">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i
                                    class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div
            style="background: antiquewhite !important;
                    padding-top: 10px;
                    margin: 0;
                    border: 7px solid grey;">

            <div class="row">
                <div class="col-md-12">
                    <div style="text-align: center; line-height:3px">
                        <h3 style="color: #e57b0d;font-size: 30px;">IT UDYOKTA
                        </h3>

                        <h4 style="color: #5b076f">A Project of SOFT HOST LTD</h4>
                        <p> Bangladesh Government Approved REGISTRATION NO. C-186066/2022</p>
                        {{-- <p>Dhaka Bangladesh, call -12315132315. web.www.abcdef.com </p>
                        <p>Email: apusradar@gmail.com BF:www.facebook.com/xyz </p> --}}
                        <h3 style="color: #495057;  "> <b> Applycation Form For Examinee</b> </h3>
                        <h5> <b> To Be Filled Up By The Examinee <b> </h5>



                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="col-lg-12">
                        <fieldset style="padding:0;">
                            <legend>Personal Information
                            </legend>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body " style="padding: 10px 20px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $student->name }}" readonly
                                                        name="name" placeholder="Name" class="form-control form-control-sm"
                                                        id="name">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="father_name">Father's Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $student->father_name }}" readonly
                                                        name="father_name" placeholder="Father's Name" class="form-control form-control-sm"
                                                        id="father_name">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mother_name">Mother's Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $student->mother_name }}" readonly
                                                        name="mother_name" placeholder="Mother's Name" class="form-control form-control-sm"
                                                        id="mother_name">

                                                </div>
                                            </div>

                                        </div>





                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="present_address"> Present Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $student->present_address }}" readonly
                                                        name="present_address" placeholder=" Present Address"
                                                        class="form-control form-control-sm" id="present_address">

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="permanent_address"> Permanent Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $student->permanent_address }}" readonly
                                                        name="permanent_address" placeholder=" Permanent Address"
                                                        class="form-control form-control-sm" id="permanent_address">

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="date"> Date Of Birth <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $student->date_of_birth }}" readonly
                                                        name="date_of_birth" placeholder=" Date Of Birth"
                                                        class="form-control form-control-sm" id="date">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile">Personal Mobile Number <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" name="mobile"
                                                        placeholder=" Personal Mobile Number"
                                                        value="{{ $student->mobile }}" readonly class="form-control form-control-sm"
                                                        id="mobile">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Personal Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="email" value="{{ $student->email }}" readonly
                                                        name="email" placeholder="Personal Email " class="form-control form-control-sm"
                                                        id="email">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formrow-inputState">Gender<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select id="formrow-inputState" readonly name="gender"
                                                        disabled="true" class="form-control form-control-sm">
                                                        <option value="" disabled selected>-- Select Gender --
                                                        </option>

                                                        <option readonly value="Male"
                                                            {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                        <option readonly value="Female"
                                                            {{ $student->gender == 'Female' ? 'selected' : '' }}>Female
                                                        </option>
                                                        <option readonly value="Other"
                                                            {{ $student->gender == 'Other' ? 'selected' : '' }}>Other
                                                        </option>
                                                    </select>

                                                    @error('gender')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formrow-inputState">Religion<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select id="formrow-inputState" name="religion" disabled="true"
                                                        class="form-control form-control-sm">
                                                        <option value="" disabled selected>-- Select Religion --
                                                        </option>

                                                        <option value="Islam"
                                                            {{ $student->religion == 'Islam' ? 'selected' : '' }}>Islam
                                                        </option>
                                                        <option value="Sanatan"
                                                            {{ $student->religion == 'Sanatan' ? 'selected' : '' }}>Sanatan
                                                        </option>
                                                        <option value="Buddhism"
                                                            {{ $student->religion == 'Buddhism' ? 'selected' : '' }}>
                                                            Buddhism
                                                        </option>
                                                        <option value="Christian"
                                                            {{ $student->religion == 'MaChristianle' ? 'selected' : '' }}>
                                                            Christian</option>
                                                        <option value="Other"
                                                            {{ $student->religion == 'Other' ? 'selected' : '' }}>Other
                                                        </option>
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
                                                    <input type="text" value="{{ $student->nationality }}" readonly
                                                        name="nationality" placeholder="Nationality" class="form-control form-control-sm"
                                                        id="nationality">

                                                </div>
                                            </div>
                                        </div>








                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    @foreach ($student->StudentEduction as $item)
                        <div class="col-lg-12">
                            <fieldset style="padding:0;">
                                <legend>Academic Information</legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body " style="padding: 10px 20px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="board_name">S.S.C/J.S.C(Board) <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $item->board_name }}" readonly
                                                            name="board_name" placeholder="S.S.C/J.S.C(Board)"
                                                            class="form-control form-control-sm" id="board_name">

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="roll_no">Roll No <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" value="{{ $item->roll_no }}" readonly
                                                            name="roll_no" placeholder="Roll No:" class="form-control form-control-sm"
                                                            id="roll_no">

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="reg_no">Reg. No: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" value="{{ $item->reg_no }}" readonly
                                                            name="reg_no" placeholder="Reg. No:" class="form-control form-control-sm"
                                                            id="reg_no">

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="year">Year <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $item->year }}" readonly
                                                            name="year" placeholder="Year" class="form-control form-control-sm"
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
                                                        <input type="text" value="{{ $item->last_education_board }}"
                                                            readonly name="last_education_board"
                                                            placeholder="Last Education (Board)" class="form-control form-control-sm"
                                                            id="last_education_board">

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="last_education_roll">Roll No <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" value="{{ $item->last_education_roll }}"
                                                            readonly name="last_education_roll" placeholder="Roll No:"
                                                            class="form-control form-control-sm" id="last_education_roll">

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="last_education_reg">Reg. No: <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" value="{{ $item->last_education_reg }}"
                                                            readonly name="last_education_reg" placeholder="Reg. No:"
                                                            class="form-control form-control-sm" id="last_education_reg">

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="last_education_year">Year <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" value="{{ $item->last_education_year }}"
                                                            readonly name="last_education_year" placeholder="Year"
                                                            class="form-control form-control-sm" id="last_education_year">

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
                        <fieldset style="padding:0;">
                            <legend>Course Information</legend>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body " style="padding: 10px 20px;">

                                        @foreach ($student->Enrollment as $item)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="course titleid">Course<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select id="course_title_id" readonly name="course_title_id"
                                                            disabled="true" class="form-control form-control-sm course">
                                                            <option value="" disabled selected>-- Select Course --
                                                            </option>

                                                            @foreach ($courseTitles as $courseTitle)
                                                                <option value="{{ $courseTitle->id }}"
                                                                    {{ $courseTitle->id == $item->course_title_id ? 'selected' : '' }}>
                                                                    {{ $courseTitle->title }}</option>
                                                            @endforeach


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
                                                        <input type="date" name="course_start_date" readonly
                                                            value="{{ $item->course_start_date }}"
                                                            placeholder="dd/M/year" class="form-control form-control-sm" id="month">

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="price">Price <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" name="price" readonly
                                                            value="{{ $item->price }}" placeholder="Price"
                                                            class="form-control form-control-sm" id="price" disabled>

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="offer_price">Offer Price <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" name="offer_price" readonly
                                                            value="{{ $item->offer_price }}" placeholder="offer price"
                                                            class="form-control form-control-sm" id="offer_price" disabled>

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="payable_amount">Payable Amount <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" name="payable_amount" readonly
                                                            value="{{ $item->payable_amount }}"
                                                            placeholder="Payable Amount" class="form-control form-control-sm"
                                                            id="payable_amount">

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="due_amount">Due Amount<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" name="due_amount" readonly
                                                            value="{{ $item->due_amount }}" placeholder="Due Amount"
                                                            class="form-control form-control-sm" id="due_amount">

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="next_due_date">Next Due Date <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="date" name="next_due_date" readonly
                                                            value="{{ $item->next_due_date }}"
                                                            placeholder="Next Due Date" class="form-control form-control-sm"
                                                            id="next_due_date">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="batch">Branch <span class="text-danger">*</span>
                                                        </label>
                                                        <select id="branch_id" name="branch_id" readonly disabled="true"
                                                            class="form-control form-control-sm branch ">
                                                            <option value="" disabled selected>-- Select Branch --
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
                                                        <select id="batch_id" name="batch_id" readonly disabled="true"
                                                            class="form-control form-control-sm">
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
                                                        <label for="batch">Schedule <span class="text-danger">*</span>
                                                        </label>
                                                        @php
                                                            
                                                        @endphp
                                                        <select id="schedule_id" name="schedule_id" readonly
                                                            disabled="true" class="form-control form-control-sm">
                                                            <option value="" disabled selected>-- Select Schedule --
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
                                                        <select id="formrow-inputState" name="session_id" readonly
                                                            disabled="true" class="form-control form-control-sm">
                                                            <option value="" disabled selected>-- Select Session --
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



                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-lg-12">
                        <fieldset style="padding:0;">
                            <legend>Documents</legend>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body " style="padding: 10px 20px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="input_file">
                                                        <label for="image">Profile Picture <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                    </div>


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

                    <div class="col-lg-12">
                        <fieldset style="padding:0;">
                            <legend>To Be Filled up by Cox's Online Dot Com</legend>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body " style="padding: 10px 20px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input_file">
                                                        <label for="reg_no_student">Reg. No: <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <input type="numer" readonly value="{{ $student->reg_no_student }}"
                                                        name="reg_no_student" placeholder="Reg. No:" class="form-control form-control-sm"
                                                        id="reg_no_student">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input_file">
                                                        <label for="roll_no_student">Roll No: <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                    </div>

                                                    <input type="numer" readonly
                                                        value="{{ $student->roll_no_student }}" name="roll_no_student"
                                                        placeholder="Roll No:" class="form-control form-control-sm" id="roll_no_student">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input_file">
                                                        <label for="signature_director">Signature of Center Director<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                    </div>

                                                    <img src="{{ asset('admin/image/signature/' . $student->image) }}"
                                                        width="100px" alt="Slide Image">

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </fieldset>
                    </div>

                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script></script>
    @endsection
