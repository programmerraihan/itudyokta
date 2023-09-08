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
                        <h4 class="mb-0 font-size-18">Edit Exam</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Edit Exam</li>
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
                        <legend> Edit Exam</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">
                                    <form action=" {{ route('assessment.exam.update', $exam->id) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-4">Edit Exam </h4>
                                                        <hr />

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name"> Exam Name</label>
                                                                    <input type="text" name="name"
                                                                        value="{{ $exam->name }}" class="form-control"
                                                                        id="name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name"> Exam session </label>

                                                                    <select class="form-control select2"
                                                                        id="formrow-inputStatea1" name="session_id" data-placeholder="Select a Session">
                                                                        <option value="" hidden>Select a Session</option>
                                                                        @foreach ($sessions as $session)
                                                                            <option value="{{ $session->id }}"
                                                                                {{ $session->id == $exam->session_id ? 'selected' : '' }}>
                                                                                {{ $session->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name"> Exam Batch </label>

                                                                    <select class="form-control select2" id="batch_id"
                                                                        name="batch_id" data-placeholder="Select a Batch">
                                                                        <option value="" hidden>Select a Batch</option>
                                                                        @foreach ($batches as $batch)
                                                                            <option value="{{ $batch->id }}"
                                                                                {{ $batch->id == $exam->batch_id ? 'selected' : '' }}>
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
                                                                            <option value="{{ $question->id }}" @if($question->id == $exam->question_id) selected @endif>
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
                                                            Edit
                                                            Exam </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
