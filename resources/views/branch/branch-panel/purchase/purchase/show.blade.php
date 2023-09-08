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
            </div>
            <!-- end page title --> --}}
            <!-- page title area start -->

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"> All Purchase List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Purchase List </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Purchase Goers Here</h4>
                            <hr />

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Challan Number</th>
                                        <th>Recipient Name</th>

                                        <th>Purchase Date</th>



                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $purchase->challan_number }}</td>
                                            <td>{{ $purchase->recipient_name }}</td>

                                            <td>{{ $purchase->purchase_date }}</td>



                                            <td class="text-right">

                                                <a href="{{ route('branch.purchase.detail', ['id' => $purchase->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-book-open"></i>
                                                </a>
                                                <a href="{{ route('branch.purchase.edit', $purchase->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('customerForm{{ $purchase->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>

                                                <form method="POST"
                                                    action="{{ route('branch.purchase.destroy', ['id' => $purchase->id]) }}"
                                                    id="customerForm{{ $purchase->id }}">
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
