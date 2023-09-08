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
                                    <a href="{{ route('branch.gallery.index') }}" class=" float-right btn btn-primary">gallery</a>
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Add gallery</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">

                                

                                    <form action="{{ route('branch.store.gallery') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="input-group mb-3">

                                                    <table class="table table-borderless" id="dynamic_field">
                                                        <tr>
                                                            <td style="width: 270px;">
                                                                <label for="">Title</label> <br>
                                                                <!-- Title Ends -->
                                                                <input type="text" name="gi[0][title]"
                                                                    class="m-input @error('title') is-invalid @enderror"
                                                                    autocomplete="off" required>
                                                                @error('title')
                                                                    <p class="text-danger">
                                                                        {{ $message }}</p>
                                                                @enderror
                                                                <!-- Title Ends -->
                                                            </td>


                                                            </td>
                                                            <td style="width: 270px;">
                                                                <label for="">Image</label> <br>
                                                                <!-- Gallery Image Starts -->
                                                                <input type="file" name="gi[0][image]"
                                                                    class="m-input @error('image') is-invalid @enderror"
                                                                    autocomplete="off" required>
                                                                @error('image')
                                                                    <p class="text-danger">
                                                                        {{ $message }}</p>
                                                                @enderror
                                                                <!-- Gallery Image Ends -->
                                                            </td>

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



                                                            <td><button style="margin-top:29px;" type="button"
                                                                    name="add" id="add"
                                                                    class="rounded btn btn-sm btn-success"><i
                                                                        class="fa fa-plus"></i>
                                                                </button></td>
                                                        </tr>


                                                    </table>
                                                </div>

                                            </div>
                                            <br>
                                        </div>
                                        <div id="newPgRow"></div>
                                        <br>
                                        <div class="form-group">
                                            <button type="submit" class="block btn btn-primary">Save</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>


                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                        <script>
                            $(document).ready(function() {
                                var i = 0;
                                $('#add').click(function() {
                                    i++;
                                    $('#dynamic_field').append(`
                                    <tbody>
                                        <tr id="row${i}">
                                        <td style="width: 270px;">
                                            <input type="text" name="gi[${i}][title]" class=" m-input" autocomplete="off" required>
                                        </td>

                                        <td style="width: 270px;">
                                            <input type="file" name="gi[${i}][image]" class=" m-input" autocomplete="off" required>
                                        </td>

                                        <td >
                                        <button style="margin-top:0px; margin-left:1px" type="button" name="remove" id="${i}" class="rounded btn btn-sm btn-danger btn_remove"><i class="fa fa-minus"></i></button>
                                        </td>
                                        </tr>
                                    </tbody>
                                    `);
                                });
                                $(document).on('click', '.btn_remove', function() {
                                    var button_id = $(this).attr("id");
                                    $('#row' + button_id + '').remove();
                                });
                            });
                        </script>
                    </fieldset>
                </div>
            </div>


        </div>
    </div>

    </div>
@endsection
