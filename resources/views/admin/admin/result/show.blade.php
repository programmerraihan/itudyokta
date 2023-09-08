@extends('admin.admin_master')


@section('css')
    <style type="text/css">
        fieldset {
            min-width: 0px;
            padding: 15px;
            margin: 7px;
            border: 2px linear-gradient(to bottom right, #062689, #5b076f);
        }

        legend {
            float: none;
            background-image: linear-gradient(to bottom right, #062689, #5b076f);
            padding: 4px;
            width: 50%;
            color: #000;
            border-radius: 7px;
            font-size: 17px;
            font-weight: 700;
            text-align: center;
        }
    </style>
@endsection

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
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('add.student') }}" class=" float-right btn btn-primary">Add
                                student</a>
                            @if (session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"> Speech info Goers Here</h4>

                            <hr />

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Student Name</th>
                                        <th>Roll</th>
                                        <th>Mobile</th>
                                        <th>Grade</th>
                                        <th>Issue Date</th>
                                        <th>Held From</th>
                                        <th>Held To</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentResults as $result)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if (empty($result->student->image))
                                                    <img src="{{ asset('null.png') }}" style="height: 100px" width="100px">
                                                @else
                                                    <img src="{{ asset('admin/image/student/' . $result->student->image ?? 'null') }}"
                                                        width="100px" alt="Slide Image">
                                                @endif
                                            </td>
                                            <td>{{ $result->student->name ?? 'N/A' }}</td>
                                            <td>{{ $result->student->roll_no_student ?? 'N/A' }}</td>

                                            <td>{{ $result->student->mobile ?? 'N/A' }}</td>
                                            <td>{{ $result->grade ?? 'N/A' }}</td>
                                            <td>{{ $result->issue_date ?? 'N/A' }}</td>
                                            <td>{{ $result->held_from ?? 'N/A' }}</td>
                                            <td>{{ $result->held_to ?? 'N/A' }}</td>
                                            <td>
                                                <button data-id="{{ $result->id }}"
                                                    class="btn btn-sm btn-primary set_date" type="button">Set
                                                    Date</button>
                                                <button data-id="{{ $result->id }}" mcq_result="{{$result->mcq_result}}" assessment_result="{{$result->assessment_result}}"  viva_result="{{$result->viva_result}}"  grade="{{$result->grade}}"
                                                    class="btn btn-sm btn-primary edit_student_result" type="button">Edit</button>
                                                
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('resultForm{{ $result->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>    
                                                <form method="POST" action="{{ route('student_result.destroy', ['id' => $result->id]) }}" id="resultForm{{ $result->id }}">
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


            <!-- Modal -->
            <div class="modal fade" id="setModalDate" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('store-issue-date') }}" id="updateForm" method="post">
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

            <!-- Modal -->
            <div class="modal fade" id="editResult" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('student_result.update') }}" id="updateResultForm" method="post">
                        @csrf
                        <input type="hidden" name="id" />
                        <div class="modal-content modal-lg">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="mcq_result">MCQ Result</label>
                                        <input type="number" name="mcq_result" id="mcq_result" class="form-control"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="assessment_result">Assessment Result</label>
                                        <input type="number" name="assessment_result" id="assessment_result" class="form-control"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="viva_result">Viva Result</label>
                                        <input type="number" name="viva_result" id="viva_result" class="form-control" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="grade">Grade</label>
                                        <input type="text" name="grade" id="grade" class="form-control" required />
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
        </div>
    </div>

    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".set_date", function() {
                $("#setModalDate").modal('show');
                let id = $(this).data("id");
                $("#updateForm input[name='id']").val(id);
            });

            
            $(document).on("click", ".edit_student_result", function() {
                $("#editResult").modal('show');
                let id = $(this).data("id");
                let mcq_result = $(this).attr("mcq_result");
                let assessment_result = $(this).attr("assessment_result");
                let viva_result = $(this).attr("viva_result");
                let grade = $(this).attr("grade");
                $("#updateResultForm input[name='id']").val(id);
                $("#updateResultForm input[name='mcq_result']").val(mcq_result);
                $("#updateResultForm input[name='assessment_result']").val(assessment_result);
                $("#updateResultForm input[name='viva_result']").val(viva_result);
                $("#updateResultForm input[name='grade']").val(grade);
            });
        });
    </script>
@endpush
