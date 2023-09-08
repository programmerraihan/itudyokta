<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Student</title>
    @include('admin.body.style')
    <style>
        @media print {
            div.newPageDivClass {
                page-break-after: always;
            }
        }

        @page {
            margin: 0;
        }

        .main-div {
            width: 11in;
            height: 8in;
            float: left;
            float: none;
            font-size: 14px;
            margin: auto
        }

        .contents {
            margin-left: 0.5in;
            font-size: 14px;
        }

        .inner-div {
            width: 33%;
            float: left;
            font-size: 14px;
        }

        .border-seperate {
            border-left: 2px dotted black;
        }

        .main-content {
            padding: 25px 25px 0px 25px;
        }

        .main-content1 {
            padding: 0px 22px 0px 22px;
        }

        .logo {
            width: 18%;
            float: left;
        }

        .heading {
            width: 80%;
            float: right;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            word-wrap: break-word;
        }

        .payment-info {
            line-height: 26px;
            margin-top: 110px;
        }

        .student-info table {
            width: 100%;
            padding: 0px;
        }

        .std-info-td {
            font-size: 14px;
            line-height: 20px;
            width: 60px;
        }

        .std-info-td1 {
            font-size: 14px;
            line-height: 20px;
            width: 70px;
        }

        .tg {
            font-size: 14px;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            outline: 1px solid black;
        }

        .tg td {
            border-style: solid;
            border-width: 1px;
            padding: 3px;
        }

        .tg-yw4l {
            text-align: center;
        }

        .tg-yw42 {
            text-align: left;
            padding-left: 4px;
        }

        .tg-yw43 {
            text-align: right;
            padding-left: 4px;
        }

        .tg .border-left {
            border-width: 1px 2px 1px 1px;
        }

        .tg .border-bottom {
            border-width: 1px 1px 2px 1px;
        }

        .tg .border-left-bottom {
            border-width: 1px 2px 2px 1px;
        }

        .right_signature {
            padding: 10px;
            text-align: center;
        }

        p.signature-line {
            border-style: solid;
            border-width: 1px 0px 0px 0px;
        }

        .barcode-div {
            text-align: center;
        }

        .cover-parent {
            height: 8in;
            width: 11in;
            position: relative;
        }

        .cover-child {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .std-info-table {
            font-size: 17px;
            width: 600px;
            line-height: 20px;
            /* padding: 20px; */
            /* outline: 2px solid black; */
        }

        .cover-td {
            width: 100px;
        }

        .cover-footer {
            height: 100px;
        }

        .bottom-footer {
            vertical-align: bottom;
            margin-top: 20px
        }

        .session-fee {
            font-size: 11px;
            padding-bottom: 2px;
        }

        * {
            font-family: "Times New Roman", Times, serif;
            color: #000;
        }

        .scode {
            font-size: 17.5px;
            font-weight: 700;
            font-family: sans-serif;
            letter-spacing: -0.5px;
        }
    </style>


</head>

<body>


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

            {{-- @dd($student) --}}

            <div class="d-print-none">
                <div class="float-right">
                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i
                            class="fa fa-print"></i></a>
                    {{-- <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a> --}}
                </div>
            </div>

            <div id="div-print" class="main-div">
                <div class="main-div">

                    <div class='inner-div '>

                        <div style="text-align: center;">
                            <img src="{{ asset('admin/center/profile/' . $branch->profile) }}" alt="logo"
                                style="width: 50px;">
                            <h4>{{ $branch->institute_name }}</h4>
                        </div>
                        <table style="margin-left: 20px;">
                            <tr>
                                <td>Memo No </td>
                                <td>: {{ $memo }}</td>
                            </tr>
                            <tr>
                                <td>Date </td>
                                <td>: {{ $date }}</td>
                            </tr>
                            <tr>
                                <td>Name </td>
                                <td>: {{ $student->name }}</td>
                            </tr>
                            <tr>
                                <td>Roll </td>
                                <td>: {{ $student->roll_no_student }}</td>
                            </tr>
                            <tr>
                                <td>Branch </td>
                                <td>: {{ $branch->institute_name }}</td>
                            </tr>
                            <tr>
                                <td>Course </td>
                                <td>:
                                    {{ \App\Models\CourseTitle::find($student->course_title_id)->title }}
                                </td>
                            </tr>
                        </table>
                        <div class="main-content1">

                            <br>
                            <div>

                                <table class="tg">
                                    <tr>
                                        <td class="tg-yw4l border-left-bottom"><b>Fees Head</b></td>
                                        <td class="tg-yw4l border-left-bottom"><b>Taka (paid)</b></td>
                                    </tr>



                                    <tr>

                                        <td class="tg-yw42 border-left">
                                            {{ \App\Models\AccountHead::find($feeCollect->ac_head_id)->name }}</td>
                                        <td class="tg-yw43">{{ $feeCollect->paid }}</td>
                                    </tr>



                                    <tr>
                                        <td class="tg-yw42">Total Paid </td>
                                        <td class="tg-yw43"><b>Tk. {{ $feeCollect->paid }}</b></td>
                                    </tr>
                                </table>

                            </div>
                            <br><br><br>
                            <table>
                                <tr>
                                    <td>
                                        <div class="right_signature">
                                            <p class="signature-line">Receiver's Signature</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="right_signature">
                                            <p class="signature-line">Receiver's Signature</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <br>

                            <div class="barcode-div">
                                <h3>Student's Copy</h3> Developed by <b>STITBD</b>
                            </div>
                        </div>
                    </div>

                    <div class='inner-div border-seperate'>

                        <div style="text-align: center;">
                            <img src="{{ asset('admin/center/profile/' . $branch->profile) }}" alt="logo"
                                style="width: 50px;">
                            <h4>{{ $branch->institute_name }}</h4>
                        </div>
                        <table style="margin-left: 20px;">
                            <tr>
                                <td>Memo No </td>
                                <td>: {{ $memo }}</td>
                            </tr>
                            <tr>
                                <td>Date </td>
                                <td>: {{ $date }}</td>
                            </tr>
                            <tr>
                                <td>Name </td>
                                <td>: {{ $student->name }}</td>
                            </tr>
                            <tr>
                                <td>Roll </td>
                                <td>: {{ $student->roll_no_student }}</td>
                            </tr>
                            <tr>
                                <td>Branch </td>
                                <td>: {{ $branch->institute_name }}</td>
                            </tr>
                            <tr>
                                <td>Course </td>
                                <td>:
                                    {{ \App\Models\CourseTitle::find($student->course_title_id)->title }}
                                </td>
                            </tr>
                        </table>
                        <div class="main-content1">



                            <br>
                            <div>

                                <table class="tg">
                                    <tr>
                                        <td class="tg-yw4l border-left-bottom"><b>Fees Head</b></td>
                                        <td class="tg-yw4l border-left-bottom"><b>Taka (paid)</b></td>
                                    </tr>



                                    <tr>

                                        <td class="tg-yw42 border-left">
                                            {{ \App\Models\AccountHead::find($feeCollect->ac_head_id)->name }}</td>
                                        <td class="tg-yw43">{{ $feeCollect->paid }}</td>
                                    </tr>



                                    <tr>
                                        <td class="tg-yw42">Total Paid </td>
                                        <td class="tg-yw43"><b>Tk. {{ $feeCollect->paid }}</b></td>
                                    </tr>
                                </table>
                            </div>
                            <br><br><br>
                            <table>
                                <tr>
                                    <td>
                                        <div class="right_signature">
                                            <p class="signature-line">Receiver's Signature</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="right_signature">
                                            <p class="signature-line">Receiver's Signature</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <br>

                            <div class="barcode-div">
                                <h3>Teacher's Copy</h3> Developed by <b>STITBD</b>
                            </div>
                        </div>
                    </div>


                    <div class='inner-div border-seperate'>

                        <div style="text-align: center;">
                            <img src="{{ asset('admin/center/profile/' . $branch->profile) }}" alt="logo"
                                style="width: 50px;">
                            <h4>{{ $branch->institute_name }}</h4>
                        </div>
                        <table style="margin-left: 20px;">
                            <tr>
                                <td>Memo No </td>
                                <td>: {{ $memo }}</td>
                            </tr>
                            <tr>
                                <td>Date </td>
                                <td>: {{ $date }}</td>
                            </tr>
                            <tr>
                                <td>Name </td>
                                <td>: {{ $student->name }}</td>
                            </tr>
                            <tr>
                                <td>Roll </td>
                                <td>: {{ $student->roll_no_student }}</td>
                            </tr>
                            <tr>
                                <td>Branch </td>
                                <td>: {{ $branch->institute_name }}</td>
                            </tr>
                            <tr>
                                <td>Course </td>
                                <td>:
                                    {{ \App\Models\CourseTitle::find($student->course_title_id)->title }}
                                </td>
                            </tr>
                        </table>
                        <div class="main-content1">


                            <br>
                            <div>

                                <table class="tg">
                                    <tr>
                                        <td class="tg-yw4l border-left-bottom"><b>Fees Head</b></td>
                                        <td class="tg-yw4l border-left-bottom"><b>Taka (paid)</b></td>
                                    </tr>



                                    <tr>

                                        <td class="tg-yw42 border-left">
                                            {{ \App\Models\AccountHead::find($feeCollect->ac_head_id)->name }}</td>
                                        <td class="tg-yw43">{{ $feeCollect->paid }}</td>
                                    </tr>



                                    <tr>
                                        <td class="tg-yw42">Total Paid </td>
                                        <td class="tg-yw43"><b>Tk. {{ $feeCollect->paid }}</b></td>
                                    </tr>
                                </table>

                            </div>
                            <br><br><br>
                            <table>
                                <tr>
                                    <td>
                                        <div class="right_signature">
                                            <p class="signature-line">Receiver's Signature</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="right_signature">
                                            <p class="signature-line">Receiver's Signature</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <br>

                            <div class="barcode-div">
                                <h3>Office's Copy</h3> Developed by <b>STITBD</b>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    </div>

    @include('admin.body.script')
</body>

</html>
