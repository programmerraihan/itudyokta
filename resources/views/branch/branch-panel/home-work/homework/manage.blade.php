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

        label{
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
                        <h4 class="mb-0 font-size-18">Add Home Work</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Home Work</li>
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
                                    <a href="{{ route('homework.index') }}" class=" float-right btn btn-primary">Home Work</a>
                                </h4> --}}


                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('branch.homework.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="col-lg-12">
                            <fieldset>
                                <legend> Home Work </legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body ">

                                            <div class="row">



                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="title">Title <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="title" placeholder="Title"
                                                            class="form-control">
                                                    </div>
                                                </div>



                                            </div>




                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="session">Session <span class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <select id="formrow-inputState" name="session_id"
                                                            class="form-control">
                                                            <option value="" disabled selected>-- Select Session --
                                                            </option>

                                                            @foreach ($sessions as $session)
                                                                <option value="{{ $session->id }}"> {{ $session->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="batch">Branch <span class="text-danger">*</span>
                                                        </label>
                                                        <select id="branch_id" name="branch_id"
                                                            class="form-control branch ">
                                                            <option value="" disabled selected>-- Select Branch --
                                                            </option>

                                                            @foreach ($branches as $branch)
                                                                <option value="{{ $branch->id }}"> {{ $branch->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="course titleid">Course<span class="text-danger">*</span>
                                                        </label>
                                                        <select id="course_title_id" name="course_title_id"
                                                            class="form-control course">
                                                            <option value="" disabled selected>-- Select Course --
                                                            </option>
                                                            @foreach ($courseTitles as $courseTitle)
                                                                <option value="{{ $courseTitle->id }}">
                                                                    {{ $courseTitle->title }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('course')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="next_due_date">Batch <span class="text-danger">*</span>
                                                        </label>
                                                        <select id="batch_id" name="batch_id" class="form-control">
                                                            <option value="" disabled selected>-- Select Batch --
                                                            </option>

                                                            @foreach ($batches as $batch)
                                                                <option value="{{ $batch->id }}"> {{ $batch->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="batch">Schedule <span class="text-danger">*</span>
                                                        </label>
                                                        @php
                                                            
                                                        @endphp
                                                        <select id="schedule_id" name="schedule_id" class="form-control">
                                                            <option value="" disabled selected>-- Select Schedule --
                                                            </option>

                                                            @foreach ($schedules as $schedule)
                                                                <option value="{{ $schedule->id }}">
                                                                    {{ json_encode($schedule->day) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                            </div>




                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="session">Teacher <span class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <select id="teacher_id" name="teacher_id" class="form-control">
                                                            <option value="" disabled selected>-- Select Teacher --
                                                            </option>

                                                            @foreach ($teachers as $teacher)
                                                                <option value="{{ $teacher->id }}"> {{ $teacher->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="sample_copy">Sample Copy <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <input type="file" name="sample_copy"
                                                            placeholder="Sample Copy" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="submission_deadline"> Submission Start
                                                                Deadline<span class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <input type="date" name="submission_deadline"
                                                            placeholder="Submission Deadline" class="form-control">

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="submission_end_deadline"> Submission End
                                                                Deadline<span class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <input type="date" name="submission_end_deadline"
                                                            placeholder="Submission  End Deadline" class="form-control">

                                                    </div>
                                                </div>




                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="input_file">
                                                            <label for="description">Description <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                        </div>

                                                        <textarea type="text" name="description" placeholder="Description" class="form-control"> </textarea>

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
                                    id="inlineCheckbox1" value="1">
                                <label class="form-check-label" hidden for="inlineCheckbox1">Published</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" hidden type="radio" name="status" id="inlineCheckbox2"
                                    value="0">
                                <label class="form-check-label" hidden for="inlineCheckbox2">Unpublished</label>
                            </div>
                        </div>

                       

                    

                        &nbsp;
                        &nbsp;
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="text-center">
                                            <button  style="width: 250px" type="submit" class="btn btn-primary">ADD
                                                Home Work </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        &nbsp;
                
                    </form>
                </div>
            </div>


        </div>
    </div>

    </div>
@endsection
