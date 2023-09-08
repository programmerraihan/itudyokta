<section class="footer" style="background-color: black;">
    {{-- <video class="videoBack" src="{{ asset('frontend/assets/video/footer.mp4') }} " autoplay loop playsinline muted></video> --}}

    @php
        $system = \App\Models\SystemSetting::where('status', 1)->first();
        
    @endphp

    <div class="bg-blur">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h4>Office Address 1:</h4>
                    <p>
                        <span style="color:#ffd900;font-size:18px;font-weight:bold; margin-right:15px;"><i
                                class="fas fa-map-marker-alt"></i></span>{{ $system->address1 }}<br>
                        <span style="color:#ffd900; font-size: 18px; font-weight: bold;margin-right: 15px;"><i
                                class="fas fa-phone"></i></span>{{ $system->phone2 }}<br>
                        <span style="color:#ffd900; font-size: 18px; font-weight: bold;margin-right: 15px;"><i
                                class="far fa-envelope"></i></span><a href="https://mail.google.com/mail"
                            style="text-decoration:none;">{{ $system->gmail1 }}</a>
                    </p>
                </div>

                

            </div>

            <div class="social_links">
                <ul>
                    <li class="facebook"><a href="{{ $system->facebook }}" style="color:#4267B2;"><i
                                class="fab fa-facebook"></i></a></li>
                    <li class="twitter"><a href="{{ $system->twitter }}" style="color:#1DA1F2;"><i
                                class="fab fa-twitter"></i></a></li>
                    {{-- <li class="google"><a href="{{ $system->youtube }}" style="color:#ffd900;"><i
                                class="fab fa-google-plus-g"></i></a></li> --}}
                    <li class="instagram"><a href="{{ $system->instagram }}" style="color:#C13584;"><i
                                class="fab fa-instagram"></i></a></li>
                    <li class="youtube"><a href="{{ $system->youtube }}" style="color:#FF0000;"><i
                                class="fab fa-youtube"></i></a></li>
                </ul>
            </div>

        </div>
        <div class="copyright">
            <p>Copyright © 2016-2023 <span style="color:#ffd900;font-weight: bold;"><a href="#"
                        style="text-decoration: none;">{{ $system->name }}
                        .</a></span></p>
        </div>
    </div>
</section>
