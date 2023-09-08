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
                        <h4 class="mb-0 font-size-18">Teacher Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Teacher Category</li>
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
                                    @can('teacher-category-create')
                                        <a href="{{ route('add.teacher.category') }}" class=" float-right btn btn-primary">Add
                                            Teacher Category</a>
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

                            <h4 class="card-title"> Teacher Category info Goers Here</h4>
                            {{-- <h4>
                                <a href="{{ route('add.teacher.category') }}" class=" float-right btn btn-primary">Teacher Category</a>
                            </h4>
                            <hr /> --}}

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>name</th>
                                        <th>Status</th>

                                        <th class="text-right">Action</th>
                                    </tr>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $category->name }}</td>


                                            <td>
                                                @if ($category->status == 1)
                                                    <span
                                                        class="badge badge-pill badge-soft-success font-size-12">Published</span>
                                                @elseif ($category->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>
                                                @else
                                                    <span class="mj_btn btn btn-warning">Pending</span>
                                                @endif
                                            </td>


                                            <td class="text-right">
                                                @can('teacher-category-approved')
                                                    <a href="{{ route('teacher.category.update-status', ['id' => $category->id]) }}"
                                                        class="btn {{ $category->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                        <i class="fas fa-arrow-alt-circle-up"></i>
                                                    </a>
                                                @endcan
                                                @can('teacher-category-update')
                                                    <a href=" {{ route('teacher.category.edit', $category->id) }}"
                                                        class="btn btn-success btn-sm waves-effect">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan

                                                {{-- <a href="" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('serviceForm{{ $service->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>

                                                <form method="POST"
                                                    action="{{ route('service.destroy', ['id' => $service->id]) }}"
                                                    id="customerForm{{ $service->id }}">
                                                    @csrf
                                                </form> --}}

                                                @can('teacher-category-delete')
                                                    <a href="" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); document.getElementById('serviceForm{{ $category->id }}').submit();">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                    <form method="POST"
                                                        action="{{ route('teacher.category.destroy', ['id' => $category->id]) }}"
                                                        id="serviceForm{{ $category->id }}">
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
