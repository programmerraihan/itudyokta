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
                        <h4 class="mb-0 font-size-18">Add Assignment</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Assignment</li>
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


                    <form action="{{  route('assignmentUpdate.number',  ['id' => $assignment->id])  }}" method="POST">
                        @csrf

                        <div class="col-lg-12">
                            <fieldset>
                                <legend> Result </legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body ">

                                            <div class="row">

                                                <div class="col-md-3">
                                                    <input type="hidden" hidden name="id"
                                                            value="{{$assignment->id  }}" 
                                                            class="form-control">
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="result">Result <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="result"
                                                            value="" placeholder="Result"
                                                            class="form-control">

                                                           
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                   
                                                </div>

                                           

                                            </div>




                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>







                        &nbsp;
                        &nbsp;
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="text-center">
                                                <button style="width: 250px" type="submit" class="btn btn-primary">Submit </button>
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
