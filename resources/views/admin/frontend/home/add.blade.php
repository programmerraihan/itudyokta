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
                        <h4 class="mb-0 font-size-18">Add Sidebar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Sidebar</li>
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
                                {{-- <button type="button" class=" float-right btn btn-primary">Add Slider
                                </button> --}}
                                <h4>
                                    <a href="{{ route('home.slide') }}" class=" float-right btn btn-primary">Home Slider</a>
                                </h4>

                                {{-- <h4 class="float-right font-size-16">Order # 12345</h4> --}}
                                {{-- <div class="mb-4">
                                    <img src="assets/images/logo-dark.png" alt="logo" height="20" />
                                </div> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Add SIDEBAR</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">

                                    <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Titel <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="title" class="form-control"
                                                        id="title">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="short_title">Short Title <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="short_title" class="form-control"
                                                        id="short_title">


                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Slide Image <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="image">

                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="video_url">Video Url <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="video_url" class="form-control"
                                                        id="video_url">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="link_image">Image Url <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="link_image" class="form-control"
                                                        id="link_image">


                                                </div>
                                            </div>
    

                                            <div class="col-lg-6">

                                                <div class="form-group  mb-4">
                                                    <label for="link_image"> Publication Status<span
                                                            class="text-danger">*</span>
                                                    </label>


                                                    <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" checked type="radio"
                                                                name="status" id="inlineCheckbox1" value="1">
                                                            <label class="form-check-label"
                                                                for="inlineCheckbox1">Published</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="inlineCheckbox2" value="0">
                                                            <label class="form-check-label"
                                                                for="inlineCheckbox2">Unpublished</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="form-group ">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">Add
                                                                Slide </button>
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
