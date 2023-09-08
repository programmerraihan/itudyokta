@extends('frontend.main_master')
@section('css')
    <style type="text/css">
        nav {
            width: 100%;
            z-index: 5;
            text-align: center;
        }

            {
            color: #fff !important;
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
    </style>
@endsection
@section('mian')
    @include('frontend.body.top_header')
    @include('frontend.body.navbar')
    @include('frontend.body.slide_other')


    <section class="title_bar">
        <div class="container">
            <div>
                <h4><i class="fas fa-envelope"></i> Online Exam </h4>
            </div>
        </div>
    </section>


    <section class="services" id="our_services">
        <div class="bg-blur">
            <div class="container">
                <h1> Online Exam </h1>




                <div class="table-responsive">

                    <table style="width:100%; background:#fff" class="table table-bordered ">
                        <tr>
                            <th>SL</th>
                            <th>Exams</th>
                            <th>Question</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($exams as $key => $exam)
                            <tr>
                                <td style="width:5%">
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    <p style="font-weight: bolder;"> {{ $exam->name }} </p>
                                </td>
                                <td>
                                    <p style="font-weight: bolder;"> {{ $exam->question->name ?? 'N/A' }} </p>
                                </td>
                                <td>
                                    <a href="{{ route('student.exam.test', $exam->id) }}"> (Click Here) </a>
                                </td>
                            </tr>
                        @endforeach

                    </table>

                </div>



                {{-- <div class="my_glass_button">
                    <a href="services.html"> More Services </a>
                </div> --}}
                <br>
            </div>
        </div>
    </section>




    <div style="clear: both;"></div>
    &nbsp;
    &nbsp;
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
@endsection
