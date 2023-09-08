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
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <fieldset>
                            <legend> Student Attendance </legend>
                            <div class="row" id="print_body">
                                <div class="col-lg-12">
                                    <div class="card ">
                                        <div class="card-header">
                                            <div class="card-title" style="color:#0bb309;">
                                                Make Attendance
                                            </div>
                                            <span class="float-right">
                                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                                <i class="fa fa-fw ti-close removecard"></i>
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive custom-scrollbar">
                                                <form action="{{ route('student_attendance.store') }}" method="POST"
                                                    class="form-horizontal" enctype="multipart/form-data">
                                                    @csrf


                                                    <input type="hidden" id="branch_id" name="branch_id"
                                                        value="{{ $branch_id }}">

                                                    <table class="table table-striped table-bordered table-hover"
                                                        id="ClassRoutine" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sl.</th>
                                                                <th>Name</th>
                                                                <th>Roll</th>
                                                                <th>In Time</th>
                                                                <th>Out Time</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $i=0; @endphp

                                                            @foreach ($students as $student)
                                                                <tr>
                                                                    <td>{{ ++$i }}</td>
                                                                    <td>{{ $student->student->name }}</td>
                                                                    <td>{{ $student->student->reg_no_student }}</td>
                                                                    <input type="hidden" value="{{ $date }}"
                                                                        name="date">
                                                                    <input type="hidden" value="{{ $student->id }}"
                                                                        name="attendance[{{ $student->id }}][attendance_id]">
                                                                    <td><input type="time" value="{{ $student->id }}"
                                                                            name="attendance[{{ $student->id }}][in_time]"
                                                                            style="height: 25px; border-radius: 3px;"></td>
                                                                    <td><input type="time" value="{{ $student->id }}"
                                                                            name="attendance[{{ $student->id }}][out_time]"
                                                                            style="height: 25px; border-radius: 3px;"></td>
                                                                    <td>
                                                                        <select class="form-control form-select"
                                                                            name="attendance[{{ $student->id }}][attendance_status]">
                                                                            <option value="1">Present</option>
                                                                            <option value="0">Absent</option>
                                                                            <option value="2">Late</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>


                                                    <div class="col-lg-12">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="text-center">
                                                                            <button style="width: 200px" type="submit"
                                                                                class="btn btn-primary">Submit</button>
                                                                            {{-- <button style="width: 100px" type="submit"
                                                                                class="btn btn-primary">Reset</button> --}}
                                                                        </div>

                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>



                                                </form>
                                            </div>
                                        </div>
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
@section('script')
    <script></script>
@endsection
