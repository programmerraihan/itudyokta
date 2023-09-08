<html>

<head>
    <style type='text/css'>
        body,
        html {
            margin: 0 auto;
            padding: 0;
        }

        body {
            color: black;
            display: table;
            font-family: Georgia, serif;
            font-size: 24px;
            text-align: center;
        }

        .testimonial_wrapper {
            border: 20px solid tan;
            width: 750px;
            height: 1050px;
            /* display: block;
            vertical-align: middle; */
            /* position: absolute; */
            /* left: 0;
            right: 0; */
            /* top: 0;
            bottom: 0; */
            margin: 15px auto;
            padding: 15px;
            background-image: url("{{ asset('image/bg.jpg') }} ");
            background-size: cover;
            background-repeat: no-repeat;

        }

        .logo {
            color: tan;
        }

        .marquee {
            color: tan;
            font-size: 36px;
            margin: 1px;
        }

        .assignment {
            margin: 20px;
        }

        .person {
            border-bottom: 2px solid black;
            font-size: 32px;
            font-style: italic;
            margin: 20px auto;
            /* width: 400px; */
        }

        .reason {
            margin: 20px;
        }

        .pra {
            margin: 10px;
            font-size: 12px;
        }

        .left {
            margin: 1px;
            font-size: 12px;
            text-align: left;
        }

        .right {
            margin: 1px;
            font-size: 12px;
            text-align: right;
        }

        .p {
            margin: 1px;
            font-size: 16px;
            text-align: left;
        }

        .table_text {

            font-size: 10px;
            color: #060606;
            background: #d2b48c;

        }

        span {
            border-bottom: 2px solid tan;
        }

        .table td,
        .table th {
            padding: 0;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            text-align: center;
        }

        @page {
            size: auto;
        }

        table {
            width: 100%;
        }
    </style>

</head>

