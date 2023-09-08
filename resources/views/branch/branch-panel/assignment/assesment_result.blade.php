@extends('branch.branch_master')


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
                        <h4 class="mb-0 font-size-18">Question Unit</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Project</li>
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
                                    {{-- <a href="{{ route('assessment.question.create') }}"
                                        class=" float-right btn btn-primary">Add New Question
                                    </a> --}}
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

                            <h4 class="card-title">Question info Goers Here</h4>
                            <hr />
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th> Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Roll</th>

                                        {{-- <th>Input Marks</th> --}}
                                        <th>Marks</th>

                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)

                                    {{-- @dd($result) --}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $result->student->name }}</td>
                                            <td>{{$result->student->mobile }}</td>
                                            <td>{{ $result->student->email }}</td>
                                            <td>{{ $result->student->roll_no_student }}</td>

                                          

                                          
                                            
                                            <td>{{ $result->result  ?? 'none'}}</td>

                                           

                                            <td class="text-right">

                                                <a href="{{ route('student.assignment.result.edit', $result->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a target="_blank" href="{{ asset('student/student/assignment/' . $result->assignment_file) }}"
                                                    class="btn btn-primary btn-sm waves-effect" >
                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
