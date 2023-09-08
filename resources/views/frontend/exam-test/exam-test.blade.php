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
                <h4><i class="fas fa-envelope"></i> Online Exam Test Student </h4>
            </div>
        </div>
    </section>

    <form action="{{ route('assessment.question', $id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf

        <section class="services" id="our_services" style='padding: 115px 0 115px 0; background:#ffffe6;'>
            <div class="bg-blur">
                <div class="container">
                    <div class="row">

                        <h4>Test taker information </h4>
                        <div class="row">

                            <div class="col-md-4">
                                <label>Name<span style="color:red">*</span> : </label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter your full name">
                                @error('name')
                                    <small class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Email : </label>
                                <input type="text" name="email" class="form-control"
                                    placeholder="Enter your Email address">
                            </div>
                            <div class="col-md-4">
                                <label>Phone : </label>
                                <input type="text" name="phone" class="form-control"
                                    placeholder="Enter your Phone Number">
                            </div>

                        </div>

                        <div class="col-sm-8">
                            <label>Address<span style="color:red;">*</span> : </label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                placeholder="Enter your Address">
                            @error('address')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <input type="submit" class="btn btn-success" value="Submit and Start"
                                style=" margin-top: 30px;">
                        </div>

                    </div>


                </div>
            </div>
            </div>


        </section>
    </form>
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
