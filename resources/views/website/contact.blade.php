@extends('website.layouts.layout')

@section('title', 'Contact Us')

@section('content')
    <?php
    $system = \App\Models\SystemSetting::where('status', 1)->first();
    ?>
    {{-- <div class="col-md-12 col-sm-12"">
        <div class="card">
            <div class="card-header bg-success text-light">Office Address</div>
            <div class="card-body">
                <p style="font-size: 20px;">
                    <span><i class="fas fa-location"></i></span>{{ $system->address1 }}<br>
                    <span style="color:#ffd900; font-size: 18px; font-weight: bold;margin-right: 15px;"><i
                            class="fas fa-phone"></i></span>{{ $system->phone2 }}<br>
                    <span style="color:#ffd900; font-size: 18px; font-weight: bold;margin-right: 15px;"><i
                            class="far fa-envelope"></i></span><a href="https://mail.google.com/mail"
                        style="text-decoration:none;">{{ $system->gmail1 }}</a>
                </p>

                <p style="font-size: 38px;">
                    <span class="facebook"><a href="{{ $system->facebook }}" style="color:#4267B2;"><i
                                class="fab fa-facebook"></i></a></span>
                    <span class="twitter"><a href="{{ $system->twitter }}" style="color:#1DA1F2;"><i
                                class="fab fa-twitter"></i></a></span>

                    <span class="instagram"><a href="{{ $system->instagram }}" style="color:#C13584;"><i
                                class="fab fa-instagram"></i></a></span>
                    <span class="youtube"><a href="{{ $system->youtube }}" style="color:#FF0000;"><i
                                class="fab fa-youtube"></i></a></span>
                </p>
            </div>
        </div>
    </div> --}}


    <div class="col-md-12 col-sm-12">
        <div class="card mt-3 shadow-sm">
            <div class="card-header bg-success text-light">Contact Us</div>
            <div class="card-body" style="height: 400px;">
                <form action="{{ route('store.contact') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" placeholder="Your Name" required name="name" type="text" />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" placeholder="Your E-mail" required name="email" type="email">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" placeholder="Mobile No." required name="phone" type="number">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control textarea" placeholder="Your Message..." rows="3" required name="message"
                            cols="50"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
