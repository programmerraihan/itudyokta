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

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #faebd7;
            opacity: 1;
            /* border: none; */
            /* border: cornflowerblue; */
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
                        <h4 class="mb-0 font-size-18">View Branch</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Branch</li>
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
                    padding-top: 64px;
                    margin-top: 45px;
                    border: 7px solid grey;">

            <div class="row">
                <div class="col-md-12">
                    <div style="text-align: center; line-height:3px">
                        <h1 style="color: #e57b0d;font-size: 50px;">IT Udyokta Fundation</h1>

                        <h2 style="color: #5b076f">Quality & Skill Porovider</h2>
                        <p>Bangladesh Goverment Approed Re.no 56465646, center. code -492</p>
                        <p>Dhaka Bangladesh, call -12315132315. web.www.abcdef.com </p>
                        <p>Email: apusradar@gmail.com BF:www.facebook.com/xyz </p>
                        <h3 style="color: #495057;  "> <b> Applycation Form For Examinee</b> </h3>
                        <h5> <b> To Be Filled Up By The Examinee <b> </h5>



                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col-lg-6">

                    <fieldset>
                        <legend>Personal Information
                        </legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name <span class="text-danger">*</span>
                                                </label>


                                                <input type="text"
                                                    value="{{ old('personal_name', $branch->personal_name) }}" readonly
                                                    class="form-control" id="name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="father_name">Father's Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" value="{{ $branch->father_name }}" readonly
                                                    placeholder=" Father's Name" class="form-control" id="father_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="mother_name">Mother's Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->mother_name }}"
                                                    class="form-control" id="mother_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobil">Mobil Number <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="mobil" value="{{ $branch->mobil }}" readonly
                                                    placeholder=" Mobil Number" class="form-control" id="mobil">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"> Email Address <span class="text-danger">*</span>
                                                </label>
                                                <input type="personal_email" readonly value="{{ $branch->personal_email }}"
                                                    placeholder=" Email Address" class="form-control" id="email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">Gender<span class="text-danger">*</span>
                                                </label>
                                                <select id="formrow-inputState" readonly disabled="true"
                                                    class="form-control">
                                                    <option value="" disabled selected>-- Select Gender --
                                                    </option>
                                                    <option value="Male"
                                                        {{ $branch->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female"
                                                        {{ $branch->gender == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                    <option value="Other"
                                                        {{ $branch->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">Religion<span class="text-danger">*</span>
                                                </label>
                                                <select id="formrow-inputState" readonly disabled="true"
                                                    class="form-control">
                                                    <option value="" disabled selected>-- Select Religion --
                                                    </option>
                                                    <option value="Islam"
                                                        {{ $branch->religion == 'Islam' ? 'selected' : '' }}>Islam
                                                    </option>
                                                    <option value="Sanatan"
                                                        {{ $branch->religion == 'Sanatan' ? 'selected' : '' }}>Sanatan
                                                    </option>
                                                    <option value="Buddhism"
                                                        {{ $branch->religion == 'Buddhism' ? 'selected' : '' }}>Buddhism
                                                    </option>
                                                    <option value="Christian"
                                                        {{ $branch->religion == 'Christian' ? 'selected' : '' }}>
                                                        Christian</option>
                                                    <option value="Other"
                                                        {{ $branch->religion == 'Other' ? 'selected' : '' }}>Other
                                                    </option>
                                                </select>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nationality">Nationality <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->nationality }}"
                                                    placeholder="Nationality" class="form-control" id="nationality">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">Division <span
                                                        class="text-danger">*</span> </label>
                                                <select id="division_id" readonly disabled="true" class="form-control">
                                                    <option value="" disabled selected>-- Select Division --
                                                    </option>

                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}"
                                                            {{ $division->id == $branch->division_id ? 'selected' : '' }}>
                                                            {{ $division->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">District <span
                                                        class="text-danger">*</span> </label>
                                                <select id="district_id" readonly disabled="true" class="form-control">
                                                    <option value="" disabled selected>-- Select District --
                                                    </option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ $district->id == $branch->district_id ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">City <span class="text-danger">*</span>
                                                </label>
                                                <select id="city_id" readonly disabled="true" class="form-control">
                                                    <option value="" disabled selected>-- Select City --
                                                    </option>
                                                    @foreach ($citys as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ $city->id == $branch->city_id ? 'selected' : '' }}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="upazila">Upazila <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->upazila }}"
                                                    placeholder="Upazila" class="form-control" id="upazila">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="post_office"> Post Office <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->post_office }}"
                                                    placeholder="Post Office" class="form-control" id="post_office">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->address }}"
                                                    placeholder="Address" class="form-control" id="address">
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
                        <legend>Institute Information
                        </legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institute_name">Institute Name <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->institute_name }}"
                                                    placeholder="Institute Name " class="form-control"
                                                    id="institute_name">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institute_name_bangla">Institute Name Bangla <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text"readonly
                                                    value="{{ $branch->institute_name_bangla }}"
                                                    placeholder="Institute Name Bangla" class="form-control"
                                                    id="institute_name_bangla">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="institute_mobil"> Institute Mobil Number <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->institute_mobil }}"
                                                    placeholder="Institute Mobil Number" class="form-control"
                                                    id="institute_mobil">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="institute_email"> Institute Email Address <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="email" readonly value="{{ $branch->institute_email }}"
                                                    placeholder=" Institute  Email Address" class="form-control"
                                                    id="institute_email">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institute_facebook">Institute Facebook Link <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->institute_facebook }}"
                                                    placeholder="Institute Facebook Link" class="form-control"
                                                    id="institute_facebook">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="account_type">Account Type<span class="text-danger">*</span>
                                                </label>
                                                <select id="account_type" readonly disabled="true" class="form-control">
                                                    <option value="" disabled selected>-- Select Account Type --
                                                    </option>

                                                    <option value="personal_institute"
                                                        {{ $branch->account_type == 'personal_institute' ? 'selected' : '' }}>
                                                        Personal Institute </option>
                                                    <option value="joind_venture_institute "
                                                        {{ $branch->account_type == 'joind_venture_institute' ? 'selected' : '' }}>
                                                        Joind Venture Institute </option>

                                                </select>


                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="number_institute">Number of Institute <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="number" readonly value="{{ $branch->number_institute }}"
                                                    placeholder="Number of Institute " class="form-control"
                                                    id="number_institute">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="institute_age">Institute Age <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->institute_age }}"
                                                    placeholder="Institute Age " class="form-control" id="institute_age">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">Division <span
                                                        class="text-danger">*</span> </label>
                                                <select id="institute_division_id" disabled="true" readonly
                                                    class="form-control">
                                                    <option value="" disabled selected>-- Select Division --
                                                    </option>

                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}"
                                                            {{ $division->id == $branch->institute_division_id ? 'selected' : '' }}>
                                                            {{ $division->name }}
                                                        </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">District <span
                                                        class="text-danger">*</span> </label>
                                                <select id="institute_district_id" disabled="true" readonly
                                                    class="form-control">
                                                    <option value="" disabled selected>-- Select District --
                                                    </option>

                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ $district->id == $branch->institute_district_id ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">City <span class="text-danger">*</span>
                                                </label>
                                                <select id="institute_city_id" disabled="true" readonly
                                                    class="form-control">
                                                    <option value="" disabled selected>-- Select City --
                                                    </option>

                                                    @foreach ($citys as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ $city->id == $branch->institute_city_id ? 'selected' : '' }}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="upazila">Upazila <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->institute_upazila }}"
                                                    placeholder="Upazila" class="form-control" id="upazila">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="post_office"> Post Office <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly
                                                    value="{{ $branch->institute_post_office }}"
                                                    placeholder="Post Office" class="form-control" id="post_office">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" readonly value="{{ $branch->institute_address }}"
                                                    placeholder="Address" class="form-control" id="address">

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>


                <div class="col-lg-12">
                    <fieldset>
                        <legend>Branch Confidential</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="profile">Name <span class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="text" readonly value="{{ $branch->name }}"
                                                    placeholder="Name" class="form-control" id="profile">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="nid">Email <span class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="email"readonly value="{{ $branch->email }}"
                                                    placeholder="Email" class="form-control" id="email">
                                            </div>
                                        </div>


                                    </div>

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
                                                    <label for="profile">Profile Picture <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>


                                                <img src="{{ asset('admin/center/profile/' . $branch->profile) }}"
                                                    width="100px" alt="Slide Image">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="nid">NID <span class="text-danger">*</span>
                                                    </label>
                                                </div>


                                                <img src="{{ asset('admin/center/nid/' . $branch->nid) }}" width="100px"
                                                    alt="nid">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="trade_license">Treade License <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>


                                                <img src="{{ asset('admin/center/trade_license/' . $branch->trade_license) }}"
                                                    width="100px" alt="license">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="signature">Signature <span class="text-danger">*</span>
                                                    </label>
                                                </div>



                                                <img src="{{ asset('admin/center/signature/' . $branch->signature) }}"
                                                    width="100px" alt="signature">
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
    @endsection

    @section('script')
        <script></script>
    @endsection
