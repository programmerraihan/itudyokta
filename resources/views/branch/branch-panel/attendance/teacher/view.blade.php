@extends('master')

@section('css')
    <link href=" {{ asset('css/summernote/css/summernote.css') }}" rel="stylesheet"/>
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_css/datatables_custom.css') }}">
@endsection

@section('page')
    Class Routine
@endsection

@section('content')
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
                    <form action="{{route('teacher_attendance.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-striped table-bordered table-hover" id="ClassRoutine"  style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp

                                @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{++$i}}</td> 
                                    <td>{{$teacher->name}}</td>
                                    <input type="hidden" value="{{$date}}" name="date">
                                    <input type="hidden" value="{{$teacher->id}}" name="attendance[{{$teacher->id}}][attendance_id]">
                                    <td>
                                        <select class="form-control form-select" name="attendance[{{$teacher->id}}][attendance_status]">
                                            <option value="1">Present</option>
                                            <option value="0">Absent</option>
                                        </select>
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-primary btnconf">Submit</button>
                            {{-- <button type="reset" class="btn btn-default">Reset</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom_js/datatables_custom.js') }}"></script>
    {{-- <script>
        function printPage() {
                var printContents = document.getElementById('print_body').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
            }
    </script> --}}
@endsection 