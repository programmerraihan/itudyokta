@extends('master')

@section('page')
    Attendance/Student Attendance View
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">
                        <h6 style="color:#0bb309;">Student Attendance View</h6>
                    </h3>
                    <span class="float-right">
                        <i class="fa fa-fw ti-angle-up clickable"></i>
                        <i class="fa fa-fw ti-close removecard"></i>
                    </span>
                </div>
                <div class="card-body">
                <h5 class="animated fadeOut"> {{ Session::get('message') }} </h5>
                    <form action="{{route('teacher_present_absent.view')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="row">
                            
                            <div class="form-group col-md-6">
                                <img src="{{asset('img/icon/right.png')}}" class="right-signe"><label>Month:</label>
                                <input type="month" value="<?php echo date('Y-m'); ?>" name="date" id="date" class="form-control">
                            </div>

                            <div class="form-group col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary btnconf">Submit</button>
                                {{-- <button type="reset" class="btn btn-default">Reset</button> --}}
                            </div>
                        </div>
                        <div id="details"> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<br> <br>

@endsection

@section('js')

@endsection