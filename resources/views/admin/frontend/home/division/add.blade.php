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
                        <h4 class="mb-0 font-size-18">Add Division</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Division</li>
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
                                    <a href="{{ route('division.index') }}" class=" float-right btn btn-primary">Division</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Add Division</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">

                                    <form action="{{ route('store.division') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="name" class="form-control"
                                                        id="name">

                                                </div>
                                            </div>

                                        </div>


                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" hidden checked type="radio"
                                                    name="status" id="inlineCheckbox1" value="1">
                                                <label class="form-check-label" hidden
                                                    for="inlineCheckbox1">Published</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" hidden type="radio" name="status"
                                                    id="inlineCheckbox2" value="0">
                                                <label class="form-check-label" hidden
                                                    for="inlineCheckbox2">Unpublished</label>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="form-group ">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">Add
                                                                Division </button>
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

    </div>
@endsection
