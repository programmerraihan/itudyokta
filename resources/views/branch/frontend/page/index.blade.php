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
    @include('branch.frontend.include.slide')

    <section class="our_speech " id="our_speech">
        <div class="bg_blur">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <h1>Our Speech</h1>
                        <div class="content_whole">


                            <div class="content contentEnglish">

                                @if (empty($speech->image))
                                    <img src="{{ asset('frontend/speech/speech.png') }}" style="height: 250px"
                                        width="681px">
                                @else
                                    <img src="{{ asset('frontend/speech/' . $speech->image) }}" style="height: 250px"
                                        width="681px">
                                @endif


                                <br />
                                <p>{!! $speech->sort_text ?? 'None' !!}</p>


                                @if (empty($speech->id))
                                    <p>more</p>
                                @else
                                    <a href="{{ route('branch.speech_detail', [$branch_slug, $speech->id]) }}"
                                        style="margin: 0px 5px;text-decoration: none;font-weight: bold;">More</a>
                                @endif
                                </p>
                            </div>


                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="regional_notice">
                            <h1> Notices: </h1>
                            <div class="withBtnMore">

                                <div class="notices_box">
                                    @foreach ($notices as $notice)
                                        <ul>
                                            <li>
                                                <p>{{ @$notice->title ?? 'None' }}</p>
                                                <span>Published: {{ @$notice->time ?? 'None' }}</span><br><br>
                                                <a
                                                    href="{{ route('branch.notice_detail', [@$branch_slug, @$notice->id]) }}">
                                                    <i class="fas fa-plus">
                                                    </i> Read More
                                                </a>
                                                <hr>
                                            </li>


                                        </ul>
                                    @endforeach




                                </div>
                                {{-- <div class="view_more">
                                    <a href="notices.html"> View All Notices </a>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                </div>



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
                            <a href="{{ route('branch.course.details', [$branch_slug, $offLineCourse->id]) }}"
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

                            {{-- <a href="{{ route('branch.course.details', [$branch_slug, $offLineCourse->id]) }}"
                                style="text-decoration:none;"> ok
                            </a> --}}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="my_glass_button">
                <a href="{{ route('branch.course', [$branch_slug]) }}"> More Off Line Course </a>
            </div>
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
                            <a href="{{ route('branch.course.details', [$branch_slug, $onLineCourse->id]) }}"
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

                <div class="my_glass_button">
                    <a href="{{ route('branch.course', [$branch_slug]) }}">More Paid Courses </a>
                </div>

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
                            <a href="{{ route('branch.course.details', [$branch_slug, $freeCourse->id]) }}"
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

            <div class="my_glass_button">
                <a href="{{ route('branch.course', [$branch_slug]) }}">More Tutorials </a>
            </div>
        </div>
        </div>
    </section>

    <section class="services" id="our_services">
        <div class="bg-blur">
            <div class="container">
                <h1> Our Services</h1>

                <div class="row">

                    @foreach ($services as $service)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:15px;">
                            <a href="{{ route('branch.service_detail', [$branch_slug, $service->id]) }}"
                                style="text-decoration:none;">
                                <div class="my_card">
                                    <img src="{{ asset('frontend/service/' . $service->image) }}" class="img">
                                    <div class="card_body">
                                        <h4 class="title_bn">{{ $service->title }}</h4>
                                        <div class="card_body">
                                            <p class="service_description">
                                                {{ $service->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>


                <br>
            </div>
        </div>
    </section>

    <section class="our_project">
        <div class="bg-blur">
            <div class="container">
                <h1>OUR PROJECT </h1>
                <div class="row">

                    @foreach ($projects as $project)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:15px;">
                            <a href="{{ route('branch.project_detail', [$branch_slug, $project->id]) }}"
                                style="text-decoration:none;">
                                <div class="my_card">
                                    <img src="{{ asset('frontend/project/' . $project->image) }}" class="img">
                                    <div class="card_body">
                                        <h4 class="title">{{ $project->title }} </h4>
                                        <p class="service_description"> {{ $project->description }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach



                </div>


            </div>


        </div>
        </div>
    </section>



    <section class="regional_director" id="regional_director">
        <div class="bg-blur">
            <div class="container">
                <h1> Our Board of Directors</h1>

                <div class="row">

                    @foreach ($directors as $director)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                            <div class="reg_card">
                                <div class="img_box">
                                    <img src="{{ asset('frontend/director/' . $director->image) }}">
                                </div>

                                <div class="name">
                                    <h4>{{ $director->name }}</h4>
                                </div>
                                <div class="details">
                                    <p>
                                        <span class="dir">{{ $director->designation }} </span><br>
                                        <span class="code"> আইটি উদ্যোক্তা ফাউন্ডেশন </span><br>
                                        <span class="add">Dhaka-1236</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>


                <br>
            </div>
        </div>
    </section>

    <section class="regional_director1" id="our_services">
        <div class="bg-blur">
            <div class="container">
                <h1> Our Regional Directors</h1>

                <div class="row">

                    @foreach ($regionals as $regional)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                            <div class="reg_card">
                                <div class="img_box">
                                    <img src="{{ asset('frontend/director/' . $regional->image) }}">
                                </div>

                                <div class="name">
                                    <h4>{{ $regional->name }}</h4>
                                </div>
                                <div class="details">
                                    <p>
                                        <span class="dir">{{ $regional->designation }}</span><br>
                                        <span class="code"> {{ $regional->title }} </span><br>
                                        <span class="add">{{ $regional->address }} </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach




                </div>


                <br>
            </div>
        </div>
    </section>

    <section class="successful_std" id="our_services">
        <div class="bg-blur">
            <div class="container">
                <h1> Our Successful Students</h1>

                <div class="row">


                    @php
                        //  == 'total_mark' >= 80 and 'total_mark' <= 100
                        
                        $studentResults = App\Models\StudentResult::orderBy('id', 'desc')
                            // ->with('student')
                            ->where('total_mark', '>=', 80)
                            ->limit(3)
                            ->get();
                        
                    @endphp

                    @foreach ($studentResults as $result)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                            <div class="std_card">
                                <div class="left">
                                    <h5>{{ optional(optional($result->enrollment)->student)->name }}</h5>
                                    <p>{{ optional(optional($result->enrollment)->student)->roll_no_student }}</p>
                                    <p>Mobile: {{ optional(optional($result->enrollment)->student)->mobile }}</p>
                                    <p style="color: #f00;">Grade: {{ $result->grade }}</p>
                                    <p>আইটি উদ্যোক্তা ফাউন্ডেশন</p>
                                </div>
                                <div class="right">
                                    <div class="bg">
                                        <img src="{{ asset('admin/image/student/' . optional(optional($result->enrollment)->student)->image) }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                        <div class="std_card">
                            <div class="left">
                                <h5>BURHAN UDDIN</h5>
                                <p>Roll: 220400025</p>
                                <p>Mobile: 01407857560</p>
                                <p style="color: #f00;">Job Title: Computer operator</p>
                                <p>Easy Computer</p>
                            </div>
                            <div class="right">
                                <div class="bg">
                                    <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                        <div class="std_card">
                            <div class="left">
                                <h5>MD. ALIM UDDIN</h5>
                                <p>Roll: 220400023</p>
                                <p>Mobile: 01765544267</p>
                                <p style="color: #f00;">Job Title: Teacher &amp; Computer Operator</p>
                                <p>DQ International Madrasha</p>
                            </div>
                            <div class="right">
                                <div class="bg">
                                    <img src="{{ asset('frontend/assets/admin/images/students/11.png') }}" />
                                </div>
                            </div>
                        </div>
                    </div> --}}



                </div>


                <br>
            </div>
        </div>
    </section>

    <section class="gallery" id="gallery">
        <div class="bg-blur">
            <div class="container">
                <h1>Gallery</h1>
                <div class="row">

                    @foreach ($galleries as $gallery)
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" data-aos="fade-left" data-aos-duration="3000">
                            <a href="{{ asset('frontend/gallery/' . $gallery->image) }}" data-lightbox="photos"
                                title="{{ $gallery->title }}">
                                <div class="image_box">
                                    <img src="{{ asset('frontend/gallery/' . $gallery->image) }}" alt=""
                                        title="" class="img-fluid" />
                                    <div class="gallery_details">
                                        <p>{{ $gallery->title }} </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach



                </div>


            </div>
        </div>
        </div>
    </section>


    <section class="testimonials_area">
        <div class="container">
            <div class="testi">
                <h1>Testimonials</h1>

                <div class="row" data-aos="fade-right" data-aos-duration="3000">
                    <div class="col-md-12">
                        <div id="testimonial-slider" class="owl-carousel">

                            @foreach ($testimonials as $testimonial)
                                <div class="testimonial">

                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="left">
                                                <div class="pic">
                                                    <img src="{{ asset('frontend/testimonial/' . $testimonial->image) }}">
                                                </div>
                                                <p class="title">{{ $testimonial->title }}
                                                </p>
                                                <span class="post">{{ $testimonial->sort_title }}</span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="right">
                                                <a href="{{ asset('frontend/student_image/' . $testimonial->student_image) }}"
                                                    data-lightbox="photos" title="">
                                                    <img
                                                        src="{{ asset('frontend/student_image/' . $testimonial->student_image) }}">
                                                    <!-- <p></p> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach




                        </div>
                    </div>
                </div>
            </div>
    </section>


    <div style="clear: both;"></div>

    <section class="goal_area">
        <div class="bg-blur">
            <div class="container">
                <h1 style="color:#fff;">
                    Our Achievement
                </h1>
                <div class="row" data-aos="fade-down" data-aos-duration="3000">
                    <div class=" col-md-3 col-sm-6 col-xs-6">
                        <div class="box">
                            <span class="icon"><i class="fa fa-graduation-cap"></i></span>
                            <span class="counter"> {{ $achievement->student ?? 'None' }} </span><span
                                style="color:#ffd900;font-weight: bold;">+</span>
                            <p>Completed Students</p>
                        </div>
                    </div>

                    <div class=" col-md-3 col-sm-6 col-xs-6">
                        <div class="box">
                            <span class="icon"><i class="fas fa-chalkboard-teacher"></i></span>

                            <span class="counter">{{ $achievement->instructor ?? 'None' }}</span><span
                                style="color:#ffd900;font-weight: bold;">+</span>
                            <p>Expert Instructors</p>
                        </div>
                    </div>

                    <div class=" col-md-3 col-sm-6 col-xs-6">
                        <div class="box">

                            <span class="icon"><i class="fa fa-film" aria-hidden="true"></i></span>
                            <span class="counter">{{ $achievement->tutorial ?? 'None' }}</span><span
                                style="color:#ffd900;font-weight: bold;">+</span>
                            <p>Tutorials in our store</p>
                        </div>
                    </div>

                    <div class=" col-md-3 col-sm-6 col-xs-6">
                        <div class="box">

                            <span class="icon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                            <span class="counter">{{ $achievement->employee ?? 'None' }}</span><span
                                style="color:#ffd900;font-weight: bold;">+</span>
                            <p>Students get employed</p>
                        </div>
                    </div>
                </div>
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

                @php
                    
                    $branch = \App\Models\Branch::where('slug', $slug)
                        ->select('id')
                        ->first();
                    $branch_id = $branch->id;
                    
                    $system = \App\Models\SystemSetting::where('status', 1)
                        ->where('branch_id', $branch_id)
                        ->first();
                    // dd($system);
                @endphp

                <div class="callback_location">
                    <div class="row ">
                        <div class="callback_form col-md-6 col-sm-6 col-xs-12" data-aos="fade-right"
                            data-aos-duration="3000">


                            <form action="{{ route('branch.store.contact') }}" method="POST"
                                enctype="multipart/form-data">
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
                                            <label class="form-check-label" hidden
                                                for="inlineCheckbox2">Unpublished</label>
                                        </div>
                                    </div>
                                </div>



                                <div class="my_glass_button">
                                    <input type="submit" class="my_btns" value="Send Message">
                                </div>

                            </form>
                        </div>

                        <div class="location col-md-6 col-sm-6 col-xs-12" data-aos="fade-left" data-aos-duration="3000">

                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7306.565581460718!2d90.43400282664588!3d23.701593365542756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9da4a476275%3A0x976b322054ef01a1!2sDoniya%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1665398258791!5m2!1sen!2sbd"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>

                        </div>
                    </div>
                </div> <!-- // callback_location -->
            </div>
        </div>

    </section>
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
