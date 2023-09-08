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
                        <h4 class="mb-0 font-size-18">Stock Assets List </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Stock Assets List</li>
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
                            @can('asset-view')
                                <a href="{{ route('assets.index') }}" class="btn btn-info">Assets List</a>
                            @endcan
                            @can('damage-view')
                                <a href="{{ route('damage.index') }}" class="btn btn-info">Damage List</a>
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
                            <h4 class="card-title">Assets Stock</h4>
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
                                        <th class="text-center">Purchase Price (Unit)</th>
                                        <th class="text-center">Total Purcahse Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($assetsWithDamages as $asset)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d/m/y', strtotime($asset->date)) }}</td>
                                            <td>{{ $asset->name }}</td>
                                            <td>{{ optional($asset)->branch->name ?? 'Admin' }}</td>
                                            <td class="text-center">{{ $asset->quantity }}</td>
                                            <td class="text-center">{{ number_format($asset->purchase_price, 2) }}</td>
                                            <td class="text-center">{{ number_format($asset->total_purchase_price, 2) }}
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $assets->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
