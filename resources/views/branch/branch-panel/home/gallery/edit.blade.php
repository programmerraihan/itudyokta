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
                        <h4 class="mb-0 font-size-18">Add gallery</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add gallery</li>
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
                                    <a href="{{ route('branch.gallery.index') }}" class=" float-right btn btn-primary">Project</a>
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Add Project</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">

                                    {{-- <form action="{{ route('project.update', ['id' => $project->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="title">Titel <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $project->title }}" name="title"
                                                        class="form-control" id="title">

                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="image">Image <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="image">
                                                    <img src="{{ asset('frontend/project/' . $project->image) }}"
                                                        width="100px" alt="Slide Image">


                                                </div>
                                            </div>




                                        </div>

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="video_duration">Description <span
                                                            class="text-danger">*</span>
                                                    </label>

                                                    <textarea type="number" name="description" class="form-control" id="description"> {{ $project->description }}  </textarea>

                                                </div>
                                            </div>



                                        </div>


                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" hidden checked type="radio" name="status"
                                                    id="inlineCheckbox1" value="1">
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
                                                                Project </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form> --}}


                                    <form action="{{ route('branch.gallery.update', $gallery->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        {{-- @method('PUT') --}}

                                        <div class="x_panel" style="">

                                            <div class="x_content">

                                                <div class="well" style="overflow: auto">

                                                    <!-- Title Starts -->
                                                    <div class="col-md-6">
                                                        <label for="">Title</label>
                                                        <input type="text" name="title" id=""
                                                            value="{{ $gallery->title }}"
                                                            class="form-control form-control-sm @error('title') is-invalid @enderror">
                                                    </div>
                                                    <!-- Title Ends -->



                                                    <!-- Make Image Starts -->
                                                    <div class=" col-md-12">
                                                        <input style="margin-top: 24px;" type="file" accept="image/*"
                                                            class="@error('image') is-invalid @enderror" name="image"
                                                            onchange="image_preview(event)">
                                                        @error('image')
                                                            <p class="text-danger">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <!-- Make Image Ends -->



                                                    <!-- Old Image Starts -->
                                                    <div class="d-flex justify-content-right col-md-4">
                                                        <img style="margin-top: 10px; border:1px solid grey; max-height: 100px;"
                                                            src="{{ asset('frontend/gallery/' . $gallery->image) }}"
                                                            alt="">
                                                    </div>
                                                    <!-- Old Image Ends -->


                                                    <!-- New Image Preview Starts -->
                                                    <div class="d-flex justify-content-left col-md-4">
                                                        <img id="preview_image_container"
                                                            style="margin-top: 10px; border:1px solid grey; max-height: 100px;">
                                                    </div>
                                                    <!-- New Image Preview Ends -->

                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit"
                                                        class="block mt-4 btn btn-sm btn-info">Save</button>
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

    <!-- Preview Image While Uploading Js Starts -->
    <script type='text/javascript'>
        function image_preview(e) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview_image_container');
                output.src = reader.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    </script>
    <!-- Preview Image While Uploading JS Ends -->
@endsection
