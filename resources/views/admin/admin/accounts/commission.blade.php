@extends('admin.admin_master')


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
                        <h4 class="mb-0 font-size-18">Course Commission</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Course Commission</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-sm"  id="datatable-buttons">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Student</th>
                                        <th>Branch</th>
                                        <th>Course Title</th>
                                        <th>Method</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($courseCommissions as $commission)
                                    <tr>
                                        <td scope="row">{{$loop->iteration}}</td>
                                        <td>{{date('d/m/y', strtotime($commission->date))}}</td>
                                        <td>{{$commission->student->name ?? "N/A"}}</td>
                                        <td>{{$commission->branch->name ?? "N/A"}}</td>
                                        <td>{{$commission->courseTitle->course_title ?? "N/A"}}</td>
                                        <td>{{$commission->method}}</td>
                                        <td>{{$commission->amount}}</td>
                                    </tr>
                                    @empty                                        
                                    @endforelse
                                                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
