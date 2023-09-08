@extends('branch.branch_master')


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
                        <h4 class="mb-0 font-size-18">Student Unit</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Project</li>
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
                                    {{-- <a href="{{ route('add.studentUnit') }}" class=" float-right btn btn-primary">Student Unit
                                       </a> --}}

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
                          <h4 class="card-title">Expense Basic Info Goes Here</h4>
                          <hr />
                          <table class="table table-bordered dt-responsive nowrap  "
                              style="border-collapse: collapse; border-spacing: 5px; width: 100%;">
                              <tr>
                                  <th>Expense ID</th>
                                  <td>{{ $expense->id }}</td>
                              </tr>
                              <tr>
                                  <th>Expense Name</th>
                                  <td>{{ $expense->expense_name }}</td>
                              </tr>
                              <tr>
                                  <th>Expense Amount</th>
                                  <td>{{ $expense->expense_amount }}</td>
                              </tr>
      
      
      
                              <tr>
                                  <th>Payment Method</th>
                                  <td>{{ $expense->Bank->name }}</td>
                              </tr>
                              <tr>
                                  <th>Expense Date</th>
                                  <td>{{ $expense->expense_date }}</td>
                              </tr>
      
      
                              <tr>
                                  <th>Expense Description</th>
                                  <td>{{ $expense->expense_description }}</td>
                              </tr>
      
      
                          </table>
                          <div class="d-print-none">
                              <div class="float-right">
                                  <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i
                                          class="fa fa-print"></i></a>
                              </div>
                          </div>
      
                      </div>
      
                  </div>
              </div>
          </div>



          


        </div>
    </div>

    </div>
@endsection
