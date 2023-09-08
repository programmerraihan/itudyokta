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
                <h4><i class="fas fa-envelope"></i>Blog </h4>
            </div>
        </div>
    </section>


    <section class="services" id="our_services">
        <div class="bg-blur">
            <div class="container">
                <h1> Our Blog</h1>



                <div class="row">
                    @foreach ($blogs as $blog)
                        {{-- @dd($blog) --}}
                        <div class="col-lg-3 " style="margin-bottom:15px;" style="display: flex;">
                            <a href="{{ route('blog_detail', $blog->id) }}" style="text-decoration:none;">
                                <div class="my_card">
                                    <img src="{{ asset('frontend/blog/' . $blog->image) }}" class="img">
                                    <div class="card_body">
                                        <h4 class="title_bn">{{ $blog->title }}</h4>
                                        <div class="card_body">

                                            <p class="service_description">
                                                {{ $blog->sort }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach



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
