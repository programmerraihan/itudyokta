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


    {{-- <section class="our_speech " id="our_speech">
        <div class="bg_blur">
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
        </div>
        <!-- Our Speech Read More English POPUP box content -->
        <div class="modal fade" id="englishReadMore" tabindex="-1" aria-labelledby="englishReadMore" aria-hidden="true">
            <div class="modal-dialog modal-dialog">
                <div class="our_speech_model">
                    <div>
                        <h4>Our Speech.</h4>
                        <p>
                            There is a saying that everyone knows, "Education is the backbone of the nation".
                            However,
                            in the age of globalization, people have to be left behind by the education that is
                            common
                            in developing countries in today's world. As a result, the number of unemployed is
                            gradually
                            increasing. Technical education is needed to make any developing country not only in
                            Bangladesh but also in the world free from hunger, poverty and unemployment. Because
                            the
                            more advanced a country is in technical skills and technology, the stronger its
                            economy is.
                            At present, the Government of the People's Republic of Bangladesh has taken many
                            steps in
                            2041 to promote and spread technical education. This institute is carrying out
                            training
                            activities all over the country by expressing solidarity with the efforts of the
                            government.
                            The Ministry of Home Affairs, Ministry of Education, Ministry of Science and
                            Technology,
                            Ministry of Agriculture, Paddy Research Institute, MinistrThere is a saying that
                            everyone
                            knows, "Education is the backbone of the nation". However, in the age of
                            globalization,
                            people have to be left behind by the education that is common in developing
                            countries in
                            today's world. As a result, the number of unemployed is gradually increasing.
                            Technical
                            education is needed to make any developing country not only in Bangladesh but also
                            in the
                            world free from hunger, poverty and unemployment. Because the more advanced a
                            country is in
                            technical skills and technology, the stinistrThere is a saying that everyone knows,
                            "Education is the backbone of the nation". However, in the age of globalization,
                            people have
                            to be left behind by the education that is common in developing countries in today's
                            world.
                            As a result, the number of unemployed is gradually increasing. Technical education
                            is needed
                            to make any developing country not only in Bangladesh but also in the world free
                            from
                            hunger, poverty and unemployment. Because the more advanced a country is in
                            technical skills
                            and technology, the stinistrThere is a saying that everyone knows, "Education is the
                            backbone of the nation". However, in the age of globalization, people have to be
                            left behind
                            by the education that is common in developing countries in today's world. As a
                            result, the
                            number of unemployed is gradually increasing. Technical education is needed to make
                            any
                            developing country not only in Bangladesh but also in the world free from hunger,
                            poverty
                            and unemployment. Because the more advanced a country is in technical skills and
                            technology,
                            the stinistrThere is a saying that everyone knows, "Education is the backbone of the
                            nation". However, in the age of globalization, people have to be left behind by the
                            education that is common in developing countries in today's world. As a result, the
                            number

                        </p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Speech Read More English POPUP box content -->
        <div class="modal fade" id="banglaReadMore" tabindex="-1" aria-labelledby="banglaReadMore" aria-hidden="true">
            <div class="modal-dialog modal-dialog">
                <div class="our_speech_model">
                    <div>
                        <h4 style="font-family:'Shurjo'; ">আমাদের কথা</h4>
                        <p style="font-family:'Shurjo'; ">
                            একটা প্রবাদ প্রচলন আছে যেটি সকলের জানা, "শিক্ষাই জাতির মেরুদন্ড"। তবে বর্তমান বিশ্বে
                            উন্নয়নশীল রাষ্ট্র সমূহে সাধারণ যে শিক্ষা প্রচলন রয়েছে সে শিক্ষা দ্বারা বিশ্বায়নের
                            যুগে
                            মানুষকে পিছিয়ে থাকতে হয়। এতে ক্রমান্বয়ে বেকারত্বের সংখ্যা বেড়েই চলেছে। শুধু
                            বাংলাদেশে নয়
                            বিশ্বের যে কোন উন্নয়নশীল রাষ্ট্রকে ক্ষুধা মুক্ত, দারিদ্র মুক্ত, বেকার মুক্ত করতে হলে
                            প্রয়োজন
                            কারিগরী শিক্ষা। কারণ কোন দেশ কারিগরী দক্ষতা ও প্রযুক্তিতে যত বেশি উন্নত, সে দেশের
                            অর্থনীতি
                            ততই শক্তিশালী। কারিগরী শিক্ষার প্রচার ও প্রসারে বর্তমানে গণপ্রজাতন্ত্রী বাংলাদেশ
                            সরকার ২০৪১
                            সালকে কেন্দ্র করে বহু পদক্ষেপ গ্রহণ করেছেন। অত্র প্রতিষ্ঠান সরকারের প্রচেষ্টার সাথে
                            একাত্মা
                            প্রকাশের মাধ্যমে দেশব্যাপী প্রশিক্ষণ কার্যক্রম চালিয়ে যাচ্ছে। ইতিমধ্যে অত্র


                        </p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="free_course">
        <div class="bg-blur">
            <div class="container">
                <h1>Course Detalis</h1>

                <div class="row">

                    <div class="col-md-9" style="margin:auto; margin-bottom:15px;">
                        <a href="#" style="text-decoration:none;">
                            <div class="my_card">
                                <img src="{{ asset('frontend/course/' . $course->image) }}" class="img"
                                    style="width: 100%; height: auto;">
                                <div class="card_body">
                                    <h4 class="title">{{ $course->title }}</h4>
                                    <p class="prize">Price:{{ $course->price }}/-</p>
                                    <p class="discount_prize">{{ $course->offer_price }}</p>
                                    <span class="total_time"><i class="far fa-clock"></i>
                                        {{ $course->video_duration }}+ hr </span>
                                    <span class="total_video"><i class="fas fa-video"></i>
                                        {{ $course->total_video }}+ </span>
                                    <br />

                                    <p class="discount_prize">{!! $course->course_detail !!}</p>


                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

            <div class="my_glass_button">
                <a href="{{ route('admission') }}"> Admission </a>
            </div>
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
