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


            {{-- <!-- start page title -->
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
            </div> --}}
            <!-- end page title -->
  <!-- page title area start -->
  <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Leave Information </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('branch.purchase.manage') }}">Purchase Manage</a></li>
                    <li class="breadcrumb-item active">Purchase Detail </li>
                </ol>
            </div>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice-title">
                    <h4 class="float-right font-size-16">Order: {{ $purchase->challan_number }}</h4>
                    <div class="mb-4">
                        <img src="{{ asset('/') }}assets/images/logo-dark.png" alt="logo" height="20" />
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <strong>Purchase To:</strong><br>
                            Apu Sardar<br>
                            Dhaka<br>

                        </address>
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        <address class="mt-2 mt-sm-0">
                            <strong>Purchase By:</strong><br>
                            {{ $purchase->recipient_name }}<br>
                            {{ $purchase->phone_number }}<br>
                            Stitbd<br>
                            Dhaka
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <address>
                            <strong>Note:</strong><br>
                            {{ $purchase->note }}<br>

                        </address>
                    </div>
                    <div class="col-sm-6 mt-3 text-sm-right">
                        <address>
                            <strong>Purchase Date:</strong><br>
                            {{ $purchase->purchase_date }}<br><br>
                        </address>
                    </div>
                </div>
                <div class="py-2 mt-3">
                    <h3 class="font-size-15 font-weight-bold">Order summary</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 70px;">No.</th>
                                <th>Supplier</th>
                                <th>Product Name</th>
                                <th>Unit </th>
                                <th>Quantity </th>
                                <th>Unit Price </th>
                                <th class="text-right">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase->purchaseItems as $purchaseItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \App\Models\Supplier::find($purchaseItem->supplier)->name }}</td>
                                    <td>{{ \App\Models\Product::find($purchaseItem->product)->name }}</td>
                                    <td>{{ \App\Models\Unit::find($purchaseItem->unit)->name }}</td>

                                    <td>{{ $purchaseItem->unit_price }}</td>
                                    <td>{{ $purchaseItem->quantity }}</td>
                                    <td class="text-right">
                                        {{ number_format($purchaseItem->unit_price * $purchaseItem->quantity) }}
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <tr>
                                <td colspan="6" class="text-right">Sub Total</td>
                                <td class="text-right">$1397.00</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="border-0 text-right">
                                    <strong>Shipping</strong>
                                </td>
                                <td class="border-0 text-right">$13.00</td>
                            </tr> --}}

                            @php
                                
                                $total = 0;
                                foreach ($purchase->purchaseItems as $purchaseItem) {
                                    $total += $purchaseItem->unit_price * $purchaseItem->quantity;
                                }
                                
                                // $total += $order->address()->city->shipping_charges
                                
                            @endphp



                            <tr>
                                <td colspan="6" class="border-0 text-right">
                                    <strong>Total</strong>
                                </td>

                                <td class="border-0 text-right">

                                    <h4 class="m-0">${{ $total }}</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-print-none">
                    <div class="float-right">
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i
                                class="fa fa-print"></i></a>
                        {{-- <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- end row -->

          
        </div>
    </div>

    </div>
@endsection
