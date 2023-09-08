@extends(auth('branch')->check() ? 'branch.branch_master' : 'admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('sales.index') }}" class="btn btn-sm btn-success">Sale List</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Sale Details</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Date:</b> {{date("d/m/y", strtotime($sale->date))}}</td>
                                        <td><b>Ref. No:</b> {{$sale->reference_no}}</td>
                                        <td><b>Customer:</b> {{$sale->customer}}</td>
                                        <td><b>Phone:</b> {{$sale->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Quantity:</b> {{$sale->quantity}}</td>
                                        <td><b>Amount:</b> {{$sale->grand_total}}</td>
                                        <td colspan="2"><b>Note:</b> {{$sale->note ?? "N/A"}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Unit</th>
                                        <th class="text-center">Qty.</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $saleItems =  $sale->saleItems;
                                    ?>
                                    @forelse ($sale->saleItems as $sale_item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$sale_item->product->name}}</td>
                                            <td>{{$sale_item->unit->name}}</td>
                                            <td class="text-center">{{$sale_item->quantity}}</td>
                                            <td class="text-center">{{$sale_item->unit_price}}</td>
                                            <td class="text-center">{{$sale_item->discount}}</td>
                                            <td class="text-center">{{$sale_item->amount}}</td>
                                        </tr>
                                    @empty                                        
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    
                                    <tr>
                                        <td colspan="3">Total</td>
                                        <td class="text-center">{{$saleItems->sum("quantity")}}</td>
                                        <td>&nbsp;</td>
                                        <td class="text-center">{{$saleItems->sum("discount")}}</td>
                                        <td class="text-center">{{$saleItems->sum("amount")}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
