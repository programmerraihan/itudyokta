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

        label {
            font-weight: 700;
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

            {{-- @dd($courseTitles) --}}
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"> Student Registration Card </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active"> Student Registration Card </li>
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
                                    <a href="{{ route('student.index') }}" class=" float-right btn btn-primary">Student</a>
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('add.certificate.card') }}" class="mt-2" method="get">
                <input type="hidden" name="filter" value="1">
                <div class="form-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search By - Name | Roll | Mobile | Registration" />
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </form>

            @if ($studentResults)
                <div class="p-2 bg-none">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Course Title</th>
                                <th>Branch</th>
                                <th>Total Mark</th>
                                <th>Grad</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($studentResults as $studentResult)
                            <tr>
                                <td>{{$studentResult->student->name}}</td>
                                <td>{{$studentResult->student->CourseTitle->title}}</td>
                                <td>{{$studentResult->student->Branch->name}}</td>
                                <td>{{$studentResult->total_mark}}</td>
                                <td>{{$studentResult->grade}}</td>
                                <td>
                                    <a target="_blank" href="{{ route("certificate.print", ["id" => $studentResult->id, "type" => "online"]) }}" class="btn btn-outline-primary">Generate Certificate</a>
                                </td>
                            </tr>
                            @empty
                            @endforelse

                            @forelse ($offlineResult as $studentResult)
                            <tr>
                                <td>{{$studentResult->student->name}}</td>
                                <td>{{$studentResult->student->CourseTitle->title}}</td>
                                <td>{{$studentResult->student->Branch->name}}</td>
                                <td>{{$studentResult->total_mark}}</td>
                                <td>{{$studentResult->grade}}</td>
                                <td>
                                    <a target="_blank" href="{{ route("certificate.print", ["id" => $studentResult->id, "type" => "offline"]) }}" class="btn btn-outline-primary">Generate Certificate</a>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif


        </div>
    </div>

    </div>
@endsection
