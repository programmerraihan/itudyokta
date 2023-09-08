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

            {{-- @dd($courseTitles) --}}
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Certificate Requisitions</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Certificate Requisitions</li>
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

            <form action="{{ route('branch.store.requisition') }}" method="POST" class="form-horizontal"
                enctype="multipart/form-data" target="_blank">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <fieldset>
                                <legend> Certificate Requisitions </legend>
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

                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="next_due_date">SMS Text <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <textarea type="text" name="text" class="form-control"></textarea>

                                                    </div>
                                                </div>
                                            </div>

                                            <a class="btn btn-success" id="find">Find</a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div id="student_id">

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
            $('#find').on('click', function() {
                var session_id = $('#session_id option:selected').val();
                var branch_id = $('#branch_id option:selected').val();
                var batch_id = $('#batch_id option:selected').val();
                var course_id = $('#course_title_id option:selected').val();

                // console.log($branch_id);

                $('#student_id').html('');
                $.ajax({
                    url: '{{ route('branch.requisition.students') }}',
                    // dataType: 'json',
                    data: {
                        session_id: session_id,
                        branch_id: branch_id,
                        batch_id: batch_id,
                        course_id: course_id,
                    },
                    method: "GET",
                    success: function(res) {
                        $('#student_id').html(res);
                    }
                });
            });
        });
    </script>
@endsection
