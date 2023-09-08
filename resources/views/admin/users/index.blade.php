@extends('admin.admin_master')


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
                        <h4 class="mb-0 font-size-18">User List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">User List</li>
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
                            @can('user-create')
                                <a href="{{ route('users.create') }}" class="btn btn-success">User Create</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

            {{-- @dd($branches); --}}

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>E-mail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @can('user-set-permission')
                                                    <a href="{{ route('users.permission', ['user' => $user->id]) }}"
                                                        class="btn btn-outline-primary btn-sm">Permission</a>
                                                @endcan
                                                @can('user-update')
                                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                        class="btn btn-info btn-sm">Edit</a>
                                                @endcan
                                                @can('user-delete')
                                                    <a href="javascript:void(0)"
                                                        data-href="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                        class="delete_btn btn btn-danger btn-sm">Delete</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can("user-delete")
    <form action="" id="delete_form" method="post">@csrf @method('DELETE')</form>
    @endcan
@endsection

@can("user-delete")
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $(".delete_btn").on('click', function() {
                let href = $(this).data('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete_form').attr('action', href).submit();
                    }
                })
            });
        });
    </script>
@endpush
@endcan