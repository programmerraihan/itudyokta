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
            /* border: 20px solid tan; */
            width: 1050px;
            height: 690px;
            /* display: block;
            vertical-align: middle; */
            /* position: absolute; */
            /* left: 0;
            right: 0; */
            /* top: 0;
            bottom: 0; */
            margin: 15px auto;
            padding: 15px;
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;

        }

        .bg_img {
            position: absolute;
            height: 100%;
            width: 100%;
        }

        .bg_img img {
            height: 100%;
            width: 100%;
        }

        .roll {
            position: absolute;
            left: 923px;
            top: 203px;
            font-family: cursive;
            font-size: 16px;
        }

        .reg {
            position: absolute;
            left: 923px;
            top: 241px;
            font-family: cursive;
            font-size: 16px;
        }

        .issue_date {
            position: absolute;
            left: 923px;
            top: 277px;
            font-family: cursive;
            font-size: 16px;
        }


        .student_name {
            position: absolute;
            left: 613px;
            top: 329px;
            font-family: cursive;
            font-size: 16px;
        }

        .father_name {
            position: absolute;
            left: 496px;
            top: 365px;
            font-family: cursive;
            font-size: 16px;
        }

        .mother_name {
            position: absolute;
            left: 499px;
            top: 405px;
            font-family: cursive;
            font-size: 16px;
        }

        .course_name {
            position: absolute;
            left: 687px;
            top: 445px;
            font-family: cursive;
            font-size: 16px;
        }

        .institute_name {
            position: absolute;
            left: 501px;
            top: 491px;
            font-family: cursive;
            font-size: 16px;
        }

        .code {
            position: absolute;
            left: 926px;
            top: 490px;
            font-family: cursive;
            font-size: 16px;
        }

        .held_from {
            position: absolute;
            left: 436px;
            top: 527px;
            font-family: cursive;
            font-size: 16px;
        }

        .to_from {
            position: absolute;
            left: 609px;
            top: 527px;
            font-family: cursive;
            font-size: 16px;
        }

        .subject {
            width: 240px;
            position: absolute;
            left: 20px;
            top: 435px;
            font-family: cursive;
            font-size: 8px !important;
            text-align: left;
        }

        .grade {
            position: absolute;
            left: 978px;
            top: 527px;
            font-family: cursive;
            font-size: 16px;
        }








        /* .logo {
            color: tan;
        }

        .marquee {
            color: tan;
            font-size: 36px;
            margin: 1px;
        }

        .assignment {
            margin: 20px;
        } */

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
        <button id="print_btn"
            style="height: 40px; border-radius: 10px; background-color: tan; color: #000; margin-bottom: 10px; position: fixed;left: 0; top: 25%;"
            align="right" onclick="printPage()">Print Certificate</button>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="testimonial_wrapper">

                        <div class="bg_img">
                            <img src="{{ asset('image/certificate.jpg') }}" alt="">
                        </div>
                        <div class="roll">
                            {{ $result->enrollment->student->roll_no_student }}
                        </div>

                        <div class="reg">
                            12345
                        </div>

                        <div class="issue_date">
                            {{ date('d/m/Y') }}
                        </div>

                        <div class="student_name">
                            {{ $result->enrollment->student->name }}
                        </div>

                        <div class="father_name">
                            {{ $result->enrollment->student->father_name }}
                        </div>

                        <div class="mother_name">
                            {{ $result->enrollment->student->mother_name }}
                        </div>

                        <div class="course_name">
                            {{ \App\Models\CourseTitle::find($result->enrollment->course_title_id)->title }}
                        </div>

                        <div class="institute_name">
                            {{ \App\Models\Branch::find($result->enrollment->branch_id)->name }}
                        </div>

                        <div class="code">
                            12313
                        </div>


                        <div class="held_from">
                            {{ $result->enrollment->course_start_date }}
                        </div>


                        <div class="to_from">
                            @php
                                $tarikh = $result->enrollment->course_start_date;
                               $day =   \App\Models\CourseTitle::find($result->enrollment->course_title_id)->day;
                               $end = \Carbon\Carbon::parse($tarikh)->addDays($day);

                            //    $dt->setDate(2015, 4, 21)->setTime(22, 32, 5)->toDateTimeString();

                            //    $dt = toDateString($end);
                               
                            @endphp
                            {{ $end->todatestring() }}
                        </div>

                        <div class="subject">
                            {!! \App\Models\CourseTitle::find($result->enrollment->course_title_id)->subject_list !!}

                        </div>

                        <div class="grade">
                        {{$result->grade}}
                        </div>



                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- <script src="{{ asset('/') }}backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
