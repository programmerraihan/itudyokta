<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $studentResult->student->name }} certificate pdf</title>
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        body {
            font-family: Georgia, serif;
            font-size: 16px;
        }

        .sl-no {
            position: absolute;
            top: 213px;
            left: 400px;
        }

        .certificate {
            width: 29.7cm;
            height: 20.7cm;
            display: block;
            position: relative;
        }

        .certificate>img {
            width: 100%;
            height: 100%;
        }

        .student-name {
            position: absolute;
            top: 320px;
            left: 620px;
            z-index: 100;
        }

        .roll-no {
            top: 215px;
            left: 900px;
            position: absolute;
        }

        .reg-no {
            top: 250px;
            left: 900px;
            position: absolute;
        }

        .date {
            top: 285px;
            left: 900px;
            position: absolute;
        }

        .father-name {
            top: 355px;
            left: 516px;
            position: absolute;
        }

        .mother-name {
            top: 395px;
            left: 516px;
            position: absolute;
        }

        .course-name {
            top: 430px;
            left: 690px;
            position: absolute;
        }

        .branch-name {
            top: 475px;
            left: 520px;
            position: absolute;
        }

        .student-grade {
            top: 512px;
            right: 144px;
            position: absolute;
        }

        .code {
            top: 475px;
            left: 895px;
            position: absolute;
        }

        .held_from {
            top: 510px;
            right: 580px;
            position: absolute;
        }

        .to_from {
            top: 510px;
            right: 420px;
            position: absolute;
        }

        .subject-list {
            left: 99px;
            top: 445px;
            position: absolute;
        }

        .subject-list>p {
            margin: 2px;
            padding: 0;
        }

        @media print {
            @page {
                margin: 0;
                size: a4 landscape;
            }

            .print-button {
                display: none;
            }

        }
    </style>
</head>

<body>
    <div class="print-button" style="margin-bottom: 10px;">
        <button type="button" id="print_btn"
            style="padding:10px 15px;border-radius:5px;border:none;background:rgb(33, 183, 33);color:white;">Print</button>
    </div>

    <div class="certificate">
        <img src="{{ asset('certificate.jpg') }}" alt="">
        {{-- sl no --}}
        <span class="sl-no">{{ $studentResult->id + 1000 }}</span>
        {{-- student name --}}
        <span class="student-name">{{ $studentResult->student->name }}</span>
        {{-- student roll --}}
        <span class="roll-no">{{ $studentResult->student->roll_no_student }}</span>
        {{-- registration name --}}
        <span class="reg-no">{{ $studentResult->student->reg_no_student }}</span>
        {{-- date --}}
        <span class="date" contenteditable="true">{{ date('d/m/y', strtotime($studentResult->issue_date)) }}</span>
        {{-- fathers name --}}
        <span class="father-name">{{ $studentResult->student->father_name }}</span>
        {{-- mothers name --}}
        <span class="mother-name">{{ $studentResult->student->mother_name }}</span>
        {{-- course name --}}
        <span class="course-name">{{ $studentResult->student->CourseTitle->title }}</span>
        {{-- branch name --}}
        <span class="branch-name">{{ $studentResult->student->Branch->name }}</span>
        {{-- student grade --}}
        <span class="student-grade">{{ $studentResult->grade }}</span>
        {{-- student code --}}
        <div class="code">{{ $studentResult->student->Branch->code }} </div>
        {{-- held from --}}
        <div class="held_from" contenteditable="true">
            {{ date('d/m/y', strtotime($studentResult->held_from)) }}
        </div>
        {{-- to from --}}
        <div class="to_from" contenteditable="true">
            {{ date("d/m/y", strtotime($studentResult->held_to)) }}
        </div>

        {{-- subject list --}}
        <div class="subject-list" >
            {!! \App\Models\CourseTitle::find($studentResult->enrollment->course_title_id)->subject_list !!}

        </div>
    </div>
</body>
<script>
        document.addEventListener('contextmenu', (e) => e.preventDefault());

    function ctrlShiftKey(e, keyCode) {
      return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
    }

    document.onkeydown = (e) => {
      // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
      if (
        event.keyCode === 123 ||
        ctrlShiftKey(e, 'I') ||
        ctrlShiftKey(e, 'J') ||
        ctrlShiftKey(e, 'C') ||
        (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
      ) {
        alert("Not Allowed!");
       return false;
      }

    };

    let btn = document.querySelector('#print_btn');
    btn.onclick = function() {
        window.print();
    }
</script>

</html>
