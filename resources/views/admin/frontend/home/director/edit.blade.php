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
                        <h4 class="mb-0 font-size-18">Add Director</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Director</li>
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
                                    <a href="{{ route('director.index') }}"
                                        class=" float-right btn btn-primary">Director</a>
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Add Director</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">



                                    <form action="{{ route('director.update', ['id' => $director->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        {{-- <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $director->name }}" name="name"
                                                        class="form-control" id="name">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="designation">Designation <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="designation" value="{{ $director->designation }}"
                                                        name="title" class="form-control" id="designation">

                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="title">Titel <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" value="{{ $director->title }}" name="title"
                                                        class="form-control" id="title">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address">Address <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="address" value="{{ $director->address }}" name="address"
                                                        class="form-control" id="address">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="image">Image <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="image">
                                                    <img src="{{ asset('frontend/director/' . $director->image) }}"
                                                        width="100px" alt="Slide Image">
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
                                                                Director </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- @dd($director) --}}
                                        {{-- @dd($director->director_type) --}}

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="name" value="{{ $director->name }}"
                                                        class="form-control" id="name">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="designation">Designation <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="designation" name="designation"
                                                        value="{{ $director->designation }}" class="form-control"
                                                        id="designation">

                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Titel <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="title" value="{{ $director->title }}"
                                                        class="form-control" id="title">

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="address" name="address" value="{{ $director->address }}"
                                                        class="form-control" id="address">

                                                </div>
                                            </div>



                                        </div>

                                        <div class="row">


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="image">
                                                    <img src="{{ asset('frontend/director/' . $director->image) }}"
                                                        width="100px" alt="Slide Image">


                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="formrow-inputState">Directors Type <span
                                                            class="text-danger">*</span> </label>
                                                    <select id="formrow-inputState" name="director_type"
                                                        class="form-control">
                                                        <option value="" disabled selected>-- Select Directors --
                                                        </option>

                                                        <option value="0"
                                                            {{ $director->director_type == '0' ? 'selected' : '' }}>Our
                                                            Board of Directors </option>
                                                        <option value="1"
                                                            {{ $director->director_type == '1' ? 'selected' : '' }}>Our
                                                            Regional Directors </option>

                                                    </select>

                                                    @error('gender')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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
                                                            <button type="submit" class="btn btn-primary">Add
                                                                Director </button>
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
