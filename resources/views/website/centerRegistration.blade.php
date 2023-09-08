@extends('website.layouts.layout')

@section('title', 'Center Registration')

@section('content')
    <form method="POST" action="{{ route('store.branch') }}" class="application" enctype="multipart/form-data">
        @csrf

        <div class="col-sm-12">
            <div class="card mb-3 shadow">
                <div class="card-header bg-success text-light">Center Registration</div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card mb-3 shadow">
                <div class="card-header bg-success text-light">Proprietor Information</div>
                <div class="card-body">
                    <input type="hidden" name="token" value="">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="personal_name" class="form-control" placeholder=" Name"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Name Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="father_name" class="form-control" placeholder="  Father's Name"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Father`s Name Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="mother_name" class="form-control" placeholder=" Mother's Name"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Mother`s Name Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="mobil" class="form-control" placeholder="Personal Mobile Number"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Personal Mobile Number Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="email" name="personal_email" class="form-control"
                                placeholder="Personal Email Address" class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Personal Email Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <select class="form-select" name="gender" required=""
                                oninvalid="this.setCustomValidity('Select Your Gender')"
                                oninput="this.setCustomValidity('')">
                                <option value="">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>

                        <div class="col-md-4 col-sm-12 mb-3">
                            <select class="form-select" name="religion" required=""
                                oninvalid="this.setCustomValidity('Select your Religion')"
                                oninput="this.setCustomValidity('')">
                                <option value="">Religion</option>
                                <option value="Islam">Islam</option>
                                <option value="Sanatan">Sanatan</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Christian">Christian</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>
                        <div class="col-md-8 col-sm-12 mb-3">
                            <input type="text" name="nationality" placeholder="Nationality" class="form-control"
                                required="" oninvalid="this.setCustomValidity('Enter Your Roll Number Here')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="col-md-12 col-sm-12 mb-3">
                            <input type="text" name="address" class="form-control" placeholder="Address"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Address Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>
                    <!-- End Propritor info -->
                </div>
            </div>
        </div>


        <div class="col-sm-12">
            <div class="card mb-3 shadow">
                <div class="card-header bg-success text-light">Institute Information</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="institute_name" placeholder="Institute Name"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Your Institute Name Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="institute_name_bangla" placeholder="Institute Name In Bangla"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Your Institute Name Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="institute_email" placeholder="Institute Email"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Institute Email Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="institute_mobil" placeholder="Mobile Number"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Your Institute Mobile Number Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="institute_facebook" placeholder="Facebook Link"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Your Institute Facebook Link Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="institute_address" placeholder=" Institute Address"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Your Institute Address Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card mb-3 shadow">
                <div class="card-header bg-success text-light">Branch Confidential</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                class="form-control" required="name"
                                oninvalid="this.setCustomValidity('Enter Name  Here')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Email Address Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Passwoard Here')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="col-md-4 col-sm-12 mb-3">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm Password" class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Confirm Password Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card mb-3 shadow">
                <div class="card-header bg-success text-light">Documents</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profile" onchange="profile(event)" class="form-control"
                                required="" oninvalid="this.setCustomValidity('Upload Propritor Image')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="col-md-4 col-sm-12 mb-3">
                            <label class="form-label">NID Card</label>
                            <input type="file" name="nid" onchange="nidInput(event)" class="form-control"
                                required="" oninvalid="this.setCustomValidity('Upload NID Card Copy')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <label class="form-label">Trade License</label>
                            <input type="file" name="trade_license" onchange="tradeInput(event)" class="form-control"
                                required="" oninvalid="this.setCustomValidity('Upload Trade License Copy')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3">
                            <label class="form-label">Signature</label>
                            <input type="file" name="signature" onchange="signatureInput(event)" class="form-control"
                                required="" oninvalid="this.setCustomValidity('Upload Propritor Valid signature')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <button class="btn btn-success" type="submit">Apply Now</button>
                </div>
            </div>
        </div>
    </form>
@endsection
