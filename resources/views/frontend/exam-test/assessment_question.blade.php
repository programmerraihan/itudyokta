@extends('frontend.main_master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style type="text/css">
        nav {
            width: 100%;
            z-index: 5;
            text-align: center;
        }

            {
            color: #fff !important;
        }

        p {
            margin: 0;
            padding: 0;
        }



        nav ul li {
            padding: 10px 10px;
            transition: 0.4s;
        }

        nav ul li a {
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
        }

        nav ul li .active {
            color: #ffd900;
        }

        nav ul li:hover a {
            color: #fff;
        }

        @media (max-width: 767px) {

            nav {
                /*background: #000;*/
                margin-bottom: 30px;
            }

            nav button {
                background: #f00;
                color: #4e00cc;

            }

        }

        .fixed {
            position: fixed;
            top: 0;
        }

        * {
            box-sizing: border-box;
        }

        #parent {
            color: #fff;
            padding: 10px;
            width: 100%;

            text-align: center;
        }

        .fab {
            padding: 20px;
            font-size: 30px;
            color: #fff;
            width: 50px;
            text-align: center;
            text-decoration: none;
        }



        td {
            padding: 2px;
        }

        td p {
            margin: 0;
            padding: 0;
            display: inline;
        }

        .passege {
            border: 2px solid;
            padding: 15px;
            margin-bottom: 15px;
        }

        #count_up_timer {
            font-size: 18px;
            font-weight: bold;
            color: rgb(0, 139, 53);
        }

        #stop_count_up_timer {
            background-color: black;
            color: white
        }

        #timer {
            width: fit-content;
            font-size: 17px;
            font-weight: 700;
            position: fixed;
            right: 10px;
            background: #9fedff;
            border-radius: 4px;
            padding: 3px;
        }
    </style>
@endsection

@section('mian')
    @include('frontend.body.top_header')
    @include('frontend.body.navbar')
    @include('frontend.body.slide_other')

    <section class="services" id="our_services" style="padding: 115px 0 25px 0; background:#ffffe6;">
        <div class="bg-blur">
            <div class="container">
                <div class="card">
                    <div id="timer"></div>
                    <form action="{{ route('answer.submit') }}" method="POST" class="form-horizontal" id="answer"
                        name="answer" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{$exam->id}}" />
                        <div class="row" style="padding: 25px 50px;">


                            {{-- @dd($question_master); --}}
                            <div class="col-md-12" style="text-align: center;">
                                <h4 style="text-align: center; margin:0;">
                                    {!! $question_master->name !!}<br>
                                </h4>
                                Total Marks: {!! $question_master->total_marks !!} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Duretion: {!! $question_master->hour !!} : {!! $question_master->minute !!}
                                <input type="hidden" id="hours" value="{!! $question_master->hour !!}">
                                <input type="hidden" id="minutes" value="{!! $question_master->minute !!}">
                                <input type="hidden" name="name" value="{{ $name }}">
                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="hidden" name="phone" value="{{ $phone }}">
                                <input type="hidden" name="address" value="{{ $address }}">
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
                                                <td><input type="radio" name="answer[{{ $question->id }}]"
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
    </section>
@endsection

@section('js')
    <script>
        var stickyOffset = $('.sticky').offset().top;

        $(window).scroll(function() {
            var sticky = $('.sticky'),
                scroll = $(window).scrollTop();

            if (scroll >= stickyOffset) sticky.addClass('fixed');
            else sticky.removeClass('fixed');
        });
    </script>
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
