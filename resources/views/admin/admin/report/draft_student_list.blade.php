@extends('admin.admin_master')


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
                        <h4 class="mb-0 font-size-18">student</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">student</li>
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
                                    <a href="{{ route('add.student') }}" class=" float-right btn btn-primary">Add
                                        student</a>

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
                            {{-- <h4>
                                <a href="{{ route('add.slide') }}" class=" float-right btn btn-primary">Add Slider</a>
                            </h4> --}}
                            <hr />

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th> Student Name</th>

                                        <th>Roll</th>
                                        <th>Email</th>
                                        <th>Mobile</th>

                                        {{-- <th>Course</th> --}}

                                        {{-- <th>Short Title</th> --}}
                                        <th>Image</th>
                                        <th>Status</th>

                                        <th class="text-right">Action</th>
                                    </tr>
                                <tbody>

                                    {{-- @dd($students); --}}
                                    @foreach ($students as $student)
                                        @php
                                            $student_fees = App\Models\StudentFee::where('student_id', $student->id)->sum('paid');
                                            // @dump($student_fees)
                                        @endphp
                                        @if ($student_fees <= 0 || !$student_fees)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->roll_no_student }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->mobile }}</td>




                                                {{-- @foreach ($student->Enrollment as $item)
                                       

                                         {{-- @dd( \App\Models\CourseTitle::find($item->course_title_id)->title)  --}}

                                                {{-- <td>{{ \App\Models\CourseTitle::find($item->course_title_id)->title }}</td> --}}

                                                {{-- @endforeach --}}


                                                {{-- <td>{{ \App\Models\CourseTitle::find($student->course_title_id)->title }}</td> --}}

                                                <td>
                                                    <img src="{{ asset('admin/image/student/' . $student->image) }}"
                                                        width="100px" alt="Slide Image">
                                                </td>

                                                <td>
                                                    @if ($student->status == 1)
                                                        <span
                                                            class="badge badge-pill badge-soft-success font-size-12">Published</span>
                                                    @elseif ($student->status == 0)
                                                        <span
                                                            class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>
                                                    @else
                                                        <span class="mj_btn btn btn-warning">Pending</span>
                                                    @endif
                                                </td>


                                                <td class="text-right">

                                                    <a href="{{ route('student.update-status', ['id' => $student->id]) }}"
                                                        class="btn {{ $student->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                        <i class="fas fa-arrow-alt-circle-up"></i>
                                                    </a>
                                                    <a href="{{ route('student.detail', ['id' => $student->id]) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-book-open"></i>
                                                    </a>


                                                    {{-- <a href=" {{ route('student.edit', $student->id) }}"
                                                        class="btn btn-success btn-sm waves-effect">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); document.getElementById('studentForm{{ $student->id }}').submit();">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                    <form method="POST"
                                                        action="{{ route('student.destroy', ['id' => $student->id]) }}"
                                                        id="studentForm{{ $student->id }}">
                                                        @csrf
                                                    </form> --}}



                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                                </thead>



                            </table>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    </div>
@endsection
