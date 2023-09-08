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
                <h4><i class="fas fa-envelope"></i>Blog </h4>
            </div>
        </div>
    </section>


    <section class="services" id="our_services">
        <div class="bg-blur">
            <div class="container">
                <h1> Online Exam </h1>

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:15px;">
                        <a href="service/%e0%a6%95%e0%a6%ae%e0%a7%8d%e0%a6%aa%e0%a6%bf%e0%a6%89%e0%a6%9f%e0%a6%be%e0%a6%b0%20%e0%a6%aa%e0%a7%8d%e0%a6%b0%e0%a6%b6%e0%a6%bf%e0%a6%95%e0%a7%8d%e0%a6%b7%e0%a6%a3.html"
                            style="text-decoration:none;">
                            <div class="my_card">
                                <img src="{{ asset('frontend/assets/admin/files/our_services/1-beadcf.gif') }} "
                                    class="img">
                                <div class="card_body">
                                    <h4 class="title_bn">কম্পিউটার প্রশিক্ষণ</h4>
                                    <div class="card_body">
                                        <p class="service_description">
                                            আইটি উদ্যোক্তা ফাউন্ডেশন স্কুল পরিচালিত প্রতিষ্ঠান হতে তিনটি
                                            পদ্ধতিতে কম্পিউটার
                                            প্রশিক্ষণ
                                            গ্রহণ করতে পারেন- (১) আমাদের পরিচালিত যেকোন প্রশিক্ষণ কেন্দ্রে ভর্তি
                                            হয়ে,
                                            (২) অনলাইন ভিডিও টিউটোরিয়াল ক্রয় করে এবং (৩) অনলাইন লাইভ ক্লাসের
                                            মাধ্যমে।...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:15px;">
                        <a href="service/%e0%a6%93%e0%a7%9f%e0%a7%87%e0%a6%ac%20%e0%a6%a1%e0%a6%bf%e0%a6%9c%e0%a6%be%e0%a6%87%e0%a6%a8%20%26%20%e0%a6%a1%e0%a7%87%e0%a6%ad%e0%a6%b2%e0%a6%be%e0%a6%aa.html"
                            style="text-decoration:none;">
                            <div class="my_card">
                                <img src="{{ asset('frontend/assets/admin/files/our_services/2-afdcbe.gif') }} "
                                    class="img">
                                <div class="card_body">
                                    <h4 class="title_bn">ওয়েব ডিজাইন &amp; ডেভলাপ</h4>
                                    <div class="card_body">
                                        <p class="service_description">
                                            There are many variations of passages of Lorem Ipsum available, but
                                            the
                                            majority have suffered alteration in some form, by injected humour,
                                            or
                                            randomised words which don&#039;t look even slightly believable. If
                                            you are
                                            going...</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:15px;">
                        <a href="service/%e0%a6%a1%e0%a7%8b%e0%a6%ae%e0%a7%87%e0%a6%a8%20%26%20%e0%a6%b9%e0%a7%8b%e0%a6%b7%e0%a7%8d%e0%a6%9f%e0%a6%bf%e0%a6%82.html"
                            style="text-decoration:none;">
                            <div class="my_card">
                                <img src="{{ asset('frontend/assets/admin/files/our_services/3-bcdeaf.gif') }} "
                                    class="img">
                                <div class="card_body">
                                    <h4 class="title_bn">ডোমেন &amp; হোষ্টিং</h4>
                                    <div class="card_body">
                                        <p class="service_description">
                                            There are many variations of passages of Lorem Ipsum available, but
                                            the
                                            majority have suffered alteration in some form, by injected humour,
                                            or
                                            randomised words which don&#039;t look even slightly believable. If
                                            you are
                                            going...</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:15px;">
                        <a href="service/%e0%a6%86%e0%a6%9e%e0%a7%8d%e0%a6%9a%e0%a6%b2%e0%a6%bf%e0%a6%95%20%e0%a6%b6%e0%a6%be%e0%a6%96%e0%a6%be%20%e0%a6%85%e0%a6%a8%e0%a7%81%e0%a6%ae%e0%a7%8b%e0%a6%a6%e0%a6%a8.html"
                            style="text-decoration:none;">
                            <div class="my_card">
                                <img src="{{ asset('frontend/assets/admin/files/our_services/4-ebacdf.gif') }}"
                                    class="img">
                                <div class="card_body">
                                    <h4 class="title_bn">আঞ্চলিক শাখা অনুমোদন</h4>
                                    <div class="card_body">
                                        <p class="service_description">
                                            তৃর্ণমূল পর্যায়ে তথ্য-প্রযুক্তির ছোয়া পৌঁছাতে ও উদ্যোক্তা সৃষ্টির
                                            লক্ষ্যে
                                            দেশব্যাপী কম্পিউটার প্রশিক্ষণ কেন্দ্র অনুমোদন করা হচ্ছে। আপনার কোন
                                            প্রশিক্ষণ
                                            কেন্দ্র আছে? যেটি সরকার/ কারীগরী শিক্ষাবোর্ড অনুমোদিত নয় তবে, আপনি
                                            আম...</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="my_glass_button">
                    <a href="services.html"> More Services </a>
                </div>
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
