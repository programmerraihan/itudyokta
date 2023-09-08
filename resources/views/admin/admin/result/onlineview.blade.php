@extends('admin.admin_master')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.offline-exam') }}" class="btn btn-info">Offline Exam List</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Result Detail</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <b>Student: </b>{{$result->student->name ?? "N/A"}}
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <b>Course Title: </b>{{$result->enrollment->course_title->title ?? "N/A"}}
                                </div>                                
                                <div class="col-md-4 col-sm-12">
                                    <b>Issue Date: </b>{{date("d/m/y", strtotime($result->issue_date))}}
                                </div>                                
                                <div class="col-md-4 col-sm-12 mt-3">
                                    <b>Held From: </b>{{date("d/m/y", strtotime($result->held_from))}}
                                </div>                                
                                <div class="col-md-4 col-sm-12 mt-3">
                                    <b>Held To: </b>{{date("d/m/y", strtotime($result->held_to))}}
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="card">                        
                        <div class="card-body overflow-auto">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Subject</th>
                                        <th>MCQ</th>
                                        <th>Assignment</th>
                                        <th>Viva</th>
                                        <th>Total</th>
                                        <th>GPA</th>
                                        <th>Grade</th>
                                        <th>Attachment</th>
                                    </tr>
                                </thead>
                                <body>
                                    <?php
                                        $totalMcq = 0;
                                        $totalAssignment = 0; 
                                        $totalViva = 0; 
                                    ?>
                                    @forelse ($marks as $subject => $data )
                                    <?php
                                        $totalMcq += $data->mcq ?? 0;
                                        $totalAssignment += $data->assignment ?? 0;
                                        $totalViva += $data->viva ?? 0;
                                    ?>
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$subject ?? "N/A"}}</td>
                                            <td>{{$data->mcq ?? 0}}</td>
                                            <td>{{$data->assignment ?? 0}}</td>
                                            <td>{{$data->viva ?? 0}}</td>
                                            <td>{{$data->total ?? 0}}</td>
                                            <td>{{$data->gpa ?? "N/A"}}</td>
                                            <td>{{$data->grade ?? "N/A"}}</td>
                                            <td>
                                                <a href="{{asset('storage/attachment/'.$data->attachment)}}" download class="btn btn-sm btn-info"><i class="fa fa-download"></i> Attachment</a>
                                            </td>
                                        </tr>
                                    @empty                                        
                                    @endforelse
                                </body>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <th>{{$totalMcq}}</th>
                                        <th>{{$totalAssignment}}</th>
                                        <th>{{$totalViva}}</th>
                                        <th>{{$result->total ?? 0}}</th>
                                        <th>{{$result->cgpa ?? 0}}</th>
                                        <th>{{$result->grade ?? "F"}}</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection