@extends('website.layouts.layout')

@section('title', 'Course List-Itudyokta')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body fw-bold">
                    All Courses
                </div>
            </div>
        </div>
    </div>

    @if ($onlineCourses->isNotEmpty())
        <div class="row">
            <div class="col-sm-12">
                <div class="card w-100 mt-3">
                    <div class="card-header bg-success text-light">Online Courses</div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @forelse ($onlineCourses as $onlinceCourse)
                                <a href="{{ route('course.details', ['id' => $onlinceCourse->id, 'branch' => request()->branch ?? 'main']) }}" class="text-decoration-none text-dark">
                                    <div class="col">
                                        <div class="card">
                                            <img src="{{ asset('frontend/course/' . $onlinceCourse->image) }}"
                                                class="card-img-top" alt="Course Image" />
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $onlinceCourse->title ?? 'N/A' }}</h5>
                                                <p class="p-1 m-0 clearfix">Price:
                                                    <del>{{ number_format($onlinceCourse->price) }}/-</del>
                                                    <span
                                                        class="float-end">{{ number_format($onlinceCourse->offer_price) }}/-</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($offlineCourses->isNotEmpty())
        <div class="row">
            <div class="col-sm-12">
                <div class="card w-100 mt-3">
                    <div class="card-header bg-success text-light">Offline Courses</div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @forelse ($offlineCourses as $offlineCourse)
                                <a href="{{ route('course.details', ['id' => $offlineCourse->id, 'branch' => request()->branch ?? 'main']) }}" class="text-decoration-none text-dark">
                                    <div class="col">
                                        <div class="card">
                                            <img src="{{ asset('frontend/course/' . $offlineCourse->image) }}"
                                                class="card-img-top" alt="Course Image" />
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $offlineCourse->title ?? 'N/A' }}</h5>
                                                <p class="p-1 m-0 clearfix">Price:
                                                    <del>{{ number_format($offlineCourse->price) }}/-</del>
                                                    <span
                                                        class="float-end">{{ number_format($offlineCourse->offer_price) }}/-</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($freeCourses->isNotEmpty())
        <div class="row">
            <div class="col-sm-12">
                <div class="card w-100 mt-3">
                    <div class="card-header bg-success text-light">Free Courses</div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @forelse ($freeCourses as $freeCourse)
                                <a href="{{ route('course.details', ['id' => $freeCourse->id, 'branch' => request()->branch ?? 'main']) }}" class="text-decoration-none text-dark">
                                    <div class="col">
                                        <div class="card">
                                            <img src="{{ asset('frontend/course/' . $freeCourse->image) }}"
                                                class="card-img-top" alt="Course Image" />
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $freeCourse->title ?? 'N/A' }}</h5>
                                                <p class="p-1 m-0 clearfix">Price:
                                                    <del>{{ number_format($freeCourse->price ?? 0) }}/-</del>
                                                    <span
                                                        class="float-end">{{ number_format($freeCourse->offer_price ?? 0) }}/-</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