<body>

    <div align="right">
        <button id="print_btn"
            style="height: 40px; border-radius: 10px; background-color: tan; color: #000; margin-bottom: 10px; position: fixed;left: 0; top: 25%;"
            align="right" onclick="printPage()">Print Mark Sheet</button>
    </div>
    <br>
    <br>
    <script>
        function printPage() {
            var printContents = document.getElementById('print_body').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
        }
    </script>

    <div id="print_body">
        @foreach ($results as $result)
            @php
                // $result = \App\Models\StudentResult::orderBy('id', 'DESC')
                //     ->where('student_id', $student->student->id)
                //     ->first();
            @endphp


            <div class="row">
                <div class="col-md-12">
                    <div class="testimonial_wrapper">

                        <div>
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%;padding: 5px;">
                                        {{-- <p class="left">Reg No: BD1234</p> --}}
                                    </td>
                                    <td style="width: 50%;padding: 5px;">
                                        <p class="right">Reg No: BD1234 </p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="logo">
                            <br>
                            IT Udyokta Foundation
                        </div>
                        <div class="pra">
                            57, Gasroad, Donia, Kodomtoli, Dhaka-1236
                        </div>
                        <img src="{{ asset('backend/assets/images/favicon.png') }}"width="85" height="85" />

                        <div class="marquee">

                            <span> STATEMENT OF MARKS</span>
                            <br>

                        </div>
                        <br>



                        <div>

                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 40%;padding: 5px;">
                                        <p class="left">Tish Marksheet is Awarded to</p>
                                    </td>
                                    <td style="width: 60%;padding: 5px;">
                                        <p class="left"> : {{ $result->enrollment->student->name }} </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;padding: 5px;">
                                        <p class="left">On Successfull Completion of Course</p>
                                    </td>
                                    <td style="width: 60%;padding: 5px;">
                                        <p class="left"> :
                                            {{ \App\Models\CourseTitle::find($result->enrollment->course_title_id)->title }}
                                            origins
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 40%;padding: 5px;">
                                        <p class="left">On Duration</p>
                                    </td>
                                    <td style="width: 60%;padding: 5px;">
                                        <p class="left"> : 6 Month </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 40%;padding: 5px;">
                                        <p class="left">From Our Authorize Traning Center</p>
                                    </td>
                                    <td style="width: 60%;padding: 5px;">
                                        <p class="left"> :{{ $org_info->institute_name }} </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 40%;padding: 5px;">
                                        <p class="left">Institute Code</p>
                                    </td>
                                    <td style="width: 60%;padding: 5px;">
                                        <p class="left"> : RB-107-1394428407 </p>
                                    </td>
                                </tr>
                            </table>

                        </div>

                        <br>

                        <div>
                            <table class="table" border="1">
                                <thead class="table_text">
                                    <tr>
                                        <th style="padding: 10px;">SL. NO</th>



                                        <th style="padding: 10px;">ASSESMENT MARK</th>
                                        <th style="padding: 10px;">MCQ QUESTION MARK</th>
                                        <th style="padding: 10px;">VIVA MARK</th>

                                        <th style="padding: 10px;">FULL MARK </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="font-size: 12px;">
                                        <th>1</th>

                                        <td>{{ $result->assessment_result }}</td>
                                        <td>{{ $result->mcq_result }}</td>
                                        <td>{{ $result->viva_result }}</td>
                                        <td>{{ $result->total_mark }}</td>

                                    </tr>
                                </tbody>
                                <tfoot>

                                    <tr>
                                        <th colspan="4" style="padding: 1px; font-size: 12px;  text-align: right;">
                                            Grade :
                                        </th>
                                        <th colspan="1" style="padding: 1px; font-size: 12px;">
                                            {{ $result->grade }}</th>


                                    </tr>


                                </tfoot>
                            </table>


                        </div>

                        <br>

                        <table style="width: 100%;">

                            <tr>
                                <td>
                                    <img src="{{ asset('image/getCode.png') }}"width="180" height="180" />
                                    <br>

                                    <p style="font-size: 12px; margin-bottom: 0rem;">Place Of Issue: Dhaka</p>
                                    <p style="font-size: 12px; margin-bottom: 0rem;">Date Of Issue: <?php echo date('Y/m/d'); ?>
                                    </p>
                                </td>

                                <td></td>
                                <td>
                                    <table class="table" border="1">
                                        <thead class="table_text">
                                            <tr>
                                                <th>Grade Scale</th>
                                                <th>Grade</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="font-size: 12px;">
                                                <td>80 – 100</td>
                                                <td>A+</td>
                                            </tr>
                                            <tr style="font-size: 12px;">
                                                <td>70 – 79</td>
                                                <td>A</td>
                                            </tr>
                                            <tr style="font-size: 12px;">
                                                <td>60 – 69</td>
                                                <td>A-</td>
                                            </tr>
                                            <tr style="font-size: 12px;">
                                                <td>50 – 59</td>
                                                <td> B</td>
                                            </tr>
                                            <tr style="font-size: 12px;">
                                                <td>40 – 49</td>
                                                <td>C</td>
                                            </tr>

                                            <tr style="font-size: 12px;">
                                                <td>33 – 39</td>
                                                <td>D</td>
                                            </tr>
                                            <tr style="font-size: 12px;">
                                                <td>0 – 32</td>
                                                <td>F</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </table>

                        <div>
                            <table style="width: 100%; padding: 15px;">
                                <tr>

                                    <td style="width: 50%; padding: 15px;">
                                        <p class="right"> Board Of Director <br>
                                            Date: <?php echo date('Y/m/d'); ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <br>


                        <div style="    font-size: 12px; text-align: left;">
                            1. Result must be show on this website:http://itudyokta.com/ <br>
                            2. Always use our site link in address bar. <br>
                            3. Go to "Enrollment Verification" Option and submit proper information. <br>
                            <br>
                            <b>Note:</b> Verification by telephon No./Fax.no/Email ID will not be entertation.
                            <br>
                            for any type of enquiry/Verification Center or Write at its Administrative office only:

                        </div>
                    </div>
                </div>
            </div>
            <div style="page-break-after: always;"></div>
        @endforeach
    </div>


</body>


</html>
