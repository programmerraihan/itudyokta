@extends('branch.branch_master')


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
                        <h4 class="mb-0 font-size-18">Student Unit</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Project</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="">
                            <div class="invoice-title">

                                <h4>
                                    {{-- <a href="{{ route('add.studentUnit') }}" class=" float-right btn btn-primary">Student Unit
                                       </a> --}}

                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Student Unit info Goers Here</h4>
                            
                            <hr />

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Branch</th>
    
                                    <th>Batch</th>
                                    <th>Submission Start </th>
                                    <th>Submission End</th>
                                    
                                    <th>Status</th>
    
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
    
    
                            <tbody>
                                @foreach ($assignments as $assignment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $assignment->title }}</td>
                                        <td>{{ $assignment->Branch->name }}</td>
                                        <td>{{ $assignment->Batch->name }}</td>
                                        <td>{{ $assignment->submission_deadline }}</td>
                                        <td>{{ $assignment->submission_end_deadline }}</td>
    
                                        <td>
                                            @if ($assignment->status == 1)
                                                <span class="badge badge-pill badge-soft-success font-size-13">Approved</span>
                                            @elseif ($assignment->status == 0)
                                                <span class="badge badge-pill badge-soft-warning font-size-13">Refuse</span>
                                            @else
                                                <span class="badge badge-pill badge-soft-primary font-size-13"> Process </span>
                                            @endif
                                        </td>
    
                                        <td class="text-right">
    
                                            <a href="{{ route('branch.assignment.update-status', ['id' => $assignment->id]) }}"
                                                class="btn {{ $assignment->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                <i class="fas fa-arrow-alt-circle-up"></i>
                                            </a>
    
                                            {{-- <a href="{{ route('homework.detail', ['id' => $homework->id]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-book-open"></i>
                                            </a> --}}
                                            <a href="{{ route('branch.assignment.edit', $assignment->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="" class="btn btn-danger btn-sm"
                                                onclick="event.preventDefault(); document.getElementById('assignmentForm{{ $assignment->id }}').submit();">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
    
                                            <form method="POST"
                                                action="{{ route('branch.assignment.destroy', ['id' => $assignment->id]) }}"
                                                id="assignmentForm{{ $assignment->id }}">
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


        </div>
    </div>

    </div>
@endsection
