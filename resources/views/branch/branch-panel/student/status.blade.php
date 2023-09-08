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
                        <h4 class="mb-0 font-size-18">student</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">student</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-6 col-sm-12 p-0 m-0 card m-auto ">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Paid Registration Fee</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('student.course.commission', ['id' => $student->id])}}" method="post">
                                @csrf 
                                <div class="form-group">
                                    <label for="student_name">Student Name</label>
                                    <input type="text" name="student_name" value="{{$student->name}}" id="student_name" class="form-control" placeholder="Student Name" aria-describedby="helpId" />
                                </div>
                                <div class="form-group">
                                    <label for="course_title">Course Title</label>
                                    <input type="text" name="course_title" value="{{$student->CourseTitle->title}}" id="course_title" class="form-control" placeholder="Course Title" aria-describedby="helpId" />
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="number" value="{{$student->CourseTitle->commission ?? 0}}" id="number" class="form-control" placeholder="Amount" aria-describedby="helpId" />
                                </div>
                                <div class="form-group">
                                    <label for="method">Payment Method</label>
                                    <select name="method" id="method" class="form-control">
                                        <option value="" hidden>Select Payment Method</option>
                                        <option value="cash" selected>Cash</option>
                                        <option value="uddoktapay">Uddoktapay</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Pay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
