<table id="datatable" class="table table-bordered dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

    <thead class="thead-dark">
        <tr>
            <th>SL</th>
            <th>Expense Name</th>


            <th>Bank Name</th>
            <th>Date</th>

            <th>Expense Amount</th>

            <th class="text-right">Action</th>
        </tr>
    </thead>


    <tbody>
        @php
            $total = 0;
        @endphp


        @foreach ($expenses as $expense)
            @php
                $total += $expense->expense_amount;
                // dd($total);
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $expense->expense_name }}</td>


                <td>{{ $expense->Bank->name }}</td>
                <td>{{ $expense->expense_date }}</td>

                <td>{{ $expense->expense_amount }}</td>

                <td class="text-right">

                    <a href="{{ route('expense.update-status', ['id' => $expense->id]) }}"
                        class="btn {{ $expense->status == 1 ? 'btn-info' : 'btn-warning' }} btn-sm">
                        <i class="fas fa-arrow-alt-circle-up"></i>
                    </a>


                    <a href="{{ route('expense.detail', ['id' => $expense->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-book-open"></i>
                    </a>
                    <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger btn-sm"
                        onclick="event.preventDefault(); document.getElementById('customerForm{{ $expense->id }}').submit();">
                        <i class="fas fa-trash-alt"></i>
                    </a>

                    <form method="POST" action="{{ route('expense.destroy', ['id' => $expense->id]) }}"
                        id="customerForm{{ $expense->id }}">
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

            </th>
            <th>

                = {{ $total }}{{ '৳' }}

            </th>
            <th></th>
        </tr>
    </tfoot>
</table>
