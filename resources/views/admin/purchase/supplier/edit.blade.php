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
              <div class="card-body">
                  <h4 class="card-title mb-4">Edit Supplier Info </h4>
                  <hr />

                  <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                      @csrf
                      @method('PUT')

                      <div class="form-group row mb-4">
                          <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Supplier name</label>
                          <div class="col-sm-10">
                              <input type="text" name="name" value="{{ $supplier->name }}" class="form-control"
                                  id="horizontal-firstname-input" />
                          </div>
                      </div>



                      <div class="form-group row mb-4">
                          <label for="horizontal-email-input1" class="col-sm-2 col-form-label">Supplier
                              Description</label>
                          <div class="col-sm-10">
                              <textarea type="text" class="form-control" name="description" id="horizontal-email-input1">{{ $supplier->description }}</textarea>
                          </div>
                      </div>

                      <div class="form-group row mb-4">
                          <label class="col-sm-2 ">Publication Status </label>
                          <div class="col-sm-10">
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" {{ $supplier->status == 1 ? 'checked' : '' }}
                                      type="radio" name="status" id="inlineCheckbox1" value="1">
                                  <label class="form-check-label" for="inlineCheckbox1">Published</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" {{ $supplier->status == 0 ? 'checked' : '' }}
                                      type="radio" name="status" id="inlineCheckbox2" value="0">
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
  </div>
  <!-- end row -->



  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">

                  <h4 class="card-title">All Unit info Goers Here</h4>
                  <hr />

                  <table id="datatable" class="table table-bordered dt-responsive nowrap"
                      style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead class="thead-light">
                          <tr>
                              <th>SL Name</th>
                              <th>Name</th>
                              <th>Description</th>
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
                                  {{-- <td>{{$supplier->status == 1 ? 'Published' : 'Unpublished'}}</td> --}}

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
                                      <a href="{{ route('supplier.update-status', ['id' => $supplier->id]) }}"
                                          class="btn {{ $supplier->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                          <i class="fas fa-arrow-alt-circle-up"></i>
                                      </a>
                                      <a href="{{ route('supplier.edit', $supplier->id) }}"
                                          class="btn btn-success btn-sm">
                                          <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="{{ route('supplier.destroy', $supplier->id) }}"
                                          class="btn btn-danger btn-sm"
                                          onclick="event.preventDefault(); document.getElementById('categoryForm{{ $supplier->id }}').submit();">
                                          <i class="fas fa-trash-alt"></i>
                                      </a>

                                      <form method="POST" action="{{ route('supplier.destroy', $supplier->id) }}"
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
