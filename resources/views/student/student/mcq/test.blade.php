@extends('student.student_master')

@section('css')
    <style type="text/css">
        fieldset {
            min-width: 0px;
            padding: 15px;
            margin: 7px;
            border: 2px solid #a66df5;
        }

        legend {
            float: none;
            background-image: linear-gradient(to bottom right, #062689, #5b076f);
            padding: 4px;
            width: 50%;
            color: rgb(255, 255, 255);
            border-radius: 7px;
            font-size: 17px;
            font-weight: 700;
            text-align: center;
        }
    </style>
@endsection
@section('admin')
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
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        {{-- <h4 class="mb-0 font-size-18">Add Home Word</h4> --}}

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Online MCQ EXAM </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                        <legend> MCQ Start Infomation </legend>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body ">
                                    <form action="{{ route('mcq.answer.submit') }}" method="POST" class="form-horizontal"
                                        id="answer" name="answer" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="assessment_exam_id" value="{{$exam->id}}" />
                                        <div class="row" style="padding: 25px 50px;">
                                            <div class="col-md-12" style="text-align: center;">
                                                <h4 style="text-align: center; margin:0;">
                                                    {!! $question_master->name !!}<br>
                                                </h4>
                                                Total Marks: {!! $question_master->total_marks !!}
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                Duretion: {!! $question_master->hour !!} : {!! $question_master->minute !!}
                                                <input type="hidden" id="hours" value="{!! $question_master->hour !!}">
                                                <input type="hidden" id="minutes" value="{!! $question_master->minute !!}">
                                                <input type="hidden" name="name" value="{{ $name }}">
                                                <input type="hidden" name="email" value="{{ $email }}">
                                                <input type="hidden" name="phone" value="{{ $phone }}">
                                                <input type="hidden" name="address" value="{{ $address }}">
                                                <input type="hidden" name="roll" value="{{ $roll }}">
                                                <input type="hidden" name="student_id" value="{{ $student_id }}">
                                            </div>

                                            <div class="passege col-md-12">
                                                {!! $question_master->passege !!}
                                            </div>

                                            <div class="col-md-12">
                                                @php $i=0; @endphp
                                                @foreach ($questions as $question)
                                                    @php $i++; @endphp

                                                    <div class="row">
                                                        <div class="col-sm-11">
                                                            <table>
                                                                <tr>
                                                                    <td><b>{{ $i }}.</b></td>
                                                                    <td>{!! $question->question !!}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <span>{{ $question->marks }}</span>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $j = 0;
                                                        $options = App\Models\AssessmentQuestionDetail::where('assessment_question_id', $question->id)->get();
                                                    @endphp

                                                    <table>
                                                        @foreach ($options as $option)
                                                            <tr>
                                                                <td><input type="radio"
                                                                        name="answer[{{ $question->id }}]"
                                                                        value="{{ ++$j }}"></td>
                                                                <td>{!! $option->option !!}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                @endforeach
                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-success" value="Submit"
                                                    style="float: right; margin-top: 15px;">
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Code for timer
            var timerVar = setInterval(countTimer, 1000);
            var totalSeconds = 0;

            function countTimer() {
                ++totalSeconds;
                var hour = Math.floor(totalSeconds / 3600);
                var minute = Math.floor((totalSeconds - hour * 3600) / 60);
                var seconds = totalSeconds - (hour * 3600 + minute * 60);
                if (hour < 10)
                    hour = "0" + hour;
                if (minute < 10)
                    minute = "0" + minute;
                if (seconds < 10)
                    seconds = "0" + seconds;
                document.getElementById("timer").innerHTML = hour + ":" + minute + ":" + seconds;
            }

            //Code for form submit
            var hours = $('#hours').val();
            var minutes = $('#minutes').val();;
            var time = (hours * 3600000) + (minutes * 60000);
            window.setInterval(function() {
                document.getElementById("answer").submit();
            }, time);
        });
    </script>
    <script>
        $(function() {
            $('.textarea').summernote()
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endsection
