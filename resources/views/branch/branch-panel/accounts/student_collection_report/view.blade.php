<div class="card">
    <div class="card-header">
        <a href="{{ route('branch.collection.student.report.print', ['student_id' => $student_id]) }}"
            class="btn btn-primary" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-hover" id="sample_1" style="width:100%">
                <thead>
                    <tr>
                        <th>Head Name</th>

                        <th>Generated Price</th>
                        <th>Waiver Amount</th>
                        <th>Fine Amount</th>
                        <th>Total Amounts</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>

                    </tr>
                </thead>
                <tbody>

                    @php
                        $AssignFee = 0;
                        $TotalAmount = 0;
                        $TotalAmountOrginal = 0;
                        $TotalPaidAmount = 0;
                        $TotalDiscountAmount = 0;
                        $TotalDueAmount = 0;
                        $fineAmount = 0;
                        $TotalfineAmount = 0;
                        $total_amounts = 0;
                    @endphp
                    @foreach ($fees as $i => $fee)
                        @if ($fee->due > 0)
                            <input type="hidden" name="array[{{ $i }}][fee_id]" value="{{ $fee->id }}">
                            <input type="hidden" name="array[{{ $i }}][account_head_id]"
                                value="{{ $fee->account_head_id }}">
                            @php
                                $DiscountAmount = App\Models\StudentFeeCollections::where('fee_id', $fee->id)->sum('discount');
                                $fineAmount = App\Models\StudentFeeCollections::where('fee_id', $fee->id)->sum('fine');
                                $TotalDiscountAmount += $DiscountAmount;
                                $TotalfineAmount += $fineAmount;
                                
                                $TotalDueAmount += $fee->due;
                                $TotalPaidAmount += $fee->paid;
                                $TotalAmountOrginal += $fee->amount;
                                
                            @endphp
                            <tr>
                                <th>
                                    {{ \Carbon\Carbon::parse($fee['fee_date'])->format('F') }},
                                </th>
                                <th style="text-align: right;">{{ $fee->amount }}</th>
                                <th style="text-align: right;">{{ $DiscountAmount }}</th>
                                <th style="text-align: right;">{{ $fineAmount }}</th>
                                <th style="text-align: right;">
                                    {{ $fee->amount - $DiscountAmount + $fineAmount }}</th>
                                <th style="text-align: right;">{{ $fee->paid }}</th>
                                <th style="text-align: right;">{{ $fee->due }}</th>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <th colspan="1" style="text-align: right;"> Total :</th>
                        <th style="text-align: right;">{{ $TotalAmountOrginal }}</th>
                        <th style="text-align: right;">{{ $TotalDiscountAmount }}</th>
                        <th style="text-align: right;">{{ $TotalfineAmount }}</th>
                        <th style="text-align: right;">
                            {{ $TotalAmountOrginal + $TotalfineAmount - $TotalDiscountAmount }}
                        </th>
                        <th style="text-align: right;">{{ $TotalPaidAmount }}</th>
                        <th style="text-align: right;">{{ $TotalDueAmount }}</th>

                    </tr>

                </tbody>
            </table>

        </div>
    </div>
</div>
