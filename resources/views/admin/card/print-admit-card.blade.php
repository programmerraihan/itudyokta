<style>
    .td1 {
        text-align: left;
        width: 50px;
        padding-left: 10px;
    }

    .td2 {
        text-align: left;
        width: 245px;
    }
</style>

<div align="right">
    <button id="print_btn" style="height:40px; border-radius:10px; background-color:blue; color:fff; margin-bottom:10px;"
        align="right" onclick="printPage()">Print Admit Card</button>
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

    @foreach ($students as $student)
        <div style="width: 595px; margin: 15px auto; border: 4px solid #12A5F3;">

            <table style="width:100%; text-align:center">
                <tr>
                    <th colspan="1">
                        {{-- <img src={{ url('logo/', $org_info->logo) }} width="85" height="85" /> --}}
                        {{-- {{-- <img ({{ URL::asset('backend/assets/images/favicon.png') }}); width="85" height="85" /> --}}
                        <img src="{{ asset('backend/assets/images/favicon.png') }}"width="85" height="85" />


                    </th>
                    <th colspan="2" align="center">
                        <p style="font-size:24px;"><b>
                                {{ $org_info->system_title }}
                            </b></p>
                        <h2 style="background:#12A5F3;  font-size:28px; width:160px; margin-top:0px; padding-top:0px"
                            align="center">Admit Card</h2>
                    </th>
                    <th>
                        <img src="{{ asset('admin/image/student/' . $student->student->image) }}" width=60px
                            height=60px />
                    </th>
                </tr>
            </table>
            <table style="width:100%; text-align:center">
                <tr>
                    <td class="td1">Name</td>
                    <td class="td2">: {{ $student->student->name }}</td>
                    <td class="td1">Phone</td>
                    <td class="td2">: {{ $student->student->mobile }}</td>
                </tr>
                <tr>
                    <td class="td1">Roll</td>
                    <td class="td2">: {{ $student->student->roll_no_student }}</td>
                    <td class="td1">Branch</td>
                    <td class="td2">: {{ \App\Models\Branch::find($student->branch_id)->name }}</td>
                </tr>
                {{-- <tr>
                    <td class="td1">Exam</td>
                    <td class="td2">: {{ $exam->exam_name }} </td>
                    <td class="td1">Gender</td>
                    <td class="td2">: {{ $student->student->gender }}</td>
                </tr> --}}
                <tr>
                    <td class="td1">Course </td>
                    <td class="td2">: {{ \App\Models\CourseTitle::find($student->student->course_title_id)->title }}
                    </td>
                    <td class="td1">Batch</td>
                    <td class="td2">: {{ \App\Models\Batch::find($student->batch_id)->name }} </td>
                </tr>
            </table>
            <table style="width:100%; text-align:center">
                <tr>
                    <td style="width:50%;"></td>
                    <td align="center" style="width:50%;">
                        {{-- <img src={{ url('signature/', $org_info->signature) }} width="120" height="45" /> --}}

                        <img src="{{ asset('admin/image/director/' . $student->student->director) }}" width="120"
                            height="45" />
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <p style="width: 70%; border-top: #000 dashed;">Class Teacher </p>
                    </td>

                    <td align="center">
                        <p style="width: 70%; border-top: #000 dashed;">Principal </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="background:#12A5F3">&nbsp;</td>
                </tr>
            </table>
        </div>
    @endforeach
</div>
