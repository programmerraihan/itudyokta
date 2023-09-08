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
{{-- 
                                <h4>
                                    <a href="{{ route('branches-bank.index ') }}" class=" float-right btn btn-primary">Student Unit</a>
                                </h4> --}}


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
              
                                  <form action="{{route('branches-bank.update', $bank->id)}}" method="POST" >
                                      @csrf
                                      @method('PUT')
              
                                      <div class="form-group row mb-4">
                                          <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Bank   name</label>
                                          <div class="col-sm-10">
                                              <input type="text" name="name" value="{{$bank->name}}" class="form-control" id="horizontal-firstname-input"/>
                                          </div>
                                      </div>
              
                                  
              
                                      <div class="form-group row mb-4">
                                          <label for="horizontal-email-input1" class="col-sm-2 col-form-label">Bank  Description</label>
                                          <div class="col-sm-10">
                                              <textarea type="text" class="form-control" name="description"   id="horizontal-email-input1" >{{$bank->description}}</textarea>
                                          </div>
                                      </div>
              
                                      <div class="form-group row mb-4">
                                          <label  class="col-sm-2 ">Publication Status </label>
                                          <div class="col-sm-10">
                                              <div class="form-check form-check-inline">
                                                  <input class="form-check-input" {{$bank->status == 1? 'checked' : ''}}  type="radio" name="status" id="inlineCheckbox1" value="1">
                                                  <label class="form-check-label" for="inlineCheckbox1">Published</label>
                                              </div>
                                              <div class="form-check form-check-inline">
                                                  <input class="form-check-input" {{$bank->status == 0? 'checked' : ''}} type="radio" name="status" id="inlineCheckbox2" value="0">
                                                  <label class="form-check-label" for="inlineCheckbox2">Unpublished</label>
                                              </div>
                                          </div>
                                      </div>
              
              
              
                                      <div class="form-group row justify-content-end">
                                          <div class="col-sm-10">
              
                                              <div>
                                                  <button type="submit" class="btn btn-primary w-md">Update Department info </button>
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


        </div>
    </div>

    </div>
@endsection
