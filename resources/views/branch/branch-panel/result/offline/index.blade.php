@extends('branch.branch_master')

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
                        <h4 class="mb-0 font-size-18">Offline Exam</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Offline Examp</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('offline-exam.create')}}" class="btn btn-info">Create</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h4 class="card-title"> Speech info Goers Here</h4>
                        </div>
                        <div class="card-body overflow-auto">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>                                    
                                        <th>Student Name</th>
                                        <th>Course</th>
                                        <th>Roll</th>
                                        <th>Total</th>
                                        <th>Gpa</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($studentResults as $studentResult)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$studentResult->student->name ?? "N/A"}}</td>
                                        <td>{{$studentResult->enrollment->course_title->title ?? "N/A"}}</td>
                                        <td>{{$studentResult->student->roll_no_student ?? "N/A"}}</td>                                     
                                        <td>{{$studentResult->total}}</td>
                                        <td>{{$studentResult->cgpa}}</td>
                                        <td>{{$studentResult->grade}}</td>
                                        <td>
                                            @if($studentResult->status == 'pending')
                                                <span class="badge badge-info">Pending</span>
                                            @elseif($studentResult->status == 'approved')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif($studentResult->status == 'reject')
                                                <span class="badge badge-danger">Reject</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"  href="{{route('offline-exam.show', ['offline_exam' => $studentResult->id])}}"><i class="fa fa-eye"></i> View</a>
                                                    @if($studentResult->status == 'pending')
                                                    <a class="dropdown-item"  href="{{route('offline-exam.edit', ['offline_exam' => $studentResult->id])}}"><i class="fa fa-edit"></i> Edit</a>
                                                    <a class="dropdown-item text-danger delete-btn" href="javascript:void(0)" data-href="{{route('offline-exam.destroy', ['offline_exam' => $studentResult->id])}}"><i class="fa fa-trash"></i> Delete</a>
                                                    @endif
                                                </div>
                                            </div>                       
                                        </td>
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
    </div>
    <form action="" id="delete-form" method="post">@csrf @method('DELETE')</form>
@endsection


@push('js')
<script>
    $(document).ready(function() {
        $(document).on("click", ".delete-btn", function() {
            let confirm = window.confirm('Are you sure to delte?');
            if(!confirm) {
                return;
            }
            let href = $(this).data('href');
            $('#delete-form').attr('action', href).submit();
        })
    });
</script>
@endpush
