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

            <!-- page title area start -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Edit Purchase Item Form</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('branch.purchase.manage') }}">Purchase
                                        Manage</a></li>
                                <li class="breadcrumb-item active"> Purchase Edit </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            {{-- @dd($purchase); --}}


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body bg-soft-success">
                            <form action=" {{ route('branch.purchase.update', ['id' => $purchase->id]) }} " method="POST">

                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body bg-cover">
                                                <h4 class="card-title mb-4">Edit Purchase Item </h4>
                                                <hr />

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">Challan Number </label>
                                                            <input type="taxt" value="{{ $purchase->challan_number }}"
                                                                name="challan_number" class="form-control"
                                                                id="challan_number">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="formrow-email-input">Recipient's name</label>
                                                            <input type="text" value="{{ $purchase->recipient_name }}"
                                                                name="recipient_name" class="form-control"
                                                                id="formrow-email-input">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="formrow-inputZip">Purchase Date</label>
                                                            <input type="date" value="{{ $purchase->purchase_date }}"
                                                                name="purchase_date" class="form-control"
                                                                id="formrow-inputZip" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="formrow-inputState">Recipient's Phone Number
                                                            </label>
                                                            <input type="number" value="{{ $purchase->phone_number }}"
                                                                name="phone_number" class="form-control"
                                                                id="recipient_number">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h6>Purchase Importent Note</h6>
                                                            <textarea class="form-control " name="note" type="text" id="horizontal-email-input199">{{ $purchase->note }} </textarea>
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
                                                                        @foreach ($purchase->purchaseItems as $key => $purchaseItems)
                                                                            <tr>
                                                                                <td>
                                                                                    <select class="form-control"
                                                                                        name="purch[{{ $key }}][supplier]">
                                                                                        <option> -- Select Software --
                                                                                        </option>
                                                                                        @foreach ($suppliers as $supplier)
                                                                                            <option
                                                                                                value="{{ $supplier->id }}"
                                                                                                {{ $purchaseItems->supplier == $supplier->id ? 'selected' : '' }}>
                                                                                                {{ $supplier->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>


                                                                                <td>
                                                                                    <select class="form-control"
                                                                                        name="purch[{{ $key }}][product]">
                                                                                        <option> -- Select Software --
                                                                                        </option>
                                                                                        @foreach ($products as $product)
                                                                                            <option
                                                                                                value="{{ $product->id }}"
                                                                                                {{ $purchaseItems->product == $product->id ? 'selected' : '' }}>
                                                                                                {{ $product->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>


                                                                                <td>
                                                                                    <select
                                                                                        name="purch[{{ $key }}][unit]"
                                                                                        class="form-control">
                                                                                        <option selected>-- Select Status --
                                                                                        </option>
                                                                                        @foreach ($units as $unit)
                                                                                            <option
                                                                                                value="{{ $unit->id }}"
                                                                                                {{ $purchaseItems->unit == $unit->id ? 'selected' : '' }}>
                                                                                                {{ $unit->name }}
                                                                                            </option>
                                                                                        @endforeach

                                                                                    </select>
                                                                                </td>



                                                                                <td>
                                                                                    <input type="number"
                                                                                        class="form-control purchase-unit-price"
                                                                                        value="{{ $purchaseItems->unit_price }}"
                                                                                        data-id="{{ $key }}"
                                                                                        min="1"
                                                                                        name="purch[{{ $key }}][unit_price]"
                                                                                        id="unitPrice{{ $key }}" />
                                                                                </td>



                                                                                <td>
                                                                                    <input type="number"
                                                                                        class="form-control purchase_quantity"
                                                                                        value="{{ $purchaseItems->quantity }}"
                                                                                        data-id="{{ $key }}"
                                                                                        min="1"
                                                                                        name="purch[{{ $key }}][quantity]"
                                                                                        id="quantity{{ $key }}" />
                                                                                </td>



                                                                                <td>
                                                                                    <input type="number"
                                                                                        class="form-control purchase-total-amount"
                                                                                        value="{{ $purchaseItems->total_price }}"
                                                                                        data-id="{{ $key }}"
                                                                                        min="1" readonly
                                                                                        name="purch[{{ $key }}][total_price]"
                                                                                        id="totalPrice{{ $key }}" />
                                                                                </td>

                                                                                <td>
                                                                                    @if ($key == 0)
                                                                                        <button type="button"
                                                                                            class="btn btn-success btn-sm"
                                                                                            id="purchaseItemBtn"> +
                                                                                        </button>
                                                                                    @else
                                                                                        <button type="button"
                                                                                            class="btn btn-danger purchase-remove-btn">
                                                                                            - </button>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
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
                                                            <button type="submit" class="btn btn-primary w-md btn-block">
                                                                purchase
                                                                Items Submit</button>
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
