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
                <h4><i class="fas fa-envelope"></i>About </h4>
            </div>
        </div>
    </section>
    <section class="our_speech " id="our_speech">
        <div class="bg_blur">
            <div class="container">
                <!-- about section -->
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="{{ asset('frontend/assets/admin/files/galleries/a.jpg') }}" alt=""
                            class="img" style="    height: auto;
                            width: 100%;">
                    </div>
                </div>


                <!-- //about section -->


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="content_whole">
                            <div class="content contentEnglish">
                                <p>

                                   
                                <p style="text-align:justify;">

                                    <p class="discount_prize">{!! $about->long_text  ?? 'null' !!}</p>
                                   
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
