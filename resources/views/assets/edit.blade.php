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
                        <h4 class="mb-0 font-size-18">Add Assets</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Assets</li>
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
                            <a href="{{ route("assets.index") }}" class="btn btn-info">Assets List</a>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- main container --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Add Assets</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route("assets.update", ['asset' => $asset->id]) }}" method="post">
                                @csrf @method('PUT')
                                
                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Date*</label>
                                        <input type="date" name="date" value="{{$asset->date}}" class="form-control @error('date') is-invalid @endif" required />
                                        @error('date')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Asset Name*</label>
                                        <input type="text" name="name" value="{{ $asset->name }}" class="form-control @error('name') is-invalid @endif" placeholder="Asset Name*" required />
                                        @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>                                   
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Supplier Name*</label>
                                        <input type="text" name="supplier_name" value="{{ $asset->supplier_name }}" class="form-control @error('supplier_name') is-invalid @endif" placeholder="Supplier Name*" required />
                                        @error('supplier_name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>                                    
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Quantity*</label>
                                        <input type="number" min="0" step="any" value="{{ $asset->quantity }}" name="quantity" class="form-control @error('quantity') is-invalid @endif" placeholder="Quantity*" required />
                                        @error('quantity')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>                                    
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Purchase Price (Unit)*</label>
                                        <input type="number" min="0" step="any" value="{{ $asset->purchase_price }}" name="purchase_price" class="form-control @error('purchase_price') is-invalid @endif" placeholder="Purchase Price*" required />
                                        @error('purchase_price')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>                                    
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Total Purchase Price*</label>
                                        <input type="number" min="0" step="any" readonly value="{{ $asset->total_purchase_price }}" name="total_purchase_price" class="form-control @error('total_purchase_price') is-invalid @endif" placeholder="Toltal Purchase Price*" required />
                                        @error('total_purchase_price')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>                                    
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            function totalPurchasePriceCalculate() {
                let quantity = $("input[name='quantity']").val() || 0;
                let perPrice = $("input[name='purchase_price']").val() || 0;
                $("input[name='total_purchase_price']").val(Number(quantity * perPrice).toFixed(2));
            }

            ['input[name="quantity"]', 'input[name="purchase_price"]'].forEach(element => {
                $(element).on('input', totalPurchasePriceCalculate);
            });
            
        });
    </script>
@endsection
