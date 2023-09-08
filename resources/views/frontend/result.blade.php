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

        .profile-image {
            width: 200px;
            height: auto;
            border: 1px solid black;
            border-radius: 5px;
            position: absolute;
            right: 25px;
            top: 25px;
        }

        @media only screen and (max-width: 750px) {
            .profile-image {
                width: 100%;
                height: auto;
                border: 1px solid black;
                border-radius: 5px;
                position: relative;
                right: 0;
                top: 0;
            }
        }
    </style>
@endsection
@section('mian')
    @include('frontend.body.top_header')
    @include('frontend.body.navbar')
    @include('frontend.body.slide_other')


    <section class="callback_area" id="feedback">
        <div class="bg-blur">
            <div class="container">
                <div class="row">
                    <h1>
                        Result
                    </h1>
                </div>
                <div class="callback_location">
                    <div class="row ">
                        <div class="callback_form col-md-12 col-sm-12 col-xs-12" data-aos="fade-right"
                            data-aos-duration="3000">
                            {{-- {{ route('result.submit') }} --}}
                            <form action="{{ route('result') }}" method="GET">
                                <input type="hidden" name="search" value="true">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Roll Number" required
                                        name="roll"type="text" value="{{ request()->roll }}">
                                </div>
                                <div class="my_glass_button">
                                    <input type="submit" class="my_btns" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if(request()->search == true && !$studentResult && !$studentOffline)
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="p-1 text-danger text-center">Roll Not Found!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($studentResult)
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-body" style="position: relative;">
                                    @if($studentResult->student->image)
                                        <div>
                                            <img class="profile-image" src="{{ asset('admin/image/student/'. $studentResult->student->image . '') }}"
                                                alt="">
                                        </div>
                                    @endif
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <th style="width: 180px;">Your Name</th>
                                                <td>{{ $studentResult->student->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Your Roll</th>
                                                <td>{{ $studentResult->student->roll_no_student }}</td>
                                            </tr>
                                            <tr>
                                                <th>Registration</th>
                                                <td>{{ $studentResult->student->reg_no_student }}</td>
                                            </tr>
                                            <tr>
                                                <th>Grade Point</th>
                                                <td>{{ $studentResult->grade }}</td>
                                            </tr>
                                            <tr>
                                                <th>Course Name</th>
                                                <td>{{ $studentResult->student->CourseTitle->title }}</td>
                                            </tr>
                                            <tr>
                                                <th>Center Name</th>
                                                <td>{{ $studentResult->branch->name }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="form-group">
                                        <a target="_blank" href="{{ route('result.submit', ['id' => $studentResult->id, 'type' => 'online']) }}"
                                            class="btn btn-primary">Get Certificate</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($studentOffline)
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-body" style="position: relative;">
                                    @if($studentOffline->student->image)
                                        <div>
                                            <img class="profile-image" src="{{ asset('admin/image/student/'. $studentOffline->student->image . '') }}"
                                                alt="">
                                        </div>
                                    @endif
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <th style="width: 180px;">Your Name</th>
                                                <td>{{ $studentOffline->student->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Your Roll</th>
                                                <td>{{ $studentOffline->student->roll_no_student }}</td>
                                            </tr>
                                            <tr>
                                                <th>Registration</th>
                                                <td>{{ $studentOffline->student->reg_no_student }}</td>
                                            </tr>
                                            <tr>
                                                <th>Grade Point</th>
                                                <td>{{ $studentOffline->grade }}</td>
                                            </tr>
                                            <tr>
                                                <th>Course Name</th>
                                                <td>{{ $studentOffline->student->CourseTitle->title }}</td>
                                            </tr>
                                            <tr>
                                                <th>Center Name</th>
                                                <td>{{ $studentOffline->student->Branch->name }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="form-group">
                                        <a target="_blank" href="{{ route('result.submit', ['id' => $studentOffline->id, 'type' => 'offline']) }}"
                                            class="btn btn-primary">Get Certificate</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

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
