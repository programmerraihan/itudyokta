@extends('branch.branch_master')


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
                        <h4 class="mb-0 font-size-18">Add Student</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Student</li>
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
                            <h4 class="card-title mb-4">Creat New Supplier </h4>
                            <hr />
                            <form action="{{ route('branches-supplier.store') }}" method="POST">
                                @csrf
        
                                <div class="form-group row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label"> Supplier Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="horizontal-firstname-input"
                                            placeholder="Supplier Name" />
                                    </div>
                                </div>
        
                                <div class="form-group row mb-4">
                                    <label for="horizontal-email-input1" class="col-sm-2 col-form-label">Supplier
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" name="description" id="horizontal-email-input1"
                                            placeholder="Supplier Description"></textarea>
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
                                            <input class="form-check-input" type="radio" name="status" id="inlineCheckbox2"
                                                value="0">
                                            <label class="form-check-label" for="inlineCheckbox2">Unpublished</label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-10">
        
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Create New Supplier </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        
        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
        
                            <h4 class="card-title">All Supplier info Goers Here</h4>
                            <hr />
        
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>SL Name</th>
                                        <th>Supplier Name</th>
                                        <th>Supplier Description </th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
        
        
                                <tbody>
                                    @foreach ($suppliers as $supplier)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->description }}</td>
        
        
        
                                            <td>
                                                @if ($supplier->status == 1)
                                                    <span class="badge badge-pill badge-soft-success font-size-12">Published</span>
                                                @elseif ($supplier->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>
                                                @else
                                                    <span class="badge badge-pill badge-soft-danger font-size-12">Pending</span>
                                                @endif
                                            </td>
        
                                            <td class="text-right">
                                                <a href="{{ route('branch.supplier.update-status', ['id' => $supplier->id]) }}"
                                                    class="btn {{ $supplier->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                                </a>
                                                <a href="{{ route('branches-supplier.edit', $supplier->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('branches-supplier.destroy', $supplier->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('categoryForm{{ $supplier->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
        
                                                <form method="POST" action="{{ route('branches-supplier.destroy', $supplier->id) }}"
                                                    id="categoryForm{{ $supplier->id }}">
                                                    @csrf
                                                    @method('delete')
        
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
