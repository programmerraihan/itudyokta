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

                            <div class="row">
                                <div class="col-xl col-sm-6">
                                    <div class="form-group mt-3 mb-0">
                                        <label for="from_date">From <code style="background: none; ">(Date)</code></label>
                                        <input type="date" name="from_date" id="from_date" value="{{ date('Y-m-d') }}"
                                            class="form-control text-bold">
                                    </div>
                                </div>

                                <div class="col-xl col-sm-6">
                                    <div class="form-group mt-3 mb-0">
                                        <label for="to_date">To <code style="background: none; ">(Date)</code></label>
                                        <input type="date" name="to_date" id="to_date" value="{{ date('Y-m-d') }}"
                                            class="form-control text-bold">
                                    </div>
                                </div>

                                <div class="col-xl col-sm-6 align-self-end">
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-primary w-md " id="searchBtn">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr />

                            <table id="showResult" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Expense Name</th>


                                        <th>Bank Name</th>
                                        <th>Date</th>

                                        <th>Expense Amount</th>

                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp


                                    @foreach ($expenses as $expense)
                                        @php
                                            $total += $expense->expense_amount;
                                            // dd($total);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $expense->expense_name }}</td>


                                            <td>{{ $expense->Bank->name }}</td>
                                            <td>{{ $expense->expense_date }}</td>

                                            <td>{{ $expense->expense_amount }}</td>


                                            <td class="text-right">

                                                <a href="{{ route('expense.update-status', ['id' => $expense->id]) }}"
                                                    class="btn {{ $expense->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                                </a>


                                                <a href="{{ route('expense.detail', ['id' => $expense->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-book-open"></i>
                                                </a>
                                                <a href="{{ route('expense.edit', $expense->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('customerForm{{ $expense->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>

                                                <form method="POST"
                                                    action="{{ route('expense.destroy', ['id' => $expense->id]) }}"
                                                    id="customerForm{{ $expense->id }}">
                                                    @csrf
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total:</th>
                                        <th></th>
                                        <th></th>
                                        <th colspan="1" class="text-left">
                                            <b>Total: </b>

                                        </th>
                                        <th>

                                            = {{ $total }}{{ '৳' }}

                                        </th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>
@endsection



@section('script')
    <script>
        window.onload = function() {
            $("#searchBtn").on('click', function() {

                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();

                jQuery.ajax({
                    method: "GET",
                    url: "{{ route('report.expense') }}",
                    data: {

                        from_date,
                        to_date,
                    },
                    success: function(response) {
                        $('#showResult').html(response);
                        $('#datatable').DataTable();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

                return false;
            });
        }
    </script>
@endsection
