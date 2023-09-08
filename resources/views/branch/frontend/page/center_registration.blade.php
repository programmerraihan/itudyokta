@extends('branch.frontend.include.main_master')
@section('css')
    <style type="text/css">
        nav {
            width: 100%;
            z-index: 5;
            text-align: center;
        }

            {
            color: #fff !important;
        }



        nav ul li {
            padding: 10px 10px;
            transition: 0.4s;
        }

        nav ul li a {
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
        }

        nav ul li .active {
            color: #ffd900;
        }

        nav ul li:hover a {
            color: #fff;
        }

        @media (max-width: 767px) {

            nav {
                /*background: #000;*/
                margin-bottom: 30px;
            }

            nav button {
                background: #f00;
                color: #4e00cc;

            }

        }

        .fixed {
            position: fixed;
            top: 0;
        }

        * {
            box-sizing: border-box;
        }

        #parent {
            color: #fff;
            padding: 10px;
            width: 100%;

            text-align: center;
        }

        .fab {
            padding: 20px;
            font-size: 30px;
            color: #fff;
            width: 50px;
            text-align: center;
            text-decoration: none;
        }
    </style>
@endsection
@section('mian')
@include('branch.frontend.include.top_header')
@include('branch.frontend.include.navbar')
@include('branch.frontend.include.slide_other')

    <section class="title_bar">
        <div class="container">
            <div>
                <h4><i class="fas fa-university"></i> New Centre Registration </h4>
            </div>
        </div>
    </section>



    <section class="container">
        
        <form method="POST" action="{{ route('store.branch') }}" class="application" enctype="multipart/form-data">
            @csrf


            <input type="hidden" name="token" value="">
            <div class="row">
                <!-- Start Proprietor -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h4> Proprietor Information </h4>

                    <input type="text" name="personal_name" class="form-control" placeholder=" Name" class="form-control"
                        required="" oninvalid="this.setCustomValidity('Enter Proprietor Name Here')"
                        oninput="this.setCustomValidity('')">

                    <input type="text" name="father_name" class="form-control" placeholder="  Father's Name"
                        class="form-control" required=""
                        oninvalid="this.setCustomValidity('Enter Proprietor Father`s Name Here')"
                        oninput="this.setCustomValidity('')">

                    <input type="text" name="mother_name" class="form-control" placeholder=" Mother's Name"
                        class="form-control" required=""
                        oninvalid="this.setCustomValidity('Enter Proprietor Mother`s Name Here')"
                        oninput="this.setCustomValidity('')">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <input type="text" name="mobil" class="form-control"
                                placeholder="Personal Mobile Number" class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Personal Mobile Number Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <input type="email" name="personal_email" class="form-control"
                                placeholder="Personal Email Address" class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Personal Email Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <select class="form-select" name="gender" required=""
                                oninvalid="this.setCustomValidity('Select Your Gender')"
                                oninput="this.setCustomValidity('')">
                                <option value="">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
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
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <input type="text" name="nationality" placeholder="Nationality" class="form-control"
                                required="" oninvalid="this.setCustomValidity('Enter Your Roll Number Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <select class="form-select" name="division_id" required=""
                                oninvalid="this.setCustomValidity('Select Your Division')"
                                oninput="this.setCustomValidity('')">
                                <option value="" disabled selected>-- Select Division --
                                </option>

                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"> {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <select class="form-select" name="district_id" required=""
                                oninvalid="this.setCustomValidity('Select Your Division')"
                                oninput="this.setCustomValidity('')">
                                <option value="" disabled selected>-- Select District --
                                </option>

                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"> {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                            </select>

                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <select class="form-select" name="city_id" required=""
                                oninvalid="this.setCustomValidity('Select Your City')"
                                oninput="this.setCustomValidity('')">
                                <option value="" disabled selected>-- Select City --
                                </option>

                                @foreach ($citys as $city)
                                    <option value="{{ $city->id }}"> {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <input type="text" name="upazila" class="form-control" placeholder="Upazila"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Upazila Here')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <input type="text" name="post_office" class="form-control"
                                placeholder="Post-Office (Post-Code)" class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Post Office Here')"
                                oninput="this.setCustomValidity('')">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <input type="text" name="address" class="form-control"
                                placeholder=" Address (street/village)" class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Proprietor Address Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>


                </div>
                <!-- End Propritor info -->


                <!--  -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h4> Institute Information </h4>

                    <input type="text" name="institute_name" placeholder="Institute Name" class="form-control"
                        required="" oninvalid="this.setCustomValidity('Enter Your Institute Name Here')"
                        oninput="this.setCustomValidity('')">
                    <input type="text" name="institute_name_bangla" placeholder="Institute Name In Bangla" class="form-control"
                        required="" oninvalid="this.setCustomValidity('Enter Your Institute Name Here')"
                        oninput="this.setCustomValidity('')">


                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <input type="text" name="institute_email" placeholder="Institute Email" class="form-control"
                                required="" oninvalid="this.setCustomValidity('Enter Institute Email Here')"
                                oninput="this.setCustomValidity('')">

                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <input type="text" name="institute_mobil" placeholder="Mobile Number" class="form-control"
                                required=""
                                oninvalid="this.setCustomValidity('Enter Your Institute Mobile Number Here')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>


                    <input type="text" name="institute_facebook" placeholder="Facebook Link" class="form-control"
                        required="" oninvalid="this.setCustomValidity('Enter Your Institute Facebook Link Here')"
                        oninput="this.setCustomValidity('')">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <select class="form-control" name="account_type">
                                <option value="">Select Account Type</option>
                                <option value="Personal Institute"> Personal Institute</option>
                                <option value="Join Venture Institute"> Join Venture Institute</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <input type="number" name="number_institute" placeholder="Number of Computers"
                                class="form-control" required=""
                                oninvalid="this.setCustomValidity('Enter Total Amount of Computer`s')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="number" name="institute_age" placeholder="Institute Age's" class="form-control"
                                required="" oninvalid="this.setCustomValidity('Enter Your Institute Age`s Here')"
                                oninput="this.setCustomValidity('')">
                        </div>


                        <!-- address row -->
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <select class="form-select" name="institute_division_id" required=""
                                    oninvalid="this.setCustomValidity('Select Your Institute Division')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" disabled selected>-- Select Division --
                                    </option>

                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}"> {{ $division->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <select class="form-select" name="institute_district_id" required=""
                                    oninvalid="this.setCustomValidity('Select Your Institute Division')"
                                    oninput="this.setCustomValidity('')">
                                    <<option value="" disabled selected>-- Select District --
                                    </option>

                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"> {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <select class="form-select" name="institute_city_id" required=""
                                    oninvalid="this.setCustomValidity('Select Your Institute City')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" disabled selected>-- Select City --
                                    </option>

                                    @foreach ($citys as $city)
                                        <option value="{{ $city->id }}"> {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input type="text" name="institute_upazila" class="form-control"
                                    placeholder="Upazila" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Institute Upazila Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input type="text" name="institute_post_office" class="form-control"
                                    placeholder="Post-Office (Post-Code)" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Institute Post Office Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input type="text" name="institute_address" placeholder=" Address(street/village)"
                                    class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Your Institute Address Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>

                        </div>
                        <!-- end address -->

                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" hidden checked type="radio"
                                    name="status" id="inlineCheckbox1" value="0">
                                <label class="form-check-label" hidden
                                    for="inlineCheckbox1">Published</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" hidden type="radio" name="status"
                                    id="inlineCheckbox2" value="1">
                                <label class="form-check-label" hidden
                                    for="inlineCheckbox2">Unpublished</label>
                            </div>
                        </div>





                    </div>

                </div>

            </div>
            <!--  -->

            <div class="row">
                <h4>Branch Confidential</h4>
                
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <input type="text" name="name" class="form-control"
                            placeholder="Name" class="form-control" required="name"
                            oninvalid="this.setCustomValidity('Enter Name  Here')"
                            oninput="this.setCustomValidity('')">
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <input type="email" name="email" class="form-control"
                            placeholder="Email" class="form-control" required=""
                            oninvalid="this.setCustomValidity('Enter Email Address Here')"
                            oninput="this.setCustomValidity('')">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <input type="password" name="password" class="form-control"
                            placeholder="Password" class="form-control" required=""
                            oninvalid="this.setCustomValidity('Enter Passwoard Here')"
                            oninput="this.setCustomValidity('')">
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                            class="form-control" required=""
                            oninvalid="this.setCustomValidity('Enter Confirm Password Here')"
                            oninput="this.setCustomValidity('')">
                    </div>
                </div>
                
                

            </div>

            <div class="row">
                <h4>Documents</h4>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="input_file">
                        <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}" id="profilePhoto">
                        <p> Profile Picture</p>
                    </div>
                    <input type="file" name="profile" onchange="profile(event)" class="form-control" required=""
                        oninvalid="this.setCustomValidity('Upload Propritor Image')" oninput="this.setCustomValidity('')">
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="input_file">
                        <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}" id="nidCard">
                        <p> NID Card</p>
                    </div>
                    <input type="file" name="nid" onchange="nidInput(event)" class="form-control" required=""
                        oninvalid="this.setCustomValidity('Upload NID Card Copy')" oninput="this.setCustomValidity('')">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="input_file">
                        <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}" id="trade">
                        <p> Treade License</p>
                    </div>
                    <input type="file" name="trade_license" onchange="tradeInput(event)" class="form-control"
                        required="" oninvalid="this.setCustomValidity('Upload Trade License Copy')"
                        oninput="this.setCustomValidity('')">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="input_file">
                        <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}" id="signature">
                        <p>Signature</p>
                    </div>
                    <input type="file" name="signature" onchange="signatureInput(event)" class="form-control"
                        required="" oninvalid="this.setCustomValidity('Upload Propritor Valid signature')"
                        oninput="this.setCustomValidity('')">
                </div>

            </div>

            <div class="my_glass_button ">
                <div>
                    <button type="submit"> Apply Now</button>
                </div>
            </div>
        </form>
    </section>

    <div style="clear: both;"></div>
    &nbsp;
    &nbsp;
@endsection

@section('js')
    <script>
        var stickyOffset = $('.sticky').offset().top;

        $(window).scroll(function() {
            var sticky = $('.sticky'),
                scroll = $(window).scrollTop();

            if (scroll >= stickyOffset) sticky.addClass('fixed');
            else sticky.removeClass('fixed');
        });
    </script>
@endsection
