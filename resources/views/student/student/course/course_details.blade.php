@extends('student.student_master')


@section('css')
    <style type="text/css">
        fieldset {
            min-width: 0px;
            padding: 15px;
            margin: 7px;
            border: 2px linear-gradient(to bottom right, #062689, #5b076f);
        }

        legend {
            float: none;
            background-image: linear-gradient(to bottom right, #062689, #5b076f);
            padding: 4px;
            width: 50%;
            color: #000;
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
                        <h4 class="mb-0 font-size-18">Course</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Course</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            {{-- 
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="">
                            <div class="invoice-title">

                                <h4>
                                    <a href="{{ route('add.course') }}" class=" float-right btn btn-primary">Add Course</a>

                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"> Speech info Goers Here</h4>
                            
                            <hr />

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                       
                                        <th>Image</th>
                                   

                                        <th>Action</th>
                                    </tr>
                                <tbody>
                                    @foreach ($courses as $course)
                                      
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $course->course_title->title }}</td>

                                            <td>
                                                <img src="{{ asset('frontend/course/' . $course->course_title->image) }}"
                                                    width="100px" alt="Slide Image">
                                            </td>

                                            <td>
                                                <a href="{{ route('student.course_detail', $course->course_title->id) }}">
                                                    (Click Here) </a>
                                            </td>
                                           
                                        </tr>
                                    @endforeach

                                </tbody>
                                </thead>



                            </table>

                        </div>
                    </div>
                </div>
            </div> --}}
            <section class="free_course">
                <div class="bg-blur">
                    <div class="container">
                        <h1>Course Detalis</h1>

                        <div class="row">

                            <div class="col-md-9" style="margin:auto; margin-bottom:15px;">
                                <a href="#" style="text-decoration:none;">
                                    <div class="my_card">
                                        <img src="{{ asset('frontend/course/' . $course->image) }}" class="img"
                                            style="width: 100%; height: auto;">
                                        <div class="card_body">
                                            <h4 class="title">{{ $course->title }}</h4>
                                            <p class="prize">Price:{{ $course->price }}/-</p>
                                            <p class="discount_prize">{{ $course->offer_price }}</p>
                                            <span class="total_time"><i class="far fa-clock"></i>
                                                {{ $course->video_duration }}+ hr </span>
                                            <span class="total_video"><i class="fas fa-video"></i>
                                                {{ $course->total_video }}+ </span>
                                            <br />

                                            <p class="discount_prize">{!! $course->course_detail !!}</p>


                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="my_glass_button">
                        <a href="{{ route('admission') }}"> Admission </a>
                    </div>
                </div>
        </div>
        </section>




    </div>
    </div>

    </div>
@endsection
