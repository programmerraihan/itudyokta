<table id="datatable" class="table table-bordered dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

    <thead class="thead-dark">
        <tr>
            <th>SL</th>
            <th>Challan Number</th>
            <th>Recipient Name</th>

            <th>Purchase Date</th>
            <th>Sub Total</th>



            <th class="text-right">Action</th>
        </tr>
    </thead>


    <tbody>
        @php
            $total = 0;
        @endphp

        @foreach ($purchases as $purchase)
            @php
                $total_price = 0;
                foreach ($purchase->purchaseItems as $item) {
                    $total_price += $item->total_price;
                
                    $total += $item->total_price;
                }
                // dd($total_price);
            @endphp


            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $purchase->challan_number }}</td>
                <td>{{ $purchase->recipient_name }}</td>

                <td>{{ $purchase->purchase_date }}</td>
                <td>{{ $total_price }}</td>


                <td class="text-right">

                    <a href="{{ route('purchase.detail', ['id' => $purchase->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-book-open"></i>
                    </a>
                    <a href="{{ route('purchase.edit', $purchase->id) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger btn-sm"
                        onclick="event.preventDefault(); document.getElementById('customerForm{{ $purchase->id }}').submit();">
                        <i class="fas fa-trash-alt"></i>
                    </a>

                    <form method="POST" action="{{ route('purchase.destroy', ['id' => $purchase->id]) }}"
                        id="customerForm{{ $purchase->id }}">
                        @csrf
                    </form>

                </td>
            </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>Total:</th>
            <th></th>
            <th></th>
            <th colspan="1" class="text-left">
                <b>Total: </b>
                </br>

            </th>
            <th>
                </br>
                = {{ $total }}{{ '৳' }}

            </th>
            <th></th>
        </tr>
    </tfoot>
</table>
