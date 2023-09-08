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
                <h4><i class="fas fa-envelope"></i> Contact Us </h4>
            </div>
        </div>
    </section>


    <section class="callback_area" id="feedback">
        <div class="bg-blur">
            <div class="container">
                <div class="row">
                    <h1>
                        Request A Callback
                    </h1>
                </div>
                <div class="callback_location">
                    <div class="row ">
                        <div class="callback_form col-md-6 col-sm-6 col-xs-12" data-aos="fade-right"
                            data-aos-duration="3000">

                            <form action="{{ route('branch.store.contact') }}" method="POST" enctype="multipart/form-data">
                                @csrf


                                <input type="hidden" name="" value="">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Your Name" required
                                        name="name"type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Your E-mail" required name="email"
                                        type="email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mobile No." required name="phone"
                                        type="number">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control textarea" placeholder="Your Message..." rows="3" required name="message"
                                        cols="50"></textarea>
                                </div>

                                <div class="form-group">
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" hidden checked type="radio" name="status"
                                                id="inlineCheckbox1" value="1">
                                            <label class="form-check-label" hidden for="inlineCheckbox1">Published</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" hidden type="radio" name="status"
                                                id="inlineCheckbox2" value="0">
                                            <label class="form-check-label" hidden for="inlineCheckbox2">Unpublished</label>
                                        </div>
                                    </div>
                                </div>



                                <div class="my_glass_button">
                                    <input type="submit" class="my_btns" value="Send Message">
                                </div>


                            </form>




                        </div>

                        <div class="location col-md-6 col-sm-6 col-xs-12" data-aos="fade-left" data-aos-duration="3000">
                            <!-- <img src="img/location.jpg"> -->
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7306.565581460718!2d90.43400282664588!3d23.701593365542756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9da4a476275%3A0x976b322054ef01a1!2sDoniya%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1665398258791!5m2!1sen!2sbd"
                                width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>

                        </div>
                    </div>
                </div> <!-- // callback_location -->
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
