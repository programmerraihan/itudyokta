<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sale Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700;800&family=Ysabeau+Infant:wght@300;400;600;700;800&family=Ysabeau+SC:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            /* font-family: 'Raleway', sans-serif; */
            /* font-family: 'Ysabeau SC', sans-serif; */
            font-family: 'Ysabeau Infant', sans-serif;
            padding: 0;
            margin: 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .page {
            width: 29.7cm;
            height: 21cm;
        }

        @media print {
            @page {
                size: landscape;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container p-0 m-0">
        <div class="page">
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1">
                    <div class="card border-0 p-0 m-0 position-relative" style="width: 14.85cm;height:25cm;">
                        <div class="card-body">
                            <div>
                                <div class="d-flex justify-content-between">
                                    @if($sale->branch_id)
                                    <div>
                                        <p class="p-2 m-0"><b>{{$sale->branch->name}}</b></p>
                                        <p class="p-2 m-0"><i>{{$sale->branch->address}}</i></p>
                                    </div>
                                    @else 
                                    <div>
                                        <p class="p-2 m-0"><b>It Udyokta Foundation</b></p>
                                        <p class="p-2 m-0"><i></i></p>
                                    </div>
                                    @endif
                                    <div>
                                        <h1 class="m-0 p-2">SALE INVOICE</h1>
                                        <p class="m-0 p-2 text-end"><small>OFFICE COPY</small></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-5">
                                    <div class="flex-grow-1 p-1"><b>Ref. No:</b>&nbsp;&nbsp;{{$sale->reference_no}}</div>
                                    <div class="flex-grow-1 p-1"><b>Date:</b>&nbsp;&nbsp;{{date("d/m/y", strtotime($sale->date))}}</div>
                                    <div class="flex-grow-1 p-1"><b>Name:</b>&nbsp;&nbsp;{{$sale->customer}}</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 p-1"><b>Phone:</b>&nbsp;&nbsp;{{$sale->phone ?? ""}}</div>
                                    @if($sale->branch_id)
                                    <div class="flex-grow-1 p-1"><b>Branch:</b>&nbsp;&nbsp;{{$sale->branch->name}}</div>
                                    <div class="flex-grow-1 p-1">&nbsp;&nbsp;</div>
                                    @else 
                                    <div class="flex-grow-1 p-1"><b>Branch:</b>&nbsp;&nbsp;N/A</div>
                                    <div class="flex-grow-1 p-1">&nbsp;&nbsp;</div>
                                    @endif
                                </div>
                            </div>
                            <div class="pt-3">
                                <table class="table table-sm table-bordered border-1 border-dark">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-light">SL</th>
                                            <th class="bg-light">Item Description</th>
                                            <th class="text-center bg-light">Price</th>
                                            <th class="text-center bg-light">Qty</th>
                                            <th class="text-center bg-light">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $totalRow = 10;
                                            $extraRow = 10 - $sale->saleItems->count();  
                                            $sl = 0;  
                                        ?>
                                        @foreach ($sale->saleItems as $sale_item)
                                        <?php
                                            $sl ++;
                                        ?>
                                        <tr>
                                            <td class="text-center">{{$sl}}</td>
                                            <td>{{$sale_item->product->name}}</td>
                                            <td class="text-center">{{number_format($sale_item->unit_price)}}</td>
                                            <td class="text-center">{{$sale_item->quantity}}</td>
                                            <td class="text-center">{{number_format($sale_item->amount)}}</td>
                                        </tr>
                                        @endforeach

                                        @for ($i = 0; $i < $extraRow; $i++)
                                        <tr>
                                            <td class="text-center">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>
                                        
                                        <tr class="border-0">
                                            <td colspan="5" class="text-center border-0">Payment History</td>
                                        </tr>
                                        <tr class="border-1">
                                            <th colspan="4" class="text-end border-1">Date</th>
                                            <td class="text-center border-1">Amount</td>
                                        </tr>
                                        @foreach ($sale->salePayment as $item)
                                        <tr class="border-1">
                                            <th colspan="4" class="text-end border-1">{{$item->date}}</th>
                                            <td class="text-center border-1">{{number_format($item->paid_amount)}}</td>
                                        </tr>
                                        @endforeach

                                        

                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Total:</th>
                                            <td class="text-center border-0">{{number_format($sale->amount)}}</td>
                                        </tr>
                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Discount:</th>
                                            <td class="text-center border-0">{{number_format($sale->discount_amount)}}</td>
                                        </tr>
                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Grand Total:</th>
                                            <td class="text-center border-0">{{number_format($sale->grand_total)}}</td>
                                        </tr>
                                        
                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Paid Amount:</th>
                                            <td class="text-center border-0">{{number_format($sale->paid_amount)}}</td>
                                        </tr>
                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Due Amount:</th>
                                            <td class="text-center border-0">{{number_format($sale->due_amount)}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div>
                                    <b>In Word:</b> {{convertNumber($sale->paid_amount)}} tk Only
                                </div>
                            </div>
                        </div>
                        {{-- authorized signature box --}}
                        <div class="position-absolute" style="bottom:-25px;right:65px;">
                            <p class="p-0 m-0"><b>Signature</b></p>
                        </div>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="card border-0 p-0 m-0 position-relative" style="width: 14.85cm;height:25cm;">
                        <div class="card-body">
                            <div>
                                <div class="d-flex justify-content-between">
                                    @if($sale->branch_id)
                                    <div>
                                        <p class="p-2 m-0"><b>{{$sale->branch->name}}</b></p>
                                        <p class="p-2 m-0"><i>{{$sale->branch->address}}</i></p>
                                    </div>
                                    @else 
                                    <div>
                                        <p class="p-2 m-0"><b>It Udyokta Foundation</b></p>
                                        <p class="p-2 m-0"><i></i></p>
                                    </div>
                                    @endif
                                    <div>
                                        <h1 class="m-0 p-2">SALE INVOICE</h1>
                                        <p class="m-0 p-2 text-end"><small>CUSTOMER COPY</small></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-5">
                                    <div class="flex-grow-1 p-1"><b>Ref. No:</b>&nbsp;&nbsp;{{$sale->reference_no}}</div>
                                    <div class="flex-grow-1 p-1"><b>Date:</b>&nbsp;&nbsp;{{date("d/m/y", strtotime($sale->date))}}</div>
                                    <div class="flex-grow-1 p-1"><b>Name:</b>&nbsp;&nbsp;{{$sale->customer}}</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 p-1"><b>Phone:</b>&nbsp;&nbsp;{{$sale->phone ?? ""}}</div>
                                    @if($sale->branch_id)
                                    <div class="flex-grow-1 p-1"><b>Branch:</b>&nbsp;&nbsp;{{$sale->branch->name}}</div>
                                    <div class="flex-grow-1 p-1">&nbsp;&nbsp;</div>
                                    @else 
                                    <div class="flex-grow-1 p-1"><b>Branch:</b>&nbsp;&nbsp;N/A</div>
                                    <div class="flex-grow-1 p-1">&nbsp;&nbsp;</div>
                                    @endif
                                </div>
                            </div>
                            <div class="pt-3">
                                <table class="table table-sm table-bordered border-1 border-dark">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-light">SL</th>
                                            <th class="bg-light">Item Description</th>
                                            <th class="text-center bg-light">Price</th>
                                            <th class="text-center bg-light">Qty</th>
                                            <th class="text-center bg-light">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $totalRow = 10;
                                            $extraRow = 10 - $sale->saleItems->count();  
                                            $sl = 0;  
                                        ?>
                                        @foreach ($sale->saleItems as $sale_item)
                                        <?php
                                            $sl ++;
                                        ?>
                                        <tr>
                                            <td class="text-center">{{$sl}}</td>
                                            <td>{{$sale_item->product->name}}</td>
                                            <td class="text-center">{{number_format($sale_item->unit_price)}}</td>
                                            <td class="text-center">{{$sale_item->quantity}}</td>
                                            <td class="text-center">{{number_format($sale_item->amount)}}</td>
                                        </tr>
                                        @endforeach

                                        @for ($i = 0; $i < $extraRow; $i++)
                                        <tr>
                                            <td class="text-center">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>

                                        <tr class="border-0">
                                            <td colspan="5" class="text-center border-0">Payment History</td>
                                        </tr>
                                        <tr class="border-1">
                                            <th colspan="4" class="text-end border-1">Date</th>
                                            <td class="text-center border-1">Amount</td>
                                        </tr>
                                        @foreach ($sale->salePayment as $item)
                                        <tr class="border-1">
                                            <th colspan="4" class="text-end border-1">{{$item->date}}</th>
                                            <td class="text-center border-1">{{number_format($item->paid_amount)}}</td>
                                        </tr>
                                        @endforeach

                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Total:</th>
                                            <td class="text-center border-0">{{number_format($sale->amount)}}</td>
                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Discount:</th>
                                            <td class="text-center border-0">{{number_format($sale->discount_amount)}}</td>
                                        </tr>
                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Grand Total:</th>
                                            <td class="text-center border-0">{{number_format($sale->grand_total)}}</td>
                                        </tr>
                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Paid Amount:</th>
                                            <td class="text-center border-0">{{number_format($sale->paid_amount)}}</td>
                                        </tr>
                                        <tr class="border-0">
                                            <td colspan="2" class="border-0">&nbsp;</td>
                                            <th colspan="2" class="text-end border-0">Due Amount:</th>
                                            <td class="text-center border-0">{{number_format($sale->due_amount)}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div>
                                    <b>In Word:</b> {{convertNumber($sale->paid_amount)}} tk Only
                                </div>
                            </div>
                        </div>
                        {{-- authorized signature box --}}
                        <div class="position-absolute" style="bottom:-25px;right:65px;">
                            <p class="p-0 m-0"><b>Signature</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
