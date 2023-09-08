@extends('branch.branch_master')


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
                        <h4 class="mb-0 font-size-18">Add Teacher</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Teacher</li>
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
                                    <a href="{{ route('branch.teacher.index') }}"
                                        class=" float-right btn btn-primary">Teacher</a>
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('branch.store.teacher') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset>
                            <legend> Teacher Personal Information </legend>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body ">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Name">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="photo">Profile Photo <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" name="photo" class="form-control"
                                                        placeholder="Profile Photo">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone Number <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" name="phone" placeholder="Phone Number"
                                                        class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"> Email Address <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email" name="email" placeholder=" Email Address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="birth_date">Birth of Date <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="date" name="birth_date" class="form-control"
                                                        placeholder="Birth of Date">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="blood_group">Blood Group <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="blood_group" class="form-control"
                                                        placeholder="Blood Group ">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_no">Passport No <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="passport_no" class="form-control"
                                                        placeholder="Passport No">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="passport_expiry_date">Passport Expiry Date <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="date" name="passport_expiry_date"
                                                        placeholder=" Passport Expiry Date" class="form-control"
                                                        id="mobil">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="marital_status"> Marital Status<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select id="marital_statuse" name="marital_status"
                                                        class="form-control">
                                                        <option value="" disabled selected>-- Marital Status --
                                                        </option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divorced">Divorced</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="father_name">Father Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="father_name" class="form-control"
                                                        placeholder="Father Name">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mother_name">Mother Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="mother_name" class="form-control"
                                                        placeholder="Mother Name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="spouse_name">Spouse Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="spouse_name" class="form-control"
                                                        placeholder="Spouse Name">

                                                </div>
                                            </div>



                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gender">Gender<span class="text-danger">*</span>
                                                    </label>
                                                    <select id="gender" name="gender" class="form-control">
                                                        <option value="" disabled selected>-- Select Gender --
                                                        </option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="formrow-inputState">Religion<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select id="formrow-inputState" name="religion" class="form-control">
                                                        <option value="" disabled selected>-- Select Religion --
                                                        </option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Sanatan">Sanatan</option>
                                                        <option value="Buddhism">Buddhism</option>
                                                        <option value="Christian">Christian</option>
                                                        <option value="Other">Other</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nationality">Nationality <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="nationality" placeholder="Nationality"
                                                        class="form-control" id="nationality">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="present_address">Present Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <textarea type="text" name="present_address" placeholder="Present Address " class="form-control">  </textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="permanent_address">Permanent Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <textarea type="text" name="permanent_address" placeholder="Permanent Address" class="form-control"> </textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-lg-6">
                        <fieldset>
                            <legend> Emergency Contact Information </legend>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body ">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="emergency_contact_name"> Emergency Contact Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="emergency_contact_name"
                                                        class="form-control" placeholder=" Emergency Contact Name">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="emergency_contact_no"> Emergency Mobil Number <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" name="emergency_contact_no"
                                                        placeholder="Emergency Mobil Number" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="emergency_relationship">Emergency Contact Relationship
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="emergency_relationship"
                                                        class="form-control" placeholder="Emergency Contact Relationship">

                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="present_address">Emergency Contact Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="emergency_address"
                                                        placeholder="Emergency Contact Address" class="form-control">
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-lg-6">
                        <fieldset>
                            <legend> Teachear Education Qualification </legend>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body ">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="edu_qualification">Level of last education <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="edu_qualification" class="form-control"
                                                        placeholder="Level of last education">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="teacher_code"> Teacher Code<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" name="teacher_code" placeholder="Teacher Code"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="designation">Designation <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="designation" class="form-control"
                                                        placeholder="Designation">

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="joining_date">Joining Date <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="date" name="joining_date" placeholder="Joining Date "
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="formrow-inputState">Teacher Category <span
                                                            class="text-danger">*</span> </label>
                                                    <select id="formrow-inputState" name="teacher_categories_id"
                                                        class="form-control">
                                                        <option value="" disabled selected>-- Select Teacher
                                                            Category--
                                                        </option>

                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"> {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="formrow-inputState">Branch <span
                                                                class="text-danger">*</span> </label>
                                                        <select id="formrow-inputState" name="branch_id" class="form-control">
                                                            <option value="" disabled selected>-- Select Branch --
                                                            </option>
        
                                                            @foreach ($branches as $branch)
                                                                <option value="{{ $branch->id }}"> {{ $branch->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> --}}
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </fieldset>


                    </div>
                    &nbsp;
                    &nbsp;

                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" hidden checked type="radio" name="status"
                                id="inlineCheckbox1" value="1">
                            <label class="form-check-label" hidden for="inlineCheckbox1">Published</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" hidden type="radio" name="status" id="inlineCheckbox2"
                                value="0">
                            <label class="form-check-label" hidden for="inlineCheckbox2">Unpublished</label>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        {{-- <div class="card"> --}}
                        {{-- <div class="card-body "> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="text-center">
                                        <button style="width: 250px" type="submit" class="btn btn-primary">Add
                                            Teacher Information </button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        {{-- </div> --}}
                        {{-- </div> --}}
                    </div>


                </div>
            </form>


        </div>
    </div>

    </div>
@endsection
