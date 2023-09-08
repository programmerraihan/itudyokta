@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            @if ($message = Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">

                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- page title area start -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Employee Information </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employee </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Employee Basic Info Goes Here</h4>
                            <hr />
                            <table class="table table-bordered dt-responsive nowrap  "
                                style="border-collapse: collapse; border-spacing: 5px; width: 100%;">
                                <tr>
                                    <th>Id</th>
                                    <td>{{ $employee->id }}</td>
                                </tr>

                                <tr>
                                    <th>Employee Name</th>
                                    <td>{{ $employee->name }}</td>
                                </tr>
                                <tr>
                                    <th>Employee Fathers Name</th>
                                    <td>{{ $employee->initial_name }}</td>
                                </tr>
                                <tr>
                                    <th>Employee Mothers Name</th>
                                    <td>{{ $employee->department }}</td>
                                </tr>
                                <tr>
                                    <th>Employee Spouse Name</th>
                                    <td>{{ $employee->designation }}</td>
                                </tr>

                                <tr>
                                    <th>Employee Email</th>
                                    <td>{{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <th>Employee Web</th>
                                    <td>{{ $employee->phon_number }}</td>
                                </tr>

                                <tr>
                                    <th>Employee Contact No</th>
                                    <td>{{ $employee->room_no }}</td>
                                </tr>
                                <tr>
                                    <th>Employee Emergency Contact Number</th>
                                    <td>{{ $employee->emergency_number }}</td>
                                </tr>


                                <tr>
                                    <th>Profile Image</th>
                                    <td> <img src="{{ asset($employee->profile_image) }}" height="200" width="200" />
                                    </td>
                                </tr>



                                <tr>
                                    <th>Employee Status</th>
                                    <td>{{ $employee->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                </tr>

                            </table>
                            <div class="d-print-none">
                                <div class="float-right">
                                    <a href="javascript:window.print()"
                                        class="btn btn-success waves-effect waves-light mr-1"><i
                                            class="fa fa-print"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        @endsection
