<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>It Udyokta </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">

    <style type="text/css">
        @media print {
            div.newPageDivClass {
                page-break-after: always;
            }
        }

        @page {
            margin: 0;
        }

        body {
            -webkit-print-color-adjust: exact;
        }

        .div-print {
            margin: auto;
            padding: 5px 0px 0px 0px;
        }

        td {
            word-wrap: break-word
        }

        table {
            border-collapse: collapse;
        }

        .text-left {
            text-align: left;
            padding-left: 5px;
        }

        .div-print {
            width: 54mm;
            height: 86mm;
            font-family: Calibri;
        }

        .div-print-image {}

        .card-layout-iamge {
            /* background-image: url('https://erp.bnis.edu.bd/upload/std_id_card.png'); */
            background-image: url({{ URL::asset('idcard.jpg') }});
            background-size: 54mm 86mm;
            background-repeat: no-repeat;
            height: 100%;
            width: 100%;
        }

        .card-layout-back {
            height: 100%;
            width: 100%;
        }

        .school-name {
            font-weight: bold;
            font-size: 18px;
            color: #2C2D87;
        }

        .school-address {
            font-size: 14px;
            color: #057E39;
            font-weight: bold;
        }

        .horizontal-line {
            border: 0.5px solid #ddd;
            border-style: dotted;
        }

        .idcard-heading {
            background-color: #2C2D87;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            padding: 1px;
        }

        .idcard-return {
            background-color: #0C9548;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            padding: 0px;
        }

        .main-info th,
        td {
            font-size: 11px;
            font-weight: bold;
            color: #2C2D87;
        }

        .main-info td {
            padding-left: 5px;
            padding-right: 10px;
        }

        .headmaster-signature {
            height: 26px;
        }

        .headmaster-sign-label {
            font-size: 13px;
            float: right;
        }

        .student-id {
            font-size: 10px;
        }

        .right-table td {}

        .right-table {
            float: right;
            margin-top: 55px;
        }

        .main-info-back {
            margin-top: 1px;
        }

        .main-info-back td,
        th {
            padding-left: 2px;
            font-size: 10px;
            color: #2C2D87;
        }

        .school-name-back {
            font-weight: bold;
            font-size: 12px;
            color: #2C2D87;
        }

        .school-address-back {
            font-size: 11px;
            font-weight: bold;
            color: #057E39;
        }

        .developed-by {
            font-size: 10px;
            color: #be763f;
        }

        h3 {
            display: block;
            font-size: 14px;
            margin-block-start: 38px;
            margin-block-end: -63px;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            color: #4150b9;
            font-weight: bold;
            padding-top: 3px;
        }

        .headmaster-sign {
            text-align: right;
        }
    </style>
</head>

