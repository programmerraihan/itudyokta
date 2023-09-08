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

            <form method="POST" action="{{ route('store.branch') }}" enctype="multipart/form-data">
                @csrf

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
                                                <input type="text" name="personal_name"   placeholder="Name" class="form-control" id="name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="father_name">Father's Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="father_name"  placeholder=" Father's Name" class="form-control"
                                                    id="father_name">
                                            </div>
                                        </div>
                                    </div>

                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="mother_name">Mother's Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="mother_name"  placeholder=" Mother's Name" class="form-control"
                                                    id="mother_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobil">Mobil Number <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="mobil" placeholder=" Mobil Number"
                                                    class="form-control" id="mobil">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"> Email Address <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="personal_email" name="personal_email"
                                                    placeholder=" Email Address" class="form-control"
                                                    id="email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">Gender<span class="text-danger">*</span>
                                                </label>
                                                <select id="formrow-inputState" name="gender" class="form-control">
                                                    <option value="" disabled selected>-- Select Gender --
                                                    </option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
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
                                                <select id="formrow-inputState" name="religion" class="form-control">
                                                    <option value="" disabled selected>-- Select Religion --
                                                    </option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Sanatan">Sanatan</option>
                                                    <option value="Buddhism">Buddhism</option>
                                                    <option value="Christian">Christian</option>
                                                    <option value="Other">Other</option>
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
                                                <input type="text" name="nationality" placeholder="Nationality"
                                                    class="form-control" id="nationality">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district_id">Division <span
                                                        class="text-danger">*</span> </label>
                                                <select id="division_id" name="division_id" class="form-control">
                                                    <option value="" disabled selected>-- Select Division --
                                                    </option>

                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}"> {{ $division->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district_id">District <span
                                                        class="text-danger">*</span> </label>
                                                <select id="district_id" name="district_id" class="form-control">
                                                    <option value="" disabled selected>-- Select District --
                                                    </option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}"> {{ $district->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">City <span
                                                        class="text-danger">*</span> </label>
                                                <select id="city_id" name="city_id" class="form-control">
                                                    <option value="" disabled selected>-- Select City --
                                                    </option>
                                                    @foreach ($citys as $city)
                                                        <option value="{{ $city->id }}"> {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="upazila">Upazila <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="upazila" placeholder="Upazila"
                                                    class="form-control" id="upazila">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="post_office"> Post Office <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="post_office"
                                                    placeholder="Post Office" class="form-control"
                                                    id="post_office">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="address" placeholder="Address"
                                                    class="form-control" id="address">
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
                        <legend>Personal Information
                        </legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institute_name">Institute Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="institute_name"   placeholder="Institute Name " class="form-control" id="institute_name">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institute_name_bangla">Institute Name Bangla <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="institute_name_bangla"  placeholder="Institute Name Bangla" class="form-control"
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
                                                <input type="text" name="institute_mobil" placeholder="Institute Mobil Number"
                                                    class="form-control" id="institute_mobil">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="institute_email"> Institute Email Address <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="email" name="institute_email"
                                                    placeholder=" Institute  Email Address" class="form-control"
                                                    id="institute_email">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institute_facebook">Institute Facebook Link <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="institute_facebook"  placeholder="Institute Facebook Link" class="form-control"
                                                    id="institute_facebook">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="account_type">Account Type<span class="text-danger">*</span>
                                                </label>
                                                <select id="account_type" name="account_type" class="form-control">
                                                    <option value="" disabled selected>-- Select Account Type --
                                                    </option>

                                                    <option value="personal_institute">Personal Institute </option>
                                                    <option value="joind_venture_institute ">Joind Venture Institute </option>
                                                    
                                                </select>

                                               
                                            </div>
                                        </div>

                                      

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="number_institute">Number of Institute <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" name="number_institute" placeholder="Number of Institute "
                                                    class="form-control" id="number_institute">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="institute_age">Institute Age <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="institute_age" placeholder="Institute Age "
                                                    class="form-control" id="institute_age">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">Division <span
                                                        class="text-danger">*</span> </label>
                                                <select id="institute_division_id" name="institute_division_id" class="form-control">
                                                    <option value="" disabled selected>-- Select Division --
                                                    </option>

                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}"> {{ $division->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                              
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">District <span
                                                        class="text-danger">*</span> </label>
                                                <select id="institute_district_id" name="institute_district_id" class="form-control">
                                                    <option value="" disabled selected>-- Select District --
                                                    </option>

                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}"> {{ $district->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                              
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="formrow-inputState">City <span
                                                        class="text-danger">*</span> </label>
                                                <select id="institute_city_id" name="institute_city_id" class="form-control">
                                                    <option value="" disabled selected>-- Select City --
                                                    </option>

                                                    @foreach ($citys as $city)
                                                        <option value="{{ $city->id }}"> {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                              
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="upazila">Upazila <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="institute_upazila" placeholder="Upazila"
                                                    class="form-control" id="upazila">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="post_office"> Post Office <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="institute_post_office"
                                                    placeholder="Post Office" class="form-control"
                                                    id="post_office">

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="institute_address" placeholder="Address"
                                                    class="form-control" id="address">

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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="profile">Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="text" name="name" placeholder="Name"
                                                    class="form-control" id="profile">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="nid">Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="email" name="email" placeholder="Email"
                                                    class="form-control" id="email">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="text">Password<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="password" name="password" placeholder="Password"
                                                    class="form-control" id="password">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="password_confirmation">Password Confirmation <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="password" name="password_confirmation" placeholder="Password Confirmation"
                                                    class="form-control" id="password_confirmation">
                                            </div>
                                        </div>

                                    </div>

                                    {{-- <div class="row">
                                      
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="nid">Slug <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="name" name="slug" placeholder="Slug"
                                                    class="form-control" id="email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="text">Password<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="password" name="password" placeholder="Password"
                                                    class="form-control" id="password">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="password_confirmation">Password Confirmation <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="password" name="password_confirmation" placeholder="Password Confirmation"
                                                    class="form-control" id="password_confirmation">
                                            </div>
                                        </div>

                                    </div> --}}


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
                                                <input type="file" name="profile" placeholder="Price"
                                                    class="form-control" id="profile">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="nid">NID <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="file" name="nid" placeholder="NID"
                                                    class="form-control" id="nid">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input_file">
                                                    <label for="trade_license">Treade License <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <input type="file" name="trade_license" placeholder="Treade License"
                                                    class="form-control" id="trade_license">
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
                            id="inlineCheckbox1" value="0">
                        <label class="form-check-label" hidden for="inlineCheckbox1">Published</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" hidden type="radio" name="status" id="inlineCheckbox2"
                            value="1">
                        <label class="form-check-label" hidden for="inlineCheckbox2">Unpublished</label>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Add
                                                Project </button>
                                        </div>
                                    </div>
                                </div>
                             

                            </div>

                        </div>
                    </div>
                </div>
            

            </div>

        </form>


        </div>
    </div>

    </div>
@endsection

@section('script')
    <script>

    
            $('#division_id').on('change', function () {
                var id = $('#division_id option:selected').val();
              //  console.log(id);
                // Use For Get Class Wise Group
                $('#district_id').html('');
                $.ajax({
                    url: '{{ route('division.wish.district') }}?id='+id,
                    type: 'get',
                    success: function (res) {
                        $('#district_id').html('<option value="">Select District ... </option>');
                        $.each(res, function (key, value) {
                            $('#district_id').append('<option value="' + value
                                .id + '">' +value.name+ '</option>');
                        });
                    }
                });
            });


            $('#district_id').on('change', function () {
                var id = $('#district_id option:selected').val();
              //  console.log(id);
                // Use For Get Class Wise Group
                $('#city_id').html('');
                $.ajax({
                    url: '{{ route('district.wish.city') }}?id='+id,
                    type: 'get',
                    success: function (res) {
                        $('#city_id').html('<option value="">Select City ... </option>');
                        $.each(res, function (key, value) {
                            $('#city_id').append('<option value="' + value
                                .id + '">' +value.name+ '</option>');
                        });
                    }
                });
            });

            
            $('#institute_division_id').on('change', function () {
                var id = $('#institute_division_id option:selected').val();
               // console.log(id);
                // Use For Get Class Wise Group
                $('#institute_district_id').html('');
                $.ajax({
                    url: '{{ route('institute_division.wish.institute_district') }}?id='+id,
                    type: 'get',
                    success: function (res) {
                        $('#institute_district_id').html('<option value="">Select District ... </option>');
                        $.each(res, function (key, value) {
                            $('#institute_district_id').append('<option value="' + value
                                .id + '">' +value.name+ '</option>');
                        });
                    }
                });
            });

            
            $('#institute_district_id').on('change', function () {
                var id = $('#institute_district_id option:selected').val();
                //console.log(id);
                // Use For Get Class Wise Group
                $('#batch_id').html('');
                $.ajax({
                    url: '{{ route('institute_district.wish.institute_city') }}?id='+id,
                    type: 'get',
                    success: function (res) {
                        $('#institute_city_id').html('<option value="">Select City ... </option>');
                        $.each(res, function (key, value) {
                            $('#institute_city_id').append('<option value="' + value
                                .id + '">' +value.name+ '</option>');
                        });
                    }
                });
            });

       
     

    
        
      
    </script>
@endsection 
