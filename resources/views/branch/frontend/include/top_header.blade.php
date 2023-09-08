<div class="col-lg-12" style="height: 45px; background:#f5be0b">


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

    <div class="container">
        <div class="row ">

            <div class="col-lg-3 col-md-5 col-7">
                <div id="parent">
                    <div id="social_media">
                        <p class=" mb-0" style="color: #0056b3 !important">
                            <i class="far fa-clock"></i>
                            {{ @$system->start_day_time }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 col-5">

                <div id="parent">
                    <div id="social_media">
                        <p class="mb-0">
                            <a href="tel: 110-101-101" class="" style="color: #0056b3 !important">
                                <i class="fa fa-phone "></i>
                                {{ @$system->phon }}
                            </a>
                        </p>

                    </div>
                </div>
            </div>



            <div class="col-lg-3 col-md-3 col-12 ms-auto">
                <div id="parent">
                    <div id="social_media">

                        <a href="{{ @$system->facebook }}"><i class="fab fa-facebook"></i></a>
                        <a href="{{ @$system->twitter }}"><i class="fab fa-twitter"></i></a>
                        <a href="{{ @$system->instagram }}"><i class="fab fa-instagram"></i></a>
                        <a href="{{ @$system->pinterest }}"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-12 ms-auto">
                <div id="parent">
                    <div id="social_media">

                        <a style="background: #0056b3; margin-right: 5px; padding: 5px; color: #fff;"
                            href="{{ route('login_from_student') }}">
                            Student login
                        </a>
                        {{-- <a style="background: #0056b3; padding: 5px; color: #fff;"
                            href="{{ route('login_from_branch') }}">
                            Branch login
                        </a> --}}

                    </div>
                </div>
            </div>



        </div>
    </div>

</div>