<body>
    <div align="right">
        <button id="print_btn"
            style="height: 30px; border-radius: 5px; background-color: rgb(255 224 0); color: #5600ff; margin: 15px;"
            align="right" onclick="printPage()"><i class="fa-solid fa-print"></i> Print</button>
    </div>

    <div id="print_body" style="width:100%">
        <div id="my-div" class="my-div">
            @foreach ($students as $student)
                {{-- @dd($student->student->name) --}}
                <div class="div-print div-print-image" style="padding-top:0px;">
                    <div class="card-layout-iamge">
                        <div class="main-content">
                            <div class="student-image" style="height: 160px; position:relative;">
                                {{-- <h5 id="student_id" style="margin: 0;
                            padding: 0 3px;
                            position: absolute;
                            top: 26px;
                            left: 62px;
                            border: 1px solid #23083e;
                            border-radius: 5px;
                            color: #23083e;
                            font-size: 13px;">Roll: {{$student->roll}}</h5> --}}
                                <div id="student_image"
                                    style="position: absolute; right: 10px; margin-right:2px;  bottom: -8px;">
                                    <img src="{{ asset('admin/image/student/' . $student->student->image) }}"
                                        width="85" height="100">
                                </div>
                            </div>

                            <table class="main-info" style="width:100%; margin-top:10px;">
                                <tr>
                                    <td colspan="3" style="text-align: left; padding-left: 2px;"><span
                                            style="font-size: 16px;">{{ $student->student->name }} </span></td>
                                </tr>

                                {{-- <tr>
                                <th style="width:30%" align="left">Building</th>
                                <td style="width:5%" align="center">:</td>
                                <td style="width:50%" align="left"><?php echo $info->dormitory_name; ?></td> 
                            </tr> --}}

                                <tr>
                                    <th align="left">Class</th>
                                    <td align="center">:</td>
                                    {{-- <td align="left">{{ $student->class->class_name }}</td> --}}
                                </tr>

                                <tr>
                                    <th align="left">Section</th>
                                    <td align="center">:</td>
                                    {{-- <td align="left">{{ $student->section->section_name }}</td> --}}
                                </tr>
                                <tr>
                                    <th align="left">Roll</th>
                                    <td align="center">:</td>
                                    <td align="left"> {{ $student->student->roll_no_student }} </td>
                                </tr>


                                <tr>
                                    <th align="left">Date of Birth</th>
                                    <td align="center">:</td>
                                    <td align="left"> {{ $student->student->date_of_birth }} </td>
                                </tr>

                                <tr>
                                    <th align="left">Blood Group</th>
                                    <td align="center">:</td>
                                    {{-- <td align="left">{{ $student->student->blood_group }}</td> --}}
                                </tr>

                            </table>


                        </div>

                    </div>
                </div>
                <div class='newPageDivClass'></div>

                <!----------------------- back part -------------------------->
                <div id="" class="div-print">
                    <div class="card-layout-back">
                        <div class="main-content">
                            <table class="main-info-back" style="width:100%; margin-top:10px">
                                <tr>
                                    <th style="width:42%" align="left">Father's Name</th>
                                    <td style="width:1%" align="center">:</td>
                                    {{-- <td style="width:55%" align="left">{{ $student->student->father_name }}</td> --}}
                                </tr>

                                <tr>
                                    <th align="left">Father's Mobile No.</th>
                                    <td align="center">:</td>
                                    {{-- <td align="left">{{ $student->student->f_phone }}</td> --}}
                                </tr>

                                <tr>
                                    <th style="width:42%" align="left">Mothers's Name</th>
                                    <td style="width:1%" align="center">:</td>
                                    {{-- <td style="width:55%" align="left">{{ $student->student->mother_name }}</td> --}}
                                </tr>

                                <tr>
                                    <th align="left">Mother's Mobile No.</th>
                                    <td align="center">:</td>
                                    {{-- <td align="left">{{ $student->student->phone }}</td> --}}
                                </tr>

                                <tr>
                                    <th align="left">Expire Date</th>
                                    <td align="center">:</td>
                                    <td align="left">31-12-2022</td>
                                </tr>


                            </table>

                            {{-- <table class="main-info-back" style="width:100%;">
                                <tr>
                                    <td style="width:40%" align="center"><img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVkAAAFZAQMAAAAIPM6YAAAABlBMVEX///8AAABVwtN+AAAFaUlEQVRoge1bTc6kOgwMYsGSI+Qm9MVaAomLNTfhCCxZIPxcVQ7d8xZv76dBmp7+qSCROHZVOV8pf6/s18vMzu4o9ZzKvJ+lvOtwj+s+bMe822ZLHT6jY+6s4Mn/na/jXQbDiM6u4uALH/vdQetepnERLid4tP18mT462If5iHW3z3hVs+Pt0zSudmYHm//qK11ex2yDvyvE+Q1682H/A/BSbDsUysZFxqshlLHcqcGMZwf7Ii8eyv74Z8EO3Ty8uWv945/BnwvMjOTPu//Xyx/pKxmYl+9Q8yf3tPQZl4rZQLa9ENS+if9VWLKB/Vd/1JkPvfuG7RHIl9/AV9rD23CX2XdtVjAmwl9QG5F9NgcTZyws2xFpOC8Y9ZI7FHk31hy5yRcZIzwNnwr5vGCmpR7cZ8aIq4IGeDICP0B1YVpSOOcEgwaoVPb4zmN38xqq6uLxvA8e3jXSV0pwYShjw17lBIfjIjsXWIIKAfYsdz6w71UScLCbnXTVwxvZVgtvcd1ZwQhlHwGt4SP848y05FToEKWjCDEVloxgFMhY5PEKpurxjDQMXueAAWNbAcoHxnIX8josLbQVwrtEosU0QVqWIS24Iw0AA/hgpUNwFIS3MSOZx/jDChKCEcDMSFDH4OisJB7j3LU3fvAE9dD4jGCkV/I6MAB8xyICslMlTL7MPCO4oO5jLUkIoK0kpiC1KmeDoEbP84FZKrElCyUj5sVo2xT4G5uivW9TlxDc0ZxCWuoYzygnXfg5uMHKj1UTlxFcwFlfsDYwB5T/LSMtKqnD9sxGRjCFMdLriScv0vv0pRDKMFZZQxXPKcGHKgk5a6X8h+cRviNqKBheafGcESyDWJn1Z5uSzEJLMtBbhc0H5oIiDymUqbJuFlISApIiRHtasEex0afRmkM8sl4igCGRF1ac+iSodODO7GFzb+TdNwO4ks2xpYHf97zgF9+NwcyhspibjPKfegvU4Ou45gMfpHRQT6N0MoZdlZXklAMJBfnJCmYl4RxgX5rct3ENozEKS79/SUI2MFX+jYf+qFHK+F5kNA5YZMrIttwZwRD4+BWeviZnCsOqykRlt7SkBUNHaQTtVNFzvls0VwNt/7TgSe1CcgHq5NlEgO4mGU9y27zg5mVwh3K5nRDAA4BLTJMD757OYzowdiP+r2xFUVaBs0KJIMZNd7FmweUDT2jeo2mB2N3D7EdHEZLxZH//R0pnBGstZewDQqNxxQy9owuwPeo4I7hwNjARQd+oRFr5BCly8PrjUGUD05faDvVi6PPvNBpp25AUFRpWU1rwEceiVBthGssDCBEyyyr+soJsYByBag44u9ySGZVelYIaV/j8CcHsPd0QiqZzGUVtNvXAp3B2nqKZD1zUQqQDHgcTzjjFoDa+jqB8aXw2MF5C+Yei2vnkbF8YJfLnZ+rygV/hYETYIqhZYqg62uGM1qnJCC6kbzySQVVlOu1lPEzLQzUwOTQ2JXiil8FKcjDH0iDW6of+KNjOecH4gccW7Hi3zBp+MVSlqQmXGDxe8oHZZrNH/rOwsOI4qN/bXfKBkYdOKaryluCAjJRpbDpH+3PMLx940skun4iNUh+OHLbuk6/QGJ7b1CUEdzrrTCsRpzHi/LOJmXc8XuNfDHdWcIkpoVdqcVxWdgdvxZNEMKyygl9iN73Fn1ZgfcMQp2nM43vrj1eQDYynDIOYBxJLHFnHvFB5Fd7qy+vSgWHb/HYu4s8PmoxcNGHN30gK7qD8oykVGYlsTnIEjYyI+6xgPnQczDd5jGh1yxKgEhnutGDEM1UHiibnBa54jWoKQrDFsJxgZqTwhk02FVdanuqkE+w8jJIU/PfKff0D40vn4Yqb/eIAAAAASUVORK5CYII="
                                            style="width:60px;"></td>
                                    <td style="width:59%" align="center">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMYAAAAoAQMAAACfGxfsAAAABlBMVEUAAAD///+l2Z/dAAAALUlEQVQ4jWP4f7paUiqn9/Imcz/Nm9LCSTkpF2dcPVTo/odhVGZUZlRmhMkAAHjc9riKioiBAAAAAElFTkSuQmCC"
                                            style="height:40px;width:90%;padding-right: 10px">
                                        <span style="color:black">{{ $student->student->id }}</span>
                                    </td>

                                </tr>
                            </table> --}}
                            <div class="idcard-return">
                                If Found Please Return To
                            </div>
                            <table style="width:100%;">
                                <tr>
                                    <td style="width:95%" align="center">
                                        <span class="school-name-back">{{ $org_info->system_title }}</span><br>
                                        <span class="school-address-back">{{ $org_info->address }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="developed-by" align="center">Developed by STITBD.COM</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class='newPageDivClass'></div>
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/fontawesome.min.js"
        integrity="sha512-j3gF1rYV2kvAKJ0Jo5CdgLgSYS7QYmBVVUjduXdoeBkc4NFV4aSRTi+Rodkiy9ht7ZYEwF+s09S43Z1Y+ujUkA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function printPage() {
            var printContents = document.getElementById('print_body').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
        }
    </script>
</body>

</html>
