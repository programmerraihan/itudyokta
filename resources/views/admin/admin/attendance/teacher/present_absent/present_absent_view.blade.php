@extends('master')

@section('css')
    <link href=" {{ asset('css/summernote/css/summernote.css') }}" rel="stylesheet"/>
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_css/datatables_custom.css') }}">
@endsection

@section('page')
   Teacher Attendance
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header">
                <div class="card-title" style="color:#0bb309;">
                    Teacher Attendance View
                </div>
                <span class="float-right">
                    <i class="fa fa-fw ti-angle-up clickable"></i>
                    <i class="fa fa-fw ti-close removecard"></i>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>ID</th>
                                <th>Name</th>
                                @for ($i = 1; $i <= 31 ; $i++)
                                    <th>{{$i}}</th>
                                @endfor
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php $s=0; @endphp

                            @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{++$s}}</td> 
                                <td>{{$teacher->id}}</td>
                                <td>{{$teacher->name}}</td> 
                                @for ($i = 1; $i <= 31 ; $i++)
                                    <td>
                                        <?php
                                            $len = strlen($i); 
                                            if($len==1){
                                                $check_date = $date.'-0'.$i;
                                            }
                                            else{
                                                $check_date = $date.'-'.$i;
                                            }
                                            $attendances = App\Models\TeacherAttendance::where('attendance_date', $check_date)
                                                                        ->where('teacher_id',$teacher->id)
                                                                        ->get();
                                            foreach ($attendances as $attendance){
                                                if($attendance->attendance_status == '1'){
                                                    echo '<span style="color:green;">P</span>';
                                                }
                                                else{
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