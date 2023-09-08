<html>

<head>
    <meta charset="UTF-8">
    <title>Education Management System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/select2.min.css') }}">
    <link href=" {{ asset('css/summernote/css/summernote.css') }}" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href=" {{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/swiper/css/swiper.min.css') }}">
    <link href=" {{ asset('vendors/nvd3/css/nv.d3.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/lc_switch.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/custom.css') }}">

    <script type="text/javascript">
        window.print();
        window.onafterprint = function(event) {
            window.close();
        };
    </script>
</head>

<body id="printArea">
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
                            <input type="hidden" name="array[{{ $i }}][fee_id]"
                                value="{{ $fee->id }}">
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
</body>

<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</html>
