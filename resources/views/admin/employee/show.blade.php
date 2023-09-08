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


            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Employee List</h4>

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

                            <h4 class="card-title">All Employee info Goers Here</h4>
                            <hr />

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>

                                        <th>Name</th>
                                        <th>Initial Name</th>
                                        <th>Email</th>

                                        <th>Department</th>

                                        <th>Status</th>

                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->initial_name }}</td>

                                            <td>{{ $employee->email }}</td>

                                            <td>{{ $employee->department }}</td>

                                            <td>
                                                @if ($employee->status == 1)
                                                    <span
                                                        class="badge badge-pill badge-soft-success font-size-12">Published</span>
                                                @elseif ($employee->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>
                                                @else
                                                    <span class="mj_btn btn btn-warning">Pending</span>
                                                @endif
                                            </td>


                                            <td class="text-right">
                                                <a href="{{ route('employee.update-status', ['id' => $employee->id]) }}"
                                                    class="btn {{ $employee->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                                </a>
                                                <a href="{{ route('employee.detail', ['id' => $employee->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-book-open"></i>
                                                </a>
                                                <a href="{{ route('employee.edit', $employee->id) }}"
                                                    class="btn btn-success btn-sm waves-effect">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('employeeForm{{ $employee->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>

                                                <form method="POST"
                                                    action="{{ route('employee.destroy', ['id' => $employee->id]) }}"
                                                    id="employeeForm{{ $employee->id }}">
                                                    @csrf
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        @endsection
