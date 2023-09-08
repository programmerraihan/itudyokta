@extends(auth('branch')->check() ? 'branch.branch_master' : 'admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-success">Add Sales</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Sales List</h4>
                        </div>
                        <div class="card-body">
                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    {{ session('message') }}
                                </div>
                            @endif
                            <table  id="datatable" class="table table-sm table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Ref. No</th>
                                        <th>Customer</th>
                                        <th>Qty.</th>
                                        <th>Amount</th>
                                        <th>Due</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sales as $sale)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d/m/y', strtotime($sale->date)) }}</td>
                                            <td>{{ $sale->reference_no }}</td>
                                            <td>{{ $sale->customer }}</td>
                                            <td>{{ $sale->quantity }}</td>
                                            <td>{{ $sale->grand_total }}</td>
                                            <td>{{ $sale->due_amount }}</td>
                                            <td>
                                                @if (auth()->check())
                                                    <a target="_blank" href="{{ route('sales.invoice', ['sale' => $sale->id]) }}"
                                                        class="btn btn-sm btn-success">Invoice</a>
                                                    @can('sale-view')
                                                        <a href="{{ route('sales.show', ['sale' => $sale->id]) }}"
                                                            class="btn btn-sm btn-info">Details</a>
                                                    @endcan
                                                    @can('sale-update')
                                                        <a href="{{ route('sales.edit', ['sale' => $sale->id]) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>
                                                    @endcan
                                                    <hr>
                                                    <a href="{{ route('sales.dueCollection', ['sale' => $sale->id]) }}"
                                                        class="btn btn-sm btn-primary">Due Collection</a>
                                                    @can('sale-delete')
                                                        <a href="javascript:void(0)"
                                                            data-href="{{ route('sales.destroy', ['sale' => $sale->id]) }}"
                                                            class="btn btn-sm btn-danger delete_btn">Delete</a>
                                                    @endcan
                                                @else
                                                    <a target="_blank" href="{{ route('sales.invoice', ['sale' => $sale->id]) }}"
                                                        class="btn btn-sm btn-info">Invoice</a>
                                                    <a href="{{ route('sales.show', ['sale' => $sale->id]) }}"
                                                        class="btn btn-sm btn-info">Details</a>
                                                    <a href="{{ route('sales.edit', ['sale' => $sale->id]) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="{{ route('sales.dueCollection', ['sale' => $sale->id]) }}"
                                                        class="btn btn-sm btn-primary">Due Collection</a>
                                                    <a href="javascript:void(0)"
                                                        data-href="{{ route('sales.destroy', ['sale' => $sale->id]) }}"
                                                        class="btn btn-sm btn-danger delete_btn">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="7">No Data Found!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">{{ $sales->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="" id="delete_form" method="post">@csrf @method('DELETE')</form>
@endsection



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
