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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('course-create')
                                <a href="{{ route('add.course') }}" class=" float-right btn btn-primary">Add Course</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h4 class="card-title"> Speech info Goers Here</h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Offer Price</th>
                                        <th>Commission</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $course->title }}</td>
                                            <td>{{ number_format($course->offer_price) }}</td>
                                            <td>{{ number_format($course->price) }}</td>
                                            <td class="text-center">{{ $course->commission ?? 'N/A' }}</td>
                                            <td>
                                                <img src="{{ asset('frontend/course/' . $course->image) }}" width="100px"
                                                    alt="Slide Image">
                                            </td>
                                            <td>
                                                @if ($course->status == 1)
                                                    <span
                                                        class="badge badge-pill badge-soft-success font-size-12">Published</span>
                                                @elseif ($course->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>
                                                @else
                                                    <span class="mj_btn btn btn-warning">Pending</span>
                                                @endif
                                            </td>


                                            <td class="text-right">
                                                @can('course-approved')
                                                    <a href="{{ route('course.update-status', ['id' => $course->id]) }}"
                                                        class="btn {{ $course->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                        <i class="fas fa-arrow-alt-circle-up"></i>
                                                    </a>
                                                @endcan

                                                @can('course-update')
                                                    <a href=" {{ route('course.edit', $course->id) }}"
                                                        class="btn btn-success btn-sm waves-effect">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('course-delete')
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); document.getElementById('courseForm{{ $course->id }}').submit();">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                    <form method="POST"
                                                        action="{{ route('course.destroy', ['id' => $course->id]) }}"
                                                        id="courseForm{{ $course->id }}">
                                                        @csrf
                                                    </form>
                                                @endcan

                                            </td>
                                        </tr>
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
