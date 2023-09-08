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
                        <h4 class="mb-0 font-size-18">Add Damage Product</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Damage Product</li>
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
                            <a href="{{ route("damage.index") }}" class="btn btn-info">Damage List</a>
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
                            <form action="{{ route("damage.store") }}" method="post">
                                @csrf 
                                
                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Date*</label>
                                        <input type="date" name="date" value="{{date('Y-m-d')}}" class="form-control @error('date') is-invalid @endif" required />
                                        @error('date')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Asset Name*</label>
                                        <select name="asset_id" id="name" class="form-control @error('name') is-invalid @enderror" data-placeholder="Select a Asset" required>
                                            <option value="" hidden>Select a Asset</option>
                                            @forelse ($assets as $asset)
                                                <option value="{{$asset->id}}">{{$asset->name}}</option>
                                            @empty                                                
                                            @endforelse
                                        </select>
                                        @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>                            
                                                                    
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Quantity*</label>
                                        <input type="number" min="0" step="any" name="quantity" class="form-control @error('quantity') is-invalid @endif" placeholder="Quantity*" required />
                                        @error('quantity')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>                                    
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Damage Price (Unit)*</label>
                                        <input type="number" min="0" step="any" name="damage_price" class="form-control @error('damage_price') is-invalid @endif" placeholder="Damage Price*" required />
                                        @error('damage_price')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>                                    
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Total Damage Price*</label>
                                        <input type="number" min="0" readonly step="any" name="total_damage_price" class="form-control @error('total_damage_price') is-invalid @endif" placeholder="Toltal Damage Price*" required />
                                        @error('total_damage_price')
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
                let perPrice = $("input[name='damage_price']").val() || 0;
                $("input[name='total_damage_price']").val(Number(quantity * perPrice).toFixed(2));
            }

            ['input[name="quantity"]', 'input[name="damage_price"]'].forEach(element => {
                $(element).on('input', totalPurchasePriceCalculate);
            });
            
            $("#name").select2({});
        });
    </script>
@endsection
