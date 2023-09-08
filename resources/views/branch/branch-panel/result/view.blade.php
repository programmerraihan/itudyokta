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
                            <legend> Student Mark </legend>
                            <div class="row" id="print_body">
                                <div class="col-lg-12">
                                    <div class="card ">
                                        <div class="card-header">
                                            <div class="card-title" style="color:#0bb309;">
                                                Make Student
                                            </div>
                                            <span class="float-right">
                                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                                <i class="fa fa-fw ti-close removecard"></i>
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive custom-scrollbar">
                                                <form action="{{ route('student_result.store') }}" method="POST"
                                                    class="form-horizontal" enctype="multipart/form-data">
                                                    @csrf
                                                    <table class="table table-striped table-bordered table-hover"
                                                        id="ClassRoutine" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sl.</th>
                                                                <th>Name</th>
                                                                <th>Roll</th>
                                                                <th>MCQ Mark Time</th>
                                                                <th>Assment Mark Out Time</th>
                                                                <th>VIva Mark Out Time</th>
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

                                                                    <input type="hidden" value="{{ $mcq_mark }}"
                                                                        name="mcq_mark">

                                                                    <input type="hidden" value="{{ $assessment_mark }}"
                                                                        name="assessment_mark">

                                                                    <input type="hidden" value="{{ $viva_mark }}"
                                                                        name="viva_mark">

                                                                    <input type="hidden" value="{{ $student->id }}"
                                                                        name="result[{{ $student->id }}][student_id]">

                                                                    <td>
                                                                        <input type="number"
                                                                            name="result[{{ $student->id }}][mcq_mark]"
                                                                            style="height: 25px; border-radius: 3px;">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number"
                                                                            name="result[{{ $student->id }}][assessment_mark]"
                                                                            style="height: 25px; border-radius: 3px;">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number"
                                                                            name="result[{{ $student->id }}][viva_mark]"
                                                                            style="height: 25px; border-radius: 3px;">
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
