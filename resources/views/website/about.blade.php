@extends('website.layouts.layout')

@section('title', 'About Us')

@section('content')
    <div class="col-sm-12">
        <div class="card mb-3 shadow">
            <img src="{{ asset("frontend/about/" . $about->image) }}" class="card-img-top" alt="About Cover Page">
            <div class="card-body">
                <h5 class="card-title">{{ $about->title }}</h5>
                <p class="card-text">{{$about->description}}</p>
                <p class="card-text">{{$about->long_text}}</p>
            </div>
        </div>
    </div>
@endsection
