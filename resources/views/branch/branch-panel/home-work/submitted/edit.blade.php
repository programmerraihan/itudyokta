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
                        <h4 class="mb-0 font-size-18">Edit Student Unit</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Edit Student Unit</li>
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
                                    <a href="{{ route('studentUnit.index') }}" class=" float-right btn btn-primary">Student Unit</a>
                                </h4>


                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> Edit Student Unit</legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body "> 

                                  <h4 class="card-title mb-4">Edit Bank   Info </h4>
                                  <hr/>
              
                                  <form action="{{ route('expense.update', ['id' => $expense->id]) }}" method="POST">
                                    @csrf
            
            
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-4">Edit Expense </h4>
                                                    <hr />
            
            
            
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name"> Expense Name</label>
                                                                <input type="text" value="{{ $expense->expense_name }}"
                                                                    name="expense_name" class="form-control" id="name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="formrow-email-input">Expense Amount</label>
                                                                <input type="number" value="{{ $expense->expense_amount }}"
                                                                    name="expense_amount" class="form-control" id="formrow-email-input">
                                                            </div>
                                                        </div>
            
                                                    </div>
            
            
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name">Expense Categary</label>
            
                                                                <select class="form-control select2" name="expenseType_id"
                                                                    id="formrow-inputStatea0" name="identification_id">
                                                                    <option selected> -- Select Expense Categary -- </option>
                                                                    @foreach ($expense_types as $expenseType)
                                                                        <option value="{{ $expenseType->id }}"
                                                                            {{ $expenseType->id == $expense->expenseType_id ? 'selected' : '' }}>
                                                                            {{ $expenseType->name }}</option>
                                                                    @endforeach
                                                                </select>
            
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name">Payment Method</label>
            
                                                                <select class="form-control select2" id="formrow-inputStatea1"
                                                                    name="bank_id">
                                                                    <option selected> -- Select Payment Method -- </option>
                                                                    @foreach ($banks as $bank)
                                                                        <option value="{{ $bank->id }}"
                                                                            {{ $bank->id == $expense->bank_id ? 'selected' : '' }}>
                                                                            {{ $bank->name }}</option>
                                                                    @endforeach
                                                                </select>
            
                                                            </div>
                                                        </div>
            
                                                    </div>
            
            
            
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Expense Date</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="expense_date"
                                                                    value="{{ $expense->expense_date }}" placeholder="dd M, yyyy"
                                                                    data-date-format="dd M, yyyy" data-provide="datepicker"
                                                                    data-date-autoclose="true">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
            
                                                            </div>
                                                        </div>
            
                                                    </div>
                                                    &nbsp
                                                    &nbsp
            
            
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="name"> Expense Description </label>
                                                                <textarea class="form-control" type="text" name="expense_description" id="horizontal-email-input195"> {{ $expense->expense_description }} </textarea>
                                                            </div>
                                                        </div>
            
            
                                                    </div>
            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body pb-1">
                                                <div class="form-group ">
                                                    <button type="submit" class="btn btn-primary w-md btn-block">Edit
                                                        Expense </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" hidden checked type="radio" name="status"
                                                id="inlineRadio1" value="1" />
                                            <label class="form-check-label" hidden for="inlineRadio1"> Approved </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" hidden type="radio" name="status" id="inlineRadio2"
                                                value="0" />
                                            <label class="form-check-label" hidden for="inlineRadio2"> Refuse</label>
                                        </div>
            
                                    </div>
            
                                </form>
                                </div>


                            </div>
                        </div>
                    </fieldset>
                </div>
              </div>


        </div>
    </div>

    </div>
@endsection
