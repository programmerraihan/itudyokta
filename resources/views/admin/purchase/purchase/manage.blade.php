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
                            <form action=" {{ route('purchase.store') }} " method="POST">
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
                                                            <label for="formrow-inputState">Recipient's Phone Number
                                                            </label>
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
                                                                                    name="purch[0][unit]"
                                                                                    class="form-control">
                                                                                    <option selected>-- Select Status --
                                                                                    </option>
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
                                                                                    name="purch[0][unit_price]"
                                                                                    id="unitPrice0" />
                                                                            </td>


                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control purchase_quantity"
                                                                                    data-id="0" min=""
                                                                                    name="purch[0][quantity]"
                                                                                    id="quantity0" />
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
                                                            <button type="submit"
                                                                class="btn btn-primary w-md btn-block">Submit
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


        </div>
    </div>

    </div>
@endsection
