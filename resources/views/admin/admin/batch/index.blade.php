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
                        <h4 class="mb-0 font-size-18">Student Batch</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Batch</li>
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
                                    @can('batch-create')
                                        <a href="{{ route('add.batch') }}" class=" float-right btn btn-primary">Batch
                                        </a>
                                    @endcan

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

                            <h4 class="card-title">Batch info Goers Here</h4>
                            {{-- <h4>
                                <a href="{{ route('add.slide') }}" class=" float-right btn btn-primary">Add Slider</a>
                            </h4> --}}
                            <hr />

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Branch</th>
                                        <th>Session</th>
                                        <th>Courses</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>

                                <tbody>

                                    @foreach ($batches as $batch)
                                        @php
                                            $title_name = \App\Models\CourseTitle::find($batch->course_title_id);
                                        @endphp

                                        {{-- @dd({{\App\Models\Session::find($batch->session_id)->name}}); --}}



                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $batch->name }}</td>
                                            <td> {{ \App\Models\Branch::find($batch->branch_id)->name }}</td>
                                            <td> {{ \App\Models\Session::find($batch->session_id)->name }}</td>
                                            {{-- 
                                            <td> {{$title_name->title?$title_name->title:'No Data'}}</td> --}}
                                            {{-- <td> {{$batch->course_title_id->title}}</td> --}}
                                            {{-- <td>  {{\App\Models\CourseTitle::find($batch->course_title_id)->title}}</td> --}}


                                            <td>
                                                @if ($batch->status == 1)
                                                    <span
                                                        class="badge badge-pill badge-soft-success font-size-12">Published</span>
                                                @elseif ($batch->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>
                                                @else
                                                    <span class="mj_btn btn btn-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                @can("batch-approved")
                                                <a href="{{ route('batch.update-status', ['id' => $batch->id]) }}"
                                                    class="btn {{ $batch->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                                </a>
                                                @endcan 

                                                @can("batch-update")
                                                <a href=" {{ route('batch.edit', $batch->id) }}"
                                                    class="btn btn-success btn-sm waves-effect">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endcan 

                                                @can("batch-delete")
                                                <a href="" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('batchForm{{ $batch->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('batch.destroy', ['id' => $batch->id]) }}"
                                                    id="batchForm{{ $batch->id }}">
                                                    @csrf
                                                </form>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                </thead>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
