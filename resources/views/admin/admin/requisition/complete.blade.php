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
                        <h4 class="mb-0 font-size-18">Requisition List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Requisition List</li>
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

                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"> Requisition List </h4>
                            <hr />
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Session</th>
                                        <th>Branch</th>
                                        <th>Course</th>
                                        {{-- <th>Batch</th> --}}

                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                <tbody>


                                    @foreach ($requisition as $student)
                                        {{-- @dd($student) --}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \App\Models\Session::find($student->session_id)->year }}</td>
                                            <td>{{ \App\Models\Branch::find($student->branch_id)->name }}</td>
                                            <td>{{ \App\Models\CourseTitle::find($student->course_title_id)->title }}</td>
                                            {{-- <td>{{ \App\Models\Batch::find($student->batch_id)->name }}</td> --}}

                                            <td>
                                                @if ($student->status == 1)
                                                    <span
                                                        class="badge badge-pill badge-soft-success font-size-12">Requisition
                                                        Request</span>
                                                @elseif ($student->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-soft-warning font-size-12">Requisition
                                                        Complete</span>
                                                @else
                                                    <span class="mj_btn btn btn-warning">Pending</span>
                                                @endif
                                            </td>


                                            <td class="text-right">
                                                <a href="{{ route('requisition.update-status', ['id' => $student->id]) }}"
                                                    class="btn {{ $student->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                                </a>
                                                <a href="{{ route('detail.requisition', ['id' => $student->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-book-open"></i>
                                                </a>
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
