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
                        <h4 class="mb-0 font-size-18">Edit System Setting</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Edit System Setting</li>
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
                                    <a href="{{ route('district.index') }}" class=" float-right btn btn-primary">System
                                        Setting</a>
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Edit System Setting</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">

                                    <form action="{{ route('system.update', ['id' => $system->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="name" value="{{ $system->name }}"
                                                        class="form-control" id="name">

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Phone <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="phon" value="{{ $system->phon }}"
                                                        class="form-control" id="phon">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Instagram Link <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="instagram" value="{{ $system->instagram }}"
                                                        class="form-control" id="instagram">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Pinterest <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="pinterest" value="{{ $system->pinterest }}"
                                                        class="form-control" id="pinterest">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Youtube link <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="youtube" value="{{ $system->youtube }}"
                                                        class="form-control" id="youtube">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Facebook Link <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="facebook" value="{{ $system->facebook }}"
                                                        class="form-control" id="facebook">

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Twitter Link<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="twitter" value="{{ $system->twitter }}"
                                                        class="form-control" id="twitter">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Office Address One<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="address1"
                                                        value="{{ $system->address1 }}" class="form-control"
                                                        id="address1">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name"> Office Phone One <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="phone1" value="{{ $system->phone1 }}"
                                                        class="form-control" id="phone1">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name"> Office Gmail One <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="gmail1" value="{{ $system->gmail1 }}"
                                                        class="form-control" id="gmail1">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Logo<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" name="logo" class="form-control"
                                                        id="address2">


                                                    <img src="{{ asset('frontend/image/logo/' . $system->logo) }}"
                                                        width="100px" alt="Slide Image">

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Fabe Icon <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" name="icon" class="form-control"
                                                        id="icon">


                                                    <img src="{{ asset('frontend/image/icon/' . $system->icon) }}"
                                                        width="100px" alt="Slide Image">


                                                    {{-- <img src="{{ asset('admin/image/student/' . $student->image) }}"
                                                        width="100px" alt="Slide Image"> --}}

                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Office Address Two<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="address2"
                                                        value="{{ $system->address2 }}" class="form-control"
                                                        id="address2">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name"> Office Phone Two <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="phone2" value="{{ $system->phone2 }}"
                                                        class="form-control" id="phone2">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name"> Office Gmail Two <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="gmail2" value="{{ $system->gmail2 }}"
                                                        class="form-control" id="gmail2">

                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebook_embed">Facebook Embed<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <textarea type="text" name="facebook_embed" value="facebook_embed" class="form-control" id="facebook_embed"> {{ $system->facebook_embed }}</textarea>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="google_embed">Google Embed<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <textarea type="text" name="google_embed" class="form-control" id="google_embed">{{ $system->google_embed }}</textarea>

                                                </div>
                                            </div>



                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Week Start Day And Time<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="start_day_time"
                                                        value="{{ $system->start_day_time }}" class="form-control"
                                                        id="start_day_time">

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
                                                            <button type="submit" class="btn btn-primary">Edit
                                                                System </button>
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
