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
                        <div class="card-body bg-soft-success">
                            <form action=" {{ route('branch.purchase.store') }} " method="POST">
                                @csrf
        
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body bg-cover">
                                                <h4 class="card-title mb-4">New Purchase Item </h4>
                                                <hr />
        
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">Challan Number </label>
                                                            <input type="taxt" name="challan_number" class="form-control"
                                                                id="challan_number">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="formrow-email-input">Recipient's name</label>
                                                            <input type="text" name="recipient_name" class="form-control"
                                                                id="formrow-email-input">
                                                        </div>
                                                    </div>
        
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="formrow-inputZip">Purchase Date</label>
                                                            <input type="date" name="purchase_date" class="form-control"
                                                                id="formrow-inputZip">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="formrow-inputState">Recipient's Phone Number </label>
                                                            <input type="number" name="phone_number" class="form-control"
                                                                id="recipient_number">
                                                        </div>
                                                    </div>
        
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h6>Purchase Importent Note</h6>
                                                            <textarea class="form-control " name="note" type="text" id="horizontal-email-input199"> </textarea>
                                                        </div>
                                                    </div>
        
                                                </div>
        
                                            </div>
                                        </div>
        
        
                                    </div>
        
                                </div>
        
        
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body bg-cover">
        
                                                <div class="row" id="customer_service">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            {{-- dadashow --}}
                                                            <div class="table-responsive ">
                                                                <table class="table table-bordered table-hover ">
                                                                    <thead class="thead-light">
                                                                        <tr>
                                                                            <th>Supplier Name</th>
                                                                            <th>Product Name</th>
                                                                            <th>Unit</th>
        
                                                                            <th>Quantity</th>
                                                                            <th>Price</th>
                                                                            <th>Total Amount</th>
        
                                                                            <th><i class="dripicons-hourglass"></i></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="purchaseTBody">
                                                                        <tr>
                                                                            <td>
                                                                                <select class="form-control"
                                                                                    name="purch[0][supplier]">
                                                                                    <option> -- Select Software -- </option>
                                                                                    @foreach ($suppliers as $supplier)
                                                                                        <option value="{{ $supplier->id }}">
                                                                                            {{ $supplier->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
        
                                                                            <td>
                                                                                <select class="form-control"
                                                                                    name="purch[0][product]">
                                                                                    <option> -- Select Software -- </option>
                                                                                    @foreach ($products as $product)
                                                                                        <option value="{{ $product->id }}">
                                                                                            {{ $product->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <select id="formrow-inputState"
                                                                                    name="purch[0][unit]" class="form-control">
                                                                                    <option selected>-- Select Status --</option>
                                                                                    @foreach ($units as $unit)
                                                                                        <option value="{{ $unit->id }}">
                                                                                            {{ $unit->name }}
                                                                                        </option>
                                                                                    @endforeach
        
                                                                                </select>
                                                                            </td>
        
                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control purchase-unit-price"
                                                                                    data-id="5" min="1"
                                                                                    name="purch[0][unit_price]" id="unitPrice0" />
                                                                            </td>
        
        
                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control purchase_quantity"
                                                                                    data-id="0" min=""
                                                                                    name="purch[0][quantity]" id="quantity0" />
                                                                            </td>
        
        
                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control purchase-total-amount"
                                                                                    data-id="0" min="1" readonly
                                                                                    name="purch[0][total_price]"
                                                                                    id="totalPrice0" />
                                                                            </td>
        
                                                                            <td>
                                                                                <button type="button"
                                                                                    class="btn btn-success btn-sm"
                                                                                    id="purchaseItemBtn"> +
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
        
                                                        </div>
        
                                                    </div>
                                                </div>
        
                                                <hr />
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group ">
                                                            <button type="submit" class="btn btn-primary w-md btn-block">Submit
                                                                Incomes</button>
                                                        </div>
        
                                                    </div>
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Creat New Product </h4>
                            <hr />
                            <form action="{{ route('product.store') }}" method="POST">
                                @csrf
        
                                <div class="form-group row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label"> Product Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="horizontal-firstname-input"
                                            placeholder="Product Name" />
                                    </div>
                                </div>
        
                                <div class="form-group row mb-4">
                                    <label for="horizontal-email-input1" class="col-sm-2 col-form-label">Product
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" name="description" id="horizontal-email-input1"
                                            placeholder="Product Description"></textarea>
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
                                            <button type="submit" class="btn btn-primary w-md">Create New Product </button>
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
        
                            <h4 class="card-title">All Product info Goers Here</h4>
                            <hr />
        
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>SL Name</th>
                                        <th>Product Name</th>
                                        <th>Product Description </th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
        
        
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
        
        
        
                                            <td>
                                                @if ($product->status == 1)
                                                    <span class="badge badge-pill badge-soft-success font-size-12">Published</span>
                                                @elseif ($product->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>
                                                @else
                                                    <span class="badge badge-pill badge-soft-danger font-size-12">Pending</span>
                                                @endif
                                            </td>
        
                                            <td class="text-right">
                                                <a href="{{ route('product.update-status', ['id' => $product->id]) }}"
                                                    class="btn {{ $product->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                                </a>
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('product.destroy', $product->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('categoryForm{{ $product->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
        
                                                <form method="POST" action="{{ route('product.destroy', $product->id) }}"
                                                    id="categoryForm{{ $product->id }}">
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
            </div> --}}

        </div>
    </div>

    </div>
@endsection
