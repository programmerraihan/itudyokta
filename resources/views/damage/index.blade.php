@extends(auth('branch')->check() ? 'branch.branch_master' : 'admin.admin_master')

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
                        <h4 class="mb-0 font-size-18">Damage List </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Damage List</li>
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
                            @can('damage-create')
                            <a href="{{ route('damage.create') }}" class="btn btn-info">Add Damage</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

            {{-- main container --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Damage List</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Product Name</th>
                                        <th>Branch/Owner</th>
                                        <th class="text-center">Qty.</th>
                                        <th class="text-center">Damage Price (Unit)</th>
                                        <th class="text-center">Total Damage Price</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($damages as $damage)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{date("d/m/y", strtotime($damage->date))}}</td>
                                            <td>{{$damage->asset->name}}</td>
                                            <td>{{optional($damage->asset)->branch->name ?? "Admin"}}</td>
                                            <td class="text-center">{{$damage->quantity}}</td>
                                            <td class="text-center">{{number_format($damage->damage_price)}}</td>
                                            <td class="text-center">{{number_format($damage->total_damage_price)}}</td>
                                            <td class="text-center">
                                                @can("damage-update")
                                                <a href="{{ route('damage.edit', ['damage' => $damage->id]) }}"
                                                    class="btn btn-sm btn-info">Edit</a>
                                                @endcan 

                                                @can("damage-delete")
                                                <a href="javascript:void(0)"
                                                    data-href="{{ route('damage.destroy', ['damage' => $damage->id]) }}"
                                                    class="delete_btn btn btn-sm btn-danger">Delete</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $damages->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <form action="" id="delete_form" method="post">@csrf @method('DELETE')</form>
@endsection

@section('script')
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
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete_form').attr('action', href).submit();
                    }
                })
            });
        });
    </script>
@endsection
