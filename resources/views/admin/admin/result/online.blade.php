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
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $studentResult->student->name ?? 'N/A' }}</td>
                                            <td>{{ $studentResult->enrollment->course_title->title ?? 'N/A' }}</td>
                                            <td>{{ $studentResult->student->roll_no_student ?? 'N/A' }}</td>
                                            <td>{{ $studentResult->total }}</td>
                                            <td>{{ $studentResult->cgpa }}</td>
                                            <td>{{ $studentResult->grade }}</td>
                                            <td>
                                                @if ($studentResult->status == 'pending')
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif($studentResult->status == 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif($studentResult->status == 'reject')
                                                    <span class="badge badge-danger">Reject</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group dropleft">
                                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if ($studentResult->status == 'pending')
                                                            <a class="dropdown-item text-success approved_btn"
                                                                href="javascript:void(0)"
                                                                data-href="{{ route('admin.offline-exam.approved', ['id' => $studentResult->id]) }}"><i class="fa fa-check"></i> Approved</a>
                                                        @endif
                                                        <a class="dropdown-item text-success" href="{{ route('admin.offline-exam.show', ['id' => $studentResult->id]) }}"><i class="fa fa-eye"></i> View</a>
                                                        
                                                        <a class="dropdown-item text-success" href="{{ route('admin.offline-exam.edit', ['id' => $studentResult->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0)"  onclick="event.preventDefault(); document.getElementById('resultForm{{ $studentResult->id }}').submit();"><i class="fas fa-trash-alt"></i> Delete</a>

                                                        <form method="POST" action="{{ route('admin.offline-exam.destroy', ['id' => $studentResult->id]) }}" id="resultForm{{ $studentResult->id }}">
                                                            @csrf
                                                        </form>
                                                        <a data-id="{{ $studentResult->id }}" class="set_date dropdown-item text-primary" type="button" href="javascript:void(0)"><i class="fa fa-calendar"></i> Set Date</a>
                                                        {{-- <a class="dropdown-item"  href="{{route('offline-exam.show', ['offline_exam' => $studentResult->id])}}"><i class="fa fa-eye"></i> View</a>
                                                    <a class="dropdown-item"  href="{{route('offline-exam.edit', ['offline_exam' => $studentResult->id])}}"><i class="fa fa-edit"></i> Edit</a>
                                                    <a class="dropdown-item text-danger delete-btn" href="javascript:void(0)" data-href="{{route('offline-exam.destroy', ['offline_exam' => $studentResult->id])}}"><i class="fa fa-trash"></i> Delete</a> --}}
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

    {{-- modal --}}
    <div class="modal fade" id="setModalDate" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('admin.offline-exam.dateStore') }}" id="updateForm" method="post">
                        @csrf
                        <input type="hidden" name="id" />
                        <div class="modal-content modal-lg">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="issue_date">Issue Date*</label>
                                        <input type="date" name="issue_date" id="issue_date" class="form-control"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="held_from">Held From*</label>
                                        <input type="date" name="held_from" id="held_from" class="form-control"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="held_to">Held To*</label>
                                        <input type="date" name="held_to" id="held_to" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

    <form action="" id="delete-form" method="post">@csrf @method('DELETE')</form>
@endsection


@push('js')
    <script>
        $(document).ready(function() {

            $(document).on("click", ".set_date", function() {
                let id = $(this).data('id');
                $("#updateForm input[name='id']").val(id);
                $("#setModalDate").modal("show");
            })

            $(document).on("click", ".delete-btn", function() {
                let confirm = window.confirm('Are you sure to delte?');
                if (!confirm) {
                    return;
                }
                let href = $(this).data('href');
                $('#delete-form').attr('action', href).submit();
            })

            $(document).on("click", ".approved_btn", function() {
                let confirm = window.confirm('Are you sure to approved?');
                if (!confirm) {
                    return;
                }
                let href = $(this).data('href');
                window.location.href = href;
            })
        });
    </script>
@endpush
