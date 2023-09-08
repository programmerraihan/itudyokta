@extends('branch.frontend.include.main_master')
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
    @include('branch.frontend.include.top_header')
    @include('branch.frontend.include.navbar')
    @include('branch.frontend.include.slide_other')


    <section class="title_bar">
        <div class="container">
            <div>
                <h4> <i class="fas fa-user-graduate"></i> All Courses </h4>
            </div>
        </div>
    </section>
    <section class="free_course">
        <div class="bg-blur">
            <div class="container">
                <h1>Off Line Course</h1>

                <div class="row">
                    @foreach ($offLineCourses as $offLineCourse)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:15px;">
                            <a href="  {{ route('branch.course.details', [$branch_slug, $offLineCourse->id]) }}"
                                style="text-decoration:none;">
                                <div class="my_card">
                                    <img src="{{ asset('frontend/course/' . $offLineCourse->image) }}" class="img">
                                    <div class="card_body">
                                        <h4 class="title">{{ $offLineCourse->title }}</h4>
                                        <p class="prize">Prize:{{ $offLineCourse->price }}/-</p>
                                        <p class="discount_prize">{{ $offLineCourse->offer_price }}</p>
                                        <span class="total_time"><i class="far fa-clock"></i>
                                            {{ $offLineCourse->video_duration }}+ hr </span>
                                        <span class="total_video"><i class="fas fa-video"></i>
                                            {{ $offLineCourse->total_video }}+ </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <div class="my_glass_button">
                <a href="#"> More Off Line Course </a>
            </div> --}}
        </div>
        </div>
    </section>

    <section class="paid_course" id="our_courses">
        <div class="bg-blur">
            <div class="container">
                <h1>Our Paid Courses</h1>

                <div class="row">

                    @foreach ($onLineCourses as $onLineCourse)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:15px;">
                            <a href="  {{ route('branch.course.details', [$branch_slug, $onLineCourse->id]) }}"
                                style="text-decoration:none;">
                                <div class="my_card">
                                    <img src="{{ asset('frontend/course/' . $onLineCourse->image) }}" class="img">
                                    <div class="card_body">
                                        <h4 class="title">{{ $onLineCourse->title }} </h4>
                                        <p class="prize">Prize: {{ $onLineCourse->price }}/-</p>
                                        <p class="discount_prize">Discount: {{ $onLineCourse->offer_price }}/-</p>
                                        <span class="total_time"><i class="far fa-clock"></i>
                                            {{ $onLineCourse->video_duration }}+ hr </span>
                                        <span class="total_video"><i class="fas fa-video"></i>
                                            {{ $onLineCourse->total_video }}+ </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach



                </div>

                {{-- <div class="my_glass_button">
                    <a href="courses.html">More Paid Courses </a>
                </div> --}}

            </div>
        </div>
    </section>

    <section class="free_course">
        <div class="bg-blur">
            <div class="container">
                <h1>Our Free Tutorials </h1>
                <div class="row">

                    @foreach ($freeCourses as $freeCourse)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:15px;">
                            <a href=" {{ route('branch.course.details', [$branch_slug, $freeCourse->id]) }}"
                                style="text-decoration:none;">
                                <div class="my_card">
                                    <img src="{{ asset('frontend/course/' . $freeCourse->image) }}" class="img">
                                    <div class="card_body">
                                        <h4 class="title">{{ $freeCourse->title }} </h4>
                                        <p class="prize">Prize: {{ $freeCourse->price }}/-</p>
                                        <p class="discount_prize">Free</p>
                                        <span class="total_time"><i class="far fa-clock"></i>
                                            {{ $freeCourse->video_duration }}+ hr </span>
                                        <span class="total_video"><i class="fas fa-video"></i>
                                            {{ $freeCourse->total_video }}+ </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <div class="my_glass_button">
                <a href="#">More Tutorials </a>
            </div> --}}
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
