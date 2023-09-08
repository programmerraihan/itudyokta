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
                        <h4 class="mb-0 font-size-18">Add Our Speech</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Our Speech</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->




            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Add Speech</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">

                                    <form action="{{ route('speech.update', ['id' => $speech->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="title">Titel <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $speech->title }}" name="title"
                                                        class="form-control" id="title">

                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="short_title"> sort Text <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control " type="text" value="" name="sort_text"> {{ $speech->sort_text }} </textarea>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="short_title"> Long Text <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control summernote" type="text" value="" name="long_text"> {{ $speech->long_text }} </textarea>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Slide Image (Height 250:px and Weight 683:px )
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" value="{{ $speech->image }}" name="image"
                                                        class="form-control" id="image">
                                                    <img src="{{ asset('frontend/speech/' . $speech->image) }}"
                                                        width="100px" alt="Slide Image">

                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="video_url">Video Url <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $speech->video_url }}" name="video_url"
                                                        class="form-control" id="video_url">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="link_image">Image Url <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $speech->link_image }}"
                                                        name="link_image" class="form-control" id="link_image">


                                                </div>
                                            </div>



                                            {{-- <div class="col-lg-6">

                                                <div class="form-group  mb-4">
                                                    <label for="link_image"> Publication Status<span
                                                            class="text-danger">*</span>
                                                    </label>


                                                    <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" checked type="radio"
                                                                name="status"
                                                                value="{{ $slider->status == '1' ? 'checked' : '' }}"
                                                                id="inlineCheckbox1" value="1">
                                                            <label class="form-check-label"
                                                                for="inlineCheckbox1">Published</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                value="{{ $slider->status == '1' ? 'checked' : '' }}"
                                                                name="status" id="inlineCheckbox2" value="0">
                                                            <label class="form-check-label"
                                                                for="inlineCheckbox2">Unpublished</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> --}}
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="form-group ">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">Edit Our Speech
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

    </div>
@endsection
