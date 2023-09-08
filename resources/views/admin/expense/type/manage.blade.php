@extends('admin.admin_master')


@section('css')
    <style type="text/css">
        fieldset {
            min-width: 0px;
            padding: 15px;
            margin: 7px;
            border: 2px solid #a66df5;
        }

        legend {
            float: none;
            background-image: linear-gradient(to bottom right, #062689, #5b076f);
            padding: 4px;
            width: 50%;
            color: rgb(255, 255, 255);
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
                        <h4 class="mb-0 font-size-18">Add Expense Type</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Expense Type</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @can('expense-type-create')
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset>
                            <legend> Add Expense Type</legend>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body ">

                                        <form action="{{ route('expenseType.store') }}" method="POST">
                                            @csrf

                                            <div class="form-group row mb-4">
                                                <label for="horizontal-firstname-input" class="col-sm-2 col-form-label"> Expense
                                                    Type
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control"
                                                        id="horizontal-firstname-input" placeholder="ExpenseType Name" />
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="horizontal-email-input1" class="col-sm-2 col-form-label">Expense
                                                    Type
                                                    Description</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" name="description" id="horizontal-email-input1"
                                                        placeholder="ExpenseType Description"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label class="col-sm-2 ">Publication Status </label>
                                                <div class="col-sm-10">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" checked type="radio" name="status"
                                                            id="inlineCheckbox1" value="1">
                                                        <label class="form-check-label" for="inlineCheckbox1">Published</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="inlineCheckbox2" value="0">
                                                        <label class="form-check-label"
                                                            for="inlineCheckbox2">Unpublished</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row justify-content-end">
                                                <div class="col-sm-10">

                                                    <div>
                                                        <button type="submit" class="btn btn-primary w-md">Create New Expense
                                                            Type </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            @endcan

            @can("expense-type-view")
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Expense Type info Goers Here</h4>
                            <hr />

                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>SL Name</th>
                                        <th>Expense Type Name</th>
                                        <th>Expense Type Description </th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($expense_types as $expenseType)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $expenseType->name }}</td>
                                            <td>{{ $expenseType->description }}</td>

                                            {{-- <td>{{$bank->status == 1 ? 'Published' : 'Unpublished'}}</td> --}}

                                            <td>
                                                @if ($expenseType->status == 1)
                                                    <span
                                                        class="badge badge-pill badge-soft-success font-size-12">Published</span>
                                                @elseif ($expenseType->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>
                                                @else
                                                    <span
                                                        class="badge badge-pill badge-soft-danger font-size-12">Pending</span>
                                                @endif
                                            </td>

                                            <td class="text-right">
                                                @can("expense-type-approved")
                                                <a href="{{ route('expenseType.update-status', ['id' => $expenseType->id]) }}"
                                                    class="btn {{ $expenseType->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                                </a>
                                                @endcan
                                                @can("expense-type-update")
                                                <a href="{{ route('expenseType.edit', $expenseType->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can("expense-type-delete")
                                                <a href="{{ route('expenseType.destroy', $expenseType->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('categoryForm{{ $expenseType->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>

                                                <form method="POST"
                                                    action="{{ route('expenseType.destroy', $expenseType->id) }}"
                                                    id="categoryForm{{ $expenseType->id }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>

    </div>
@endsection
