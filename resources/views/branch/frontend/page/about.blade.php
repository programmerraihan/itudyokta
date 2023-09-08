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
                <h4><i class="fas fa-envelope"></i>About </h4>
            </div>
        </div>
    </section>
    <section class="our_speech " id="our_speech">
        <div class="bg_blur">
            <div class="container">
                <!-- about section -->
                {{-- @dd($about) --}}
                <section class="w3l-about-3 pb-5 pt-2">
                    <div class="container py-md-5 py-4 mb-5">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-6 pr-lg-5">
                                <h3 class="title-big">{{ $about->title ?? 'none'}}</h3>
                                <p class="mt-3">IT UDYOKTA
                                    A Project of SOFT HOST LTD.</p>
                                <ul class="list-about-2 mt-sm-4 mt-3">
                                    <li class="py-1"><i class="fa fa-check-square-o mr-2"
                                            aria-hidden="true"></i>Bangladesh Government Approved</li>
                                    <li class="py-2"><i class="fa fa-check-square-o mr-2"
                                            aria-hidden="true"></i>REGISTRATION NO. C-186066/2022...

                                    </li>
                                    <li class="py-1"><i class="fa fa-check-square-o mr-2" aria-hidden="true"></i>Dhaka
                                        Bagladesh </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 about-2-secs-right mt-lg-0 mt-5">
                                {{-- <img src="{{ asset('frontend/assets/admin/files/galleries/a.jpg') }}" alt=""
                                    class="img" /> --}}

                                <img src="{{ asset('frontend/about/' . $about->image) }}" class="img">
                            </div>
                        </div>
                    </div>
                </section>
                <!-- //about section -->


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content_whole">
                            <div class="content contentEnglish">
                                <p>
                                <p style="text-align:justify;">
                                    {{ $about->long_text  ?? 'none'}}

                                </p>


                            </div>
                        </div>
                    </div>
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
