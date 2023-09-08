@extends('website.layouts.layout')
@section('title', $course->title . ' - Course Details')

@section('content')
    <div class="col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-light">
                {{ $course->title }}
            </div>
            <div class="card-body">
                <img src="{{ asset('frontend/course/' . $course->image) }}" class="img" style="width: 100%; height: auto;">
                <h4 class="title">{{ $course->title }}</h4>
                <p class="p-0 m-0">Price: <del>{{ number_format($course->price) }}/-</del>
                    {{ number_format($course->offer_price) }}/-</p>
                @if ($course->video_duration)
                    <p class="p-0 m-0">{{ $course->video_duration }}+ hr</p>
                @endif
                <p class="text-justify">{!! $course->course_detail !!}</p>
            </div>
        </div>
    </div>

@endsection
