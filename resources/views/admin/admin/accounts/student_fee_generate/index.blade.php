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
                                    {{-- <a href="{{ route('fee_save') }}" class=" float-right btn btn-primary">Student</a> --}}
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('fee_save') }}" method="POST" class="form-horizontal" enctype="multipart/form-data"
                target="_blank">
                @csrf
                <div class="row">
                    <div class="col-lg-12">


                        <div class="col-lg-12">
                            <fieldset>
                                <legend> Student Fee Collection From </legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body ">

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="session">Session <span class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <select name="session_id" id="session_id" class="form-control">
                                                            <option value="no">-- Select Session --</option>

                                                            @foreach ($sessions as $session)
                                                                <option value="{{ $session->id }}"> {{ $session->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="session">Branch <span class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <select name="branch_id" id="branch_id" class="form-control">
                                                            <option value="no">-- Select Branch --</option>

                                                            @foreach ($branches as $branch)
                                                                <option value="{{ $branch->id }}"> {{ $branch->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="formrow-inputState">Course<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select value="no" name="course_title_id" id="course_title_id"
                                                            class="form-control">
                                                            <option value="no">-- Select Course --</option>

                                                            @foreach ($courseTitles as $courseTitle)
                                                                <option value="{{ $courseTitle->id }}">
                                                                    {{ $courseTitle->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('course')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="next_due_date">Batch <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="batch_id" id="batch_id" class="form-control">
                                                            <option value="no">-- Select Batch --</option>
                                                            @foreach ($batches as $batch)
                                                                <option value="{{ $batch->id }}"> {{ $batch->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="batch">Student <span class="text-danger">*</span>
                                                        </label>
                                                        <select id="student_id" name="student_id"
                                                            class="form-control js-example-basic-single">
                                                            <option value="no">-- Select Student --</option>
                                                            @foreach ($students as $student)
                                                                <option value="{{ $student->id }}"> {{ $student->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        {{-- <div id="ladger"> </div> --}}

                        <div class="col-lg-8 center">
                            <fieldset>
                                <legend> Save Fees Info.</legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body ">



                                            {{-- <div class="form-group">
                                                <label class="col-md-3">Head :</label>
                                                <select id="account_head_type_id" name="account_head_type_id"
                                                    class="form-control course">
                                                    <option value="" disabled selected>-- Select Account Head --
                                                    </option>
                                                    @foreach ($accountHeads as $accountHead)
                                                        <option value="{{ $accountHead->id }}">
                                                            {{ $accountHead->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('course')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            <div class="form-group">
                                                <label class="col-md-3">Head Name:</label>
                                                <select class="col-md-8" name="account_head_id" style="height: 30px;">
                                                    <option value="">Select AC Head .....</option>
                                                    @foreach ($accountHeads as $accountHead)
                                                        <option value="{{ $accountHead->id }}">
                                                            {{ $accountHead->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-3">Month:</label>
                                                <input type="month" name="fee_date" class="col-md-8"
                                                    style="height: 30px;">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3">Title:</label>
                                                <input type="text" name="title" class="col-md-8"
                                                    style="height: 30px;">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3">Amount:</label>
                                                <input type="number" name="amount" class="col-md-8"
                                                    style="height: 30px;">
                                            </div>
                                            <div style="float: right;">
                                                <button type="submit" class="btn btn-success btnconf">Submit</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </fieldset>
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
        // $(document).on('click', '#purchaseItemBtn', function() {
        $(document).ready(function() {
            // Use For select2 dropdown on students
            $('.js-example-basic-single').select2();

            $('#course_title_id').on('change', function() {
                var course_title_id = $('#course_title_id option:selected').val();
                // Use For Get Class Wise Group
                $('#batch_id').html('');
                $.ajax({
                    url: '{{ route('getBatches') }}?course_title_id=' + course_title_id,
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

            // Use For Get student by details
            $('#session_id,#branch_id,#batch_id,#course_title_id').on('change', function() {
                getStudentsDetails();
            });

            $('#student_id').on('change', function() {
                var id = this.value;
                // console.log(id);
                $.ajax({
                    url: '{{ route('student.payment.create') }}?student_id=' + id,
                    type: 'get',
                    success: function(res) {
                        $('#ladger').html(res);
                    }
                });
            });

        });

        function getStudentsDetails() {
            var session_id = $('#session_id option:selected').val();
            var branch_id = $('#branch_id option:selected').val();
            var batch_id = $('#batch_id option:selected').val();
            var course_id = $('#course_title_id option:selected').val();

            $('#student_id').html('');
            $.ajax({
                url: '{{ route('getStudents') }}',
                dataType: 'json',
                data: {
                    session_id: session_id,
                    branch_id: branch_id,
                    batch_id: batch_id,
                    course_id: course_id,
                },
                method: "GET",
                success: function(res) {
                    $('#student_id').html('<option value="no">Select Student ... </option>');
                    $.each(res, function(key, value) {
                        $('#student_id').append('<option value="' + value.student.id + '">' +
                            value.student.name + ' - ' + value.student.mobile +
                            '</option>');
                    });
                }
            });
        }
    </script>
@endsection
