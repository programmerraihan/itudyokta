@extends('student.student_master')

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
                        {{-- <h4 class="mb-0 font-size-18">Add Home Word</h4> --}}

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Online MCQ EXAM </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> MCQ Start Infomation </legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">

                                    <form action="{{ route('mcq.question', $id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="text">Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="name" value="{{auth('student')->user()->name}}" class="form-control">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="text">Phone <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" name="phone"  value="{{auth('student')->user()->mobile}}" class="form-control">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="text">Roll Number <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="roll"  value="{{auth('student')->user()->roll_no_student}}" class="form-control">

                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="form-group ">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">MCQ EXAM START
                                                            </button>
                                                        </div>
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
@endsection
