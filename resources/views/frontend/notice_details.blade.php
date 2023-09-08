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


    <section class="our_speech " id="our_speech">
        {{-- <div class="bg_blur">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1>Our Speech</h1>
                        <div class="content_whole">


                            <div class="content contentEnglish">

                          

                                        <img src="{{ asset('frontend/course/' . $course->image) }}" class="img" style="width: 50%">

                                        <div class="card_body">
                                            <h4 class="title">{{ $course->title }}</h4>
                                            <p class="prize">Prize:{{ $course->price }}/-</p>
                                            <p class="discount_prize">{{ $course->offer_price }}</p>
                                            <span class="total_time"><i class="far fa-clock"></i>
                                                {{ $offLineCourse->video_duration }}+ hr </span>
                                            <span class="total_video"><i class="fas fa-video"></i>
                                                {{ $offLineCourse->total_video }}+ </span>
                                        </div>
                                      

                             
                                <a href="ourspeech.html"
                                    style="margin: 0px 5px;text-decoration: none;font-weight: bold;"></a>

                                </p>
                            </div>


                        </div>
                    </div>

                 
                </div>



            </div>
        </div> --}}
        <!-- Our Speech Read More English POPUP box content -->

                    <div>
                        <h4 style="font-family:'Shurjo'; padding: 0 25px;">আমাদের কথা</h4>
                        <p style="font-family:'Shurjo'; padding: 0 25px;">
                            {!! $notice->long_text !!}
                        </p>
                    </div>

                  
        
                  
                
    </section> 

    {{-- <section class="free_course">
        <div class="bg-blur">
            <div class="container">
                <h1>Course Detalis</h1>

                <div class="row">
                   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:15px;">
                            <a href="#" style="text-decoration:none;">
                                <div class="my_card">
                                    <img src="{{ asset('frontend/course/' . $course->image) }}" class="img">
                                    <div class="card_body">
                                        <h4 class="title">{{ $course->title }}</h4>
                                        <p class="prize">Prize:{{ $course->price }}/-</p>
                                        <p class="discount_prize">{{ $course->offer_price }}</p>
                                        <span class="total_time"><i class="far fa-clock"></i>
                                            {{ $course->video_duration }}+ hr </span>
                                        <span class="total_video"><i class="fas fa-video"></i>
                                            {{ $course->total_video }}+ </span>
                                            <br/>

                                            <p class="discount_prize">{!! $course->course_detail !!}</p>

                                            
                                    </div>
                                </div>
                            </a>
                        </div>
                    
                </div>
            </div>

            <div class="my_glass_button">
                <a href="#"> More Off Line Course </a>
            </div>
        </div>
        </div>
    </section> --}}

    







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
