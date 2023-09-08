@extends('website.layouts.layout')

@section('title', 'Admission Form - Itudyokta')

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body fw-bold">
                Admission Form
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <form method="POST" action="{{ route('store.student.frontend') }}" enctype="multipart/form-data">
            @csrf

            @forelse ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @empty
            @endforelse

            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-header bg-success text-light">Student Crediantials</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                    class="form-control" required="name"
                                    oninvalid="this.setCustomValidity('Enter Name  Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" name="mobile" class="form-control"
                                    placeholder="Personal Mobile Number" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Personal Mobile Number Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Passwoard Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
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
                <div class="card mt-3">
                    <div class="card-header bg-success text-light">Proprietor Information</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <input type="text" name="father_name" class="form-control" placeholder="  Father's Name"
                                    class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Father`s Name Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <input type="text" name="mother_name" class="form-control" placeholder=" Mother's Name"
                                    class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Mother`s Name Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <input type="text" name="present_address" class="form-control"
                                    placeholder=" Present Address" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Present Address Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <input type="text" name="permanent_address" class="form-control"
                                    placeholder=" Permanent Address" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Permanent Address Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <input type="date" name="date_of_birth" onfocus="(this.type='date')"
                                    onblur="if(!this.value)this.type='text'" class="form-control"
                                    placeholder="Date Of Birth" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Date Of Birth Here')"
                                    oninput="this.setCustomValidity('')" value="{{ date('dd-mm-yyyy') }}">
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Email Address Here')"
                                    oninput="this.setCustomValidity('')">
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <select class="form-select" name="gender" required=""
                                    oninvalid="this.setCustomValidity('Select Your Gender')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" hidden>Select a Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <select class="form-select" name="religion" required=""
                                    oninvalid="this.setCustomValidity('Select your Religion')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" hidden>Select a Religion</option>
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
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-header bg-success text-light">Academic Information</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" name="board_name" class="form-control"
                                    placeholder="S.S.C/J.S.C(Board)" class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="number" name="roll_no" class="form-control" placeholder="Roll No:"
                                    class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="number" name="reg_no" class="form-control" placeholder="Reg. No:"
                                    class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" name="year" class="form-control" placeholder="Year"
                                    class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" name="last_education_board" class="form-control"
                                    placeholder="Last Education" class="form-control">
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="number" name="last_education_roll" class="form-control"
                                    placeholder="Roll No:" class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="number" name="last_education_reg" class="form-control"
                                    placeholder="Reg. No:" class="form-control">
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" name="last_education_year" class="form-control" placeholder="Year"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-header bg-success text-light">Course Information</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <select class="form-select" name="session_id" required=""
                                    oninvalid="this.setCustomValidity('Select Name Of Batch')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" hidden>Session Name</option>
                                    @foreach ($sessions as $session)
                                        <option value="{{ $session->id }}"> {{ $session->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <select class="form-select" name="branch_id" id="branch_id" required=""
                                    oninvalid="this.setCustomValidity('Select Name Of Branch')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" hidden>Branch Name</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"> {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <select class="form-select course" name="course_title_id" id="course_title_id"
                                    required="" oninvalid="this.setCustomValidity('Select Name Of Course')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" hidden>Course Name</option>
                                    @foreach ($courseTitles as $courseTitle)
                                        <option value="{{ $courseTitle->id }}"> {{ $courseTitle->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <select class="form-select" name="batch_id" id="batch_id" required=""
                                    oninvalid="this.setCustomValidity('Select Name Of Batch')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" hidden>Batch Name</option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}"> {{ $batch->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <select class="form-select" name="schedule_id" id="schedule_id" required=""
                                    oninvalid="this.setCustomValidity('Select Name Of Schedul')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" hidden>Schedul Name</option>
                                    @foreach ($schedules as $schedul)
                                        <option value="{{ $schedul->id }}"> {{ $schedul->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <select class="form-select course" name="bank_id" id="bank_id" required=""
                                    oninvalid="this.setCustomValidity('Select Name Of Course')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" hidden>Fund Name</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}"> {{ $bank->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="number" name="price" id="price" class="form-control"
                                    placeholder=" Course Price" class="form-control" />
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="number" name="offer_price" id="offer_price" class="form-control"
                                    placeholder=" Course Price" class="form-control" />
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="number" name="payable_amount" data-id="5"
                                    class="form-control  payable_amount" id="pay_amount" onchange="calculate()"
                                    placeholder="Payable Amount" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Payable Amount Here')"
                                    oninput="this.setCustomValidity('')" />
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="number" name="due_amount" id="due_amount" class="form-control"
                                    placeholder="Deu Amount" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Deu Amount Here')"
                                    oninput="this.setCustomValidity('')" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="date" name="next_due_date" onfocus="(this.type='date')"
                                    onblur="if(!this.value)this.type='text'" class="form-control"
                                    placeholder=" Next Due Date" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Next Due Date  Here')"
                                    oninput="this.setCustomValidity('')" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="date" name="course_start_date" onfocus="(this.type='date')"
                                    onblur="if(!this.value)this.type='text'" class="form-control"
                                    placeholder="  Course Start Date  " class="form-control" required=""
                                    oninvalid="this.setCustomValidity('Enter Proprietor Course Start Date  Here')"
                                    oninput="this.setCustomValidity('')" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-header bg-success text-light">Student Crediantials</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <h4>Documents</h4>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input_file">
                                    <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}"
                                        id="profilePhoto" style="width: 150px;height:150px;">
                                    <p> Profile Picture</p>
                                </div>
                                <input type="file" name="image" onchange="profile(event)" class="form-control">
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input_file">
                                    <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}" id="nidCard"
                                        style="width: 150px;height:150px;">
                                    <p> NID/Birth Certificate </p>
                                </div>
                                <input type="file" name="nid" onchange="nidInput(event)" class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input_file">
                                    <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}" id="trade"
                                        style="width: 150px;height:150px;">
                                    <p> Certificate S.S.C</p>
                                </div>
                                <input type="file" name="certificate" onchange="tradeInput(event)"
                                    class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input_file">
                                    <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}" id="signature"
                                        style="width: 150px;height:150px;">
                                    <p>Signature</p>
                                </div>
                                <input type="file" name="signature" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Apply Now</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('js')

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        calculate = function() {
            var resources = document.getElementById('offer_price').value;
            var minutes = document.getElementById('pay_amount').value;
            document.getElementById('due_amount').value = parseInt(resources) - parseInt(minutes);

        }
    </script>



    <script>
        $(document).ready(function() {
            $('.course').on('change', function() {
                var id = $('#course_title_id option:selected').val();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('student.course.price') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',

                    success: function(response) {

                        $('#offer_price').val(response.offer_price);
                        $('#price').val(response.price);
                    },
                });
            });



            $('#batch_id').on('change', function() {
                var id = $('#batch_id option:selected').val();
                $('#schedule_id').html('');
                $.ajax({
                    url: '{{ route('batch.wish.schedule') }}?id=' + id,
                    type: 'get',
                    success: function(res) {
                        $('#schedule_id').html(
                            '<option value="">Select schedule ... </option>');
                        $.each(res, function(key, value) {
                            $('#schedule_id').append('<option value="' + value
                                .id + '">' + value.day + '</option>');
                        });
                    }
                });
            });
        });

        $('#branch_id').on('change', function() {
            var branch_id = $('#branch_id option:selected').val();
            $('#course_title_id').html('');
            $.ajax({
                url: '{{ route('branchWishCourse') }}?branch_id=' + branch_id,
                type: 'get',
                success: function(res) {
                    $('#course_title_id').html(
                        '<option value="">Select Your Course ... </option>');
                    $.each(res, function(key, value) {
                        $('#course_title_id').append('<option value="' + value.id +
                            '">' + value.title + '</option>');
                    });
                }
            });
        });

        $('#course_title_id').on('change', function() {
            var course_title_id = $('#course_title_id option:selected').val();
            $('#batch_id').html('');
            $.ajax({
                url: '{{ route('courseWishBatchGet') }}?course_title_id=' + course_title_id,
                type: 'get',
                success: function(res) {
                    $('#batch_id').html('<option value="">Select Batch ... </option>');
                    $.each(res, function(key, value) {
                        $('#batch_id').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>
@endsection
