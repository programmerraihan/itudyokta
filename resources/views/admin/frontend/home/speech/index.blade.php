@extends('admin.admin_master')


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
                        <h4 class="mb-0 font-size-18">Home Speech</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Light Speech</li>
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

                                {{-- <h4>
                                    <a href="{{ route('add.speech') }}" class=" float-right btn btn-primary">Add Speech</a>

                                </h4> --}}


                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"> Speech info Goers Here</h4>
                            {{-- <h4>
                                <a href="{{ route('add.slide') }}" class=" float-right btn btn-primary">Add Slider</a>
                            </h4> --}}
                            <hr />

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Short Text</th>
                                        {{-- <th>Short Title</th> --}}
                                        <th>Image</th>
                                        {{-- <th>Status</th> --}}

                                        <th class="text-right">Action</th>
                                    </tr>
                                <tbody>
                                    @foreach ($speeches as $speech)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td style="width: 50%">{{ Str::limit($speech->sort_text, 30) }}</td>
                                            {{-- <td>{{ $speech->long_text }}</td> --}}
                                            <td>
                                                <img src="{{ asset('frontend/speech/' . $speech->image) }}" width="100px"
                                                    alt="Slide Image">
                                            </td>




                                            <td class="text-right">

                                                {{-- <a href="{{ route('speech.update-status', ['id' => $speech->id]) }}"
                                                    class="btn {{ $speech->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                                </a> --}}


                                                <a href=" {{ route('speech.edit', $speech->id) }}"
                                                    class="btn btn-success btn-sm waves-effect">
                                                    <i class="fas fa-edit"></i>
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                </thead>



                            </table>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    </div>
@endsection
