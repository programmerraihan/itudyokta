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
                        <h4 class="mb-0 font-size-18">Edit Course</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Edit Course</li>
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
                                    <a href="{{ route('branch.course.index') }}" class=" float-right btn btn-primary">Course</a>
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Edit Course</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">

                                    <form action="{{ route('branch.course.update', ['id' => $course->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="title">Titel <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $course->title }}" name="title"
                                                        class="form-control" id="title">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="formrow-inputState">Course Type <span
                                                            class="text-danger">*</span> </label>
                                                    <select id="formrow-inputState" name="course_type" class="form-control">
                                                        <option value="" disabled selected>-- Select Gender --
                                                        </option>
                                                        <option {{ $course->course_type == '0' ? 'selected' : '' }}
                                                            value="0">Off Line Course </option>
                                                        <option {{ $course->course_type == '1' ? 'selected' : '' }}
                                                            value="1">On Line Course </option>
                                                        <option {{ $course->course_type == '2' ? 'selected' : '' }}
                                                            value="2">Free Course </option>
                                                    </select>

                                                    @error('gender')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- @dd($course); --}}

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="formrow-inputState">Course Category <span
                                                            class="text-danger">*</span> </label>
                                                    <select id="formrow-inputState" name="category_id" class="form-control">
                                                        <option value="" disabled selected>-- Select Gender --
                                                        </option>

                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == $course->category_id ? 'selected' : '' }}>
                                                                {{ $category->title }}
                                                            </option>
                                                        @endforeach
                                                        {{-- 
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->id == $course->category_id ? 'selected' : '' }}>
                                                                {{ $category->title }}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>

                                                    @error('gender')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="image">Image <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="image">

                                                    <img src="{{ asset('frontend/course/' . $course->image) }}"
                                                        width="100px" alt="Slide Image">
                                                    {{-- <img src="{{ asset('admin/image/student/' . $course->image) }}"
                                                        width="100px" alt="Slide Image"> --}}

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="course_link">Course Link <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $course->course_link }}"
                                                        name="course_link" class="form-control" id="course_link">


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="video_duration">Video duration <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" value="{{ $course->video_duration }}"
                                                        name="video_duration" class="form-control" id="video_duration">

                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="price">Price <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" value="{{ $course->price }}" name="price"
                                                        class="form-control" id="price">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="offer_price">Offer Price <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" value="{{ $course->offer_price }}"
                                                        name="offer_price" class="form-control" id="offer_price">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="total_video">Total Video <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" value="{{ $course->total_video }}"
                                                        name="total_video" class="form-control" id="total_video">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="form-group mb-4">
                                                    <label for="offer_price">Subject List <span
                                                            class="text-danger"></span>
                                                    </label>
                                                    <textarea class="form-control summernote" name="subject_list" id="horizontal-firstname-input199"> {{ $course->subject_list }}</textarea>
                                                </div>
                                            </div>

                                        </div>

                                        
                                        <div class="row">
                                           
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="offer_price"> Course Duration Day Day<span class="text-danger"></span>
                                                    </label>
                                                    <input type="text" name="day"  value="{{$course->day}}" class="form-control"
                                                        id="day">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="form-group mb-4">
                                                    <label for="offer_price">Course Detail <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control summernote" name="course_detail" id="horizontal-firstname-input199"> {{ $course->course_detail }}</textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta_keyword"> Meta Keyword <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="meta_keyword"
                                                        value="{{ $course->meta_keyword }}" class="form-control"
                                                        id="meta_keyword">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta_description"> Meta Description <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <textarea type="text" name="meta_description" class="form-control" id="meta_description"> {{ $course->meta_description }}  </textarea>

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
                                                                Course </button>
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
