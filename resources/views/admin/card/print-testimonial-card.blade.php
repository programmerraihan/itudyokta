<html>

<head>
    <link href="{{ asset('/') }}backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
       rel="stylesheet" type="text/css" />
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
            height: 563px;
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
    </style>

</head>

<body>

    <div align="right">
        <button id="print_btn" style="height: 40px; border-radius: 10px; background-color: tan; color: #000; margin-bottom: 10px; position: fixed;left: 0; top: 25%;"
            align="right" onclick="printPage()">Print Testimonial</button>
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
            
            {{-- @php
                $result = \App\Models\StudentResult::orderBy('id', 'DESC')
                    ->where('student_id', $student->student->id)
                    ->first();
            @endphp --}}

            
            <div class="row">
                <div class="col-md-12">
                    <div class="testimonial_wrapper">
                        <div class="logo">
                            <br>
                            IT Udyokta Foundation
                        </div>
                        <div class="pra">
                            57, Gasroad, Donia, Kodomtoli, Dhaka-1236
                        </div>
                        <img src="{{ asset('backend/assets/images/favicon.png') }}"width="85" height="85" />
                        <div class="marquee">
                            Testimonial
                        </div>
                        <div>
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%;padding: 5px;">
                                        <p class="left">Reg No: BD1234</p>
                                    </td>
                                    <td style="width: 50%;padding: 5px;">
                                        <p class="right">Date: 01/03/2023 </p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="p">
                            This is to certify that Name:{{ $result->enrollment->student->name }} Son/daughter of
                            {{ $result->enrollment->student->father_name }} and
                            {{ $result->enrollment->student->mother_name }} Branch Name: {{ $org_info->institute_name }}
                            passed the Computer Course Examination from this Institute under the Bangladesh Technical Education
                            Board,
                            Dhaka Bangladesh bearing Roll No: {{ $result->enrollment->student->roll_no_student }} and Registration
                            No: {{ $result->enrollment->student->reg_no_student }} and obtained Grade
                            Point Average {{ $result->grade }} And Course Name:
                            {{ \App\Models\CourseTitle::find($result->enrollment->course_title_id)->title }} His date of birth is
                            {{ $result->enrollment->student->date_of_birth }} .

                            <br>
                            <br>
                            To the best of my knowledge he did not take part in any activities subversive of the state or
                            discipline.
                            His conduct and character are good.

                            <p>I wish him every success in life.</p>
                            <br>
                            <br>
                        </div>

                        <div>
                            <table style="width: 100%; padding: 15px;">
                                <tr>
                                    <td style="width: 50%;">
                                        <p class="left">Composed by. IT Udyokta <br>
                                            Date: <?php echo date('Y/m/d'); ?></p>
                                    </td>
                                    <td style="width: 50%; padding: 15px;">
                                        {{-- <img src="{{ asset('admin/image/director/' . $student->student->director) }}"
                                            width="120" height="45" /> --}}

                                        <p class="right"> Board Of Director <br>
                                            Date: <?php echo date('Y/m/d'); ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            
        @endforeach
    </div>
    
    <script src="{{ asset('/') }}backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>


</html>
