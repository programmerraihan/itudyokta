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
                        <h4 class="mb-0 font-size-18">Add Exam</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Exam</li>
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

                                {{-- <h4>
                                    <a href="{{ route('studentUnit.index') }}" class=" float-right btn btn-primary">Student Unit</a>
                                </h4> --}}


                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Add Exam</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">
                                    <form action=" {{ route('assessment.exam.store') }} " method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-4">New Exam </h4>
                                                        <hr />

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name"> Exam Name</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" id="name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name"> Exam session </label>

                                                                    <select class="form-control select2"
                                                                        id="formrow-inputStatea1" name="session_id"
                                                                        data-placeholder="Select a Session">
                                                                        <option value="" hidden>Select a Session
                                                                        </option>
                                                                        @foreach ($sessions as $session)
                                                                            <option value="{{ $session->id }}">
                                                                                {{ $session->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input_file">
                                                                        <label for="session">Branch <span
                                                                                class="text-danger">*</span>
                                                                        </label>
                                                                    </div>
                                                                    <select name="branch_id" id="branch_id"
                                                                        class="form-control">
                                                                        <option value="no">-- Select a Branch --
                                                                        </option>

                                                                        @foreach ($branches as $branch)
                                                                            <option value="{{ $branch->id }}">
                                                                                {{ $branch->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="formrow-inputState">Course<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <select value="no" name="course_title_id"
                                                                        id="course_title_id" class="form-control">
                                                                        <option value="no">-- Select Course --</option>

                                                                        @foreach ($courses as $course)
                                                                            <option value="{{ $course->id }}">
                                                                                {{ $course->title }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    @error('course')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name"> Exam Batch </label>
                                                                    <select class="form-control select2" id="batch_id"
                                                                        name="batch_id" data-placeholder="Select a Batch">
                                                                        <option hidden value="">Select a Batch</option>
                                                                        @foreach ($batches as $batch)
                                                                            <option value="{{ $batch->id }}">
                                                                                {{ $batch->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="question_id">Question Name</label>
                                                                    <select class="form-control select2" id="question_id"
                                                                        name="question_id" data-placeholder="Select a Question">
                                                                        <option hidden value="">Select a Question</option>
                                                                        @foreach ($questions as $question)
                                                                            <option value="{{ $question->id }}">
                                                                                {{ $question->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body pb-1">
                                                    <div class="form-group ">
                                                        <button type="submit" class="btn btn-primary w-md btn-block">Create
                                                            New
                                                            Exam </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- 
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" hidden checked type="radio" name="status"
                                                    id="inlineRadio1" value="1" />
                                                <label class="form-check-label" hidden for="inlineRadio1"> Approved </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" hidden type="radio" name="status" id="inlineRadio2"
                                                    value="0" />
                                                <label class="form-check-label" hidden for="inlineRadio2"> Refuse</label>
                                            </div>
                
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>






        </div>
    </div>

    </div>
@endsection
