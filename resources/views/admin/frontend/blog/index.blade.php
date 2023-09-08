@extends('admin.admin_master')


@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
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
                        <h4 class="mb-0 font-size-18">Blog</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Blog</li>
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
                                    <a href="{{ route('add.blog') }}" class=" float-right btn btn-primary">Add
                                        Blog</a>

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

                            <h4 class="card-title"> Speech info Goers Here</h4>
                            {{-- <h4>
                                <a href="{{ route('add.slide') }}" class=" float-right btn btn-primary">Add Slider</a>
                            </h4> --}}
                            <hr />
                            {{-- id="datatable-buttons" --}}
                            <table id="blog_table"
                                class="table table-striped table-bordered dt-responsive nowrap  blog_table"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr style="background-image: linear-gradient(to bottom right, #062689, #5b076f);">
                                        <th>SL</th>
                                        <th>Title</th>
                                        {{-- <th>Short Title</th> --}}
                                        <th>Image</th>
                                        <th>Status</th>

                                        <th class="text-right">Action</th>
                                    </tr>
                                    {{-- <tbody>
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $blog->title }}</td>

                                            <td>
                                                <img src="{{ asset('frontend/blog/' . $blog->image) }}" width="100px"
                                                    alt="Slide Image">
                                            </td>

                                            <td>
                                                @if ($blog->status == 1)
                                                    <span
                                                        class="badge badge-pill badge-soft-success font-size-12">Published</span>
                                                @elseif ($blog->status == 0)
                                                    <span
                                                        class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>
                                                @else
                                                    <span class="mj_btn btn btn-warning">Pending</span>
                                                @endif
                                            </td>


                                            <td class="text-right">

                                                <a href="{{ route('blog.update-status', ['id' => $blog->id]) }}"
                                                    class="btn {{ $blog->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                                </a>


                                                <a href=" {{ route('blog.edit', $blog->id) }}"
                                                    class="btn btn-success btn-sm waves-effect">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('blogForm{{ $blog->id }}').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>

                                                <form method="POST"
                                                    action="{{ route('blog.destroy', ['id' => $blog->id]) }}"
                                                    id="blogForm{{ $blog->id }}">
                                                    @csrf
                                                </form>



                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody> --}}
                                </thead>

                            </table>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal" id="DeleteModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div style="text-align:center; font-size: 14px; color: #9d0000; font-weight: 700;">
                        Are you sure want to delete this Data?
                    </div>

                    <div style="padding: 10px; width: fit-content; margin: auto;">
                        <button type="button" class="btn btn-primary" id="SubmitDeleteForm"
                            style="padding: 2px; width: 50px;">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            style="padding: 2px; width: 50px;">No</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//code.jquery.com/jquery.js"></script>

    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#blog_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('blog.get') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            var deleteID;
            $('body').on('click', '.delete', function() {
                deleteID = $(this).data('id');
            })
            $('#SubmitDeleteForm').click(function(e) {
                e.preventDefault();

                var id = deleteID;
                var url = "{{ route('blog.destroy', ':id') }}";
                url = url.replace(':id', id);
                console.log(1);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(result) {
                        setTimeout(function() {
                            $('.blog_table').DataTable().ajax.reload(null, false);
                            //   $('#DeleteModal').modal('hide');
                            $("#DeleteModal .close").click()
                        }, 1000);
                    }
                });
            });

        });
    </script>
@endsection
