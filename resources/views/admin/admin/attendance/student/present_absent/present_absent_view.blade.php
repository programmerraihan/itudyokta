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
                            <legend> Student Attendance View </legend>
                            <div class="row" id="print_body">
                                <div class="col-lg-12">
                                    <div class="card ">
                                        <div class="card-header">
                                            <div class="card-title" style="color:#0bb309;">
                                                Attendance View
                                            </div>
                                            <span class="float-right">
                                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                                <i class="fa fa-fw ti-close removecard"></i>
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive custom-scrollbar">
                                                <table class="table table-striped table-bordered table-hover"
                                                    id="ClassRoutine" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl.</th>
                                                            <th>Name</th>
                                                            <th>Roll</th>
                                                            @for ($i = 1; $i <= 31; $i++)
                                                                <th>{{ $i }}</th>
                                                            @endfor

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $s=0; @endphp

                                                        @foreach ($students as $student)
                                                            <tr>
                                                                <td>{{ ++$s }}</td>
                                                                <td>{{ $student->student->name }}</td>
                                                                <td>{{ $student->student->reg_no_student }}</td>
                                                                @for ($i = 1; $i <= 31; $i++)
                                                                    <td>
                                                                        <?php
                                                                        $len = strlen($i);
                                                                        if ($len == 1) {
                                                                            $check_date = $date . '-0' . $i;
                                                                        } else {
                                                                            $check_date = $date . '-' . $i;
                                                                        }
                                                                        $attendances = App\Models\Attendance::where('attendance_date', $check_date)
                                                                            ->where('stu_details_id', $student->id)
                                                                            ->get();
                                                                        foreach ($attendances as $attendance) {
                                                                            if ($attendance->attendance_status == '1') {
                                                                                echo '<span style="color:green;">P</span>';
                                                                            } elseif ($attendance->attendance_status == '2') {
                                                                                echo '<span style="color:rgb(255, 136, 0);">L</span>';
                                                                            } else {
                                                                                echo '<span style="color:red;">A</span>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                @endfor
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
