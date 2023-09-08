@extends(auth('branch')->check() ? 'branch.branch_master' : 'admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('sales.index')}}" class="btn btn-sm btn-success">Sales List</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Add Sale</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route("sales.store")}}" method="post">
                                @csrf 
                                {{-- total quantity --}}
                                <input type="hidden" name="quantity" />
                                <input type="hidden" name="amount" />
                                <input type="hidden" name="discount_amount" />
                                <input type="hidden" name="grand_total" />
                                <div class="form-row">
                                    <div class="col-md-4 col-sm-12 form-group">
                                        <label for="date">Date*</label>
                                        <input type="date" name="date" class="form-control @error("date") is-invalid @enderror " required/>
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-md-6 col-sm-12 form-group">
                                        <label for="reference_no">Reference No*</label>
                                        <input type="text" name="reference_no" class="form-control @error("reference_no") is-invalid @enderror " required/>
                                        @error('reference_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    <div class="col-md-4 col-sm-12 form-group">
                                        <label for="customer">Cutomer*</label>
                                        <input type="text" name="customer" id="customer" placeholder="Customer" class="form-control @error("customer") is-invalid @enderror " required/>
                                        @error('customer')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 form-group">
                                        <label for="phone">Phone</label>
                                        <input type="tel" name="phone" id="phone" placeholder="Phone" class="form-control @error("phone") is-invalid @enderror "/>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea name="note" id="note" cols="30" rows="2" class="form-control" placeholder="Note"></textarea>
                                </div>
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select id="product" class="form-control" data-placeholder="Select a Product">
                                                    <option value="" hidden>Select a Product</option>
                                                    @forelse ($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @empty                                                        
                                                    @endforelse                                                    
                                                </select>
                                            </td>
                                            <td>
                                                <select id="unit" class="form-control" data-placeholder="Select a Unit">
                                                    <option value="" hidden>Select a Unit</option>
                                                    @forelse ($units as $unit)
                                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                    @empty                                                        
                                                    @endforelse
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" min="0" id="quantity" placeholder="Quantity" class="form-control" />
                                            </td>
                                            <td>
                                                <input type="number" min="0" id="price" placeholder="Unit Price" class="form-control" />
                                            </td>
                                            <td>
                                                <input type="number" min="0" id="discount" placeholder="Discount" class="form-control" />
                                            </td>
                                            <td>
                                                <input type="number" min="0" id="total" placeholder="Total" class="form-control" readonly />
                                            </td>
                                            <td>
                                                <button class="btn btn-xs btn-primary" type="button" id="add_product">Add</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-sm table-bordered" id="product_list">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Unit</th>
                                            <th>Qty.</th>
                                            <th>Unit Price</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <th colspan="2" class="text-left">Total</th>
                                            <th id="total_qty"></th>
                                            <th>&nbsp;</th>
                                            <th id="total_discount"></th>
                                            <th id="total_amount"></th>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="form-row">
                                    <div class="col-md-4 col-sm-12">&nbsp;</div>
                                    <div class="col-md-4 col-sm-12 form-group">
                                        <label for="net_amount">Net Amount</label>
                                        <input type="number" name="net_amount" id="net_amount" placeholder="Net Amount" class="form-control @error("net_amount") is-invalid @enderror "/>
                                        @error('net_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 col-sm-12">&nbsp;</div>
                                    <div class="col-md-4 col-sm-12 form-group">
                                        <label for="paid_amount">Paid Amount</label>
                                        <input type="number" name="paid_amount" id="paid_amount" placeholder="Paid Amount" class="form-control @error("paid_amount") is-invalid @enderror "/>
                                        @error('paid_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">Save</button>
                                </div>
                            </form>                                                                    
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
            $("#unit").select2({});
            $("#product").select2({});
            var products = @json($products);
            var units = @json($units);
            
            $("#add_product").on("click", function() {
                let productId = $("#product").val();
                let unitId = $("#unit").val();
                let product = products.find(function (product) {
                    if(product.id == productId) {
                        return product;
                    }
                });
                let unit = units.find(function (unit) {
                    if(unit.id == unitId) {
                        return unit;
                    }
                });
                let quantity = $("#quantity").val() || 1;
                let price = $("#price").val() || 0;
                let discount = $("#discount").val() || 0;
                let total = $("#total").val() || 0;
                let output = '<tr>';
                    output += `<input type="hidden" name="product_id[]" value="${product.id}" />`;
                    output += `<input type="hidden" name="unit_id[]" value="${unit.id}" />`;
                    output += `<td><input type="text" readonly name="product_name[]" value="${product.name}" class="form-control" /></td>`;
                    output += `<td><input type="text" readonly name="unit_name[]" value="${unit.name}" class="form-control" /></td>`;
                    output += `<td><input type="number" min="0" name="unit_quantity[]" value="${quantity}" class="form-control quantity" /></td>`;
                    output += `<td><input type="number" min="0" name="unit_price[]" value="${price}" class="form-control price" /></td>`;
                    output += `<td><input type="number" min="0" name="unit_discount[]" value="${discount}" class="form-control discount" /></td>`;
                    output += `<td><input type="number" min="0" name="unit_total[]" value="${total}" class="form-control total" readonly /></td>`;
                    output += `<td><button class="btn btn-xs btn-outline-danger delete_btn" type="button">Remove</button></td>`;
                    output += '</tr>'
                $("#product_list tbody").append(output);                
                $("#quantity").val('');
                $("#price").val('');
                $("#discount").val('');
                $("#total").val('');
                footerTotalCalculate();
            });

            function calculate() {
                let tr = $(this).closest('tr');
                let quantity = $(tr).find('.quantity').val();
                let price = $(tr).find(".price").val();
                let discount = $(tr).find(".discount").val() || 0;
                let grand = (price * quantity) - discount;
                $(tr).find(".total").val(grand);
                footerTotalCalculate();
            }

            function footerTotalCalculate() {
                let qtyFiled = $("#product_list tbody").find(".quantity");
                let discountField = $("#product_list tbody").find(".discount");
                let totalField = $("#product_list tbody").find(".total");
                let totalQty = 0;
                let totalDiscount = 0;
                let totalAmount = 0;
            
                qtyFiled.map((index, element) => {
                    totalQty += +$(element).val();
                });
                discountField.map((index, element) => {
                    totalDiscount += +$(element).val();
                });
                totalField.map((index, element) => {
                    totalAmount += +$(element).val();
                });
                $('#total_qty').text(totalQty);
                $('#total_discount').text(totalDiscount);
                $('#total_amount').text(totalAmount);
                $('#net_amount').val(totalAmount);
                $('#paid_amount').val(totalAmount);
                $('input[name="amount"]').val(totalAmount);
                $('input[name="discount_amount"]').val(totalDiscount);
                $('input[name="grand_total"]').val(totalAmount - totalDiscount);
                $('input[name="quantity"]').val(totalQty);
            }

            $(document).on("input", ".quantity", calculate);
            $(document).on("input", ".price", calculate);
            $(document).on("input", ".discount", calculate);
            $(document).on("input", ".total", calculate);

            $(document).on("click", ".delete_btn", function () {
                let tr = $(this).closest("tr");
                $(tr).remove();
            });

            function totalCalculate() {
                let quantity = $("#quantity").val() || 0;
                let price = $("#price").val() || 0;
                let discount = $("#discount").val() || 0;
                $("#total").val((quantity * price) - discount)
            }

            $('#quantity').on("input", totalCalculate);
            $('#price').on("input", totalCalculate);
            $('#discount').on("input", totalCalculate);

        });
    </script>
@endpush

