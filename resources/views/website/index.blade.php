@extends('website.layouts.layout')

@section('title', 'Itudyokta Website')


@push('slider')
    @include('website.layouts.slider')
@endpush


@section('content')
    <div class="col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-light">
                প্রতিষ্ঠানের বাণী
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <img src="{{ asset('frontend/speech/' . $speech->image) }}" class="img-thumbnail"
                            alt="Head Of Institution Thumbnail" srcset="">
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <p class="text-justify">{!! $speech->sort_text !!} <a
                                href="{{ route('speech.details', ['id' => $speech->id, 'branch' => request()->branch ?? 'main']) }}">Read
                                More</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if ($offlineCourses->isNotEmpty())
        {{-- offline courses --}}
        <div class="col-md-6 col-sm-12">
            <div class="card mt-3 shadow-sm">
                <div class="card-header bg-primary text-light">Offline Courses</div>
                <div class="card-body" style="height: 400px;">
                    @forelse ($offlineCourses as $offlineCourse)
                        <div class="hover-shadow">
                            <a href="{{ route('course.details', ['id' => $offlineCourse->id, 'branch' => request()->branch ?? 'main']) }}"
                                class="d-flex border rounded mb-1 text-decoration-none text-dark">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('frontend/course/' . $offlineCourse->image) }}"
                                        style="width:140px;height:70px" alt="Offline Course Image" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="p-1 m-0">{{ $offlineCourse->title ?? 'N/A' }}</h6>
                                    <p class="p-1 m-0 clearfix">Price:
                                        <del>{{ number_format($offlineCourse->price) }}/-</del>
                                        <span class="float-end">{{ number_format($offlineCourse->offer_price) }}/-</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    @if ($onlineCourses->isNotEmpty())
        {{-- online courses --}}
        <div class="col-md-6 col-sm-12">
            <div class="card mt-3 shadow-sm">
                <div class="card-header bg-primary text-light">Paid Courses</div>
                <div class="card-body" style="height: 400px;">
                    @forelse ($onlineCourses as $onlineCourse)
                        <div class="hover-shadow">
                            <a href="{{ route('course.details', ['id' => $onlineCourse->id, 'branch' => request()->branch ?? 'main']) }}"
                                class="d-flex border rounded mb-1 text-decoration-none text-dark">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('frontend/course/' . $onlineCourse->image) }}"
                                        style="width:140px;height:70px" alt="Online Course Image" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="p-1 m-0">{{ $onlineCourse->title ?? 'N/A' }}</h6>
                                    <p class="p-1 m-0 clearfix">Price:
                                        <del>{{ number_format($onlineCourse->price) }}/-</del>
                                        <span class="float-end">{{ number_format($onlineCourse->offer_price) }}/-</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    @if ($freeCourses->isNotEmpty())
        <div class="col-md-6 col-sm-12">
            <div class="card mt-3 shadow-sm">
                <div class="card-header bg-primary text-light">Free Courses</div>
                <div class="card-body" style="height: 400px;">
                    @forelse ($freeCourses as $freeCourse)
                        <div class="hover-shadow">
                            <a href="{{ route('course.details', ['id' => $freeCourse->id, 'branch' => request()->branch ?? 'main']) }}"
                                class="d-flex border rounded mb-1 text-decoration-none text-dark">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('frontend/course/' . $freeCourse->image) }}"
                                        style="width:140px;height:70px" alt="Offline Course Image" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="p-1 m-0">{{ $freeCourse->title ?? 'N/A' }}</h6>
                                    <p class="p-1 m-0 clearfix">Price:
                                        <del>{{ number_format($freeCourse->price) }}/-</del>
                                        <span class="float-end">0.00/-</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    {{-- our services --}}

    @if ($services->isNotEmpty())
        <div class="col-md-6 col-sm-12">
            <div class="card mt-3 shadow-sm">
                <div class="card-header bg-success text-light">Our Service</div>
                <div class="card-body" style="height: 400px;">
                    @forelse ($services as $service)
                        <div class="hover-shadow">
                            <a href="{{ route('course.details', ['id' => $service->id, 'branch' => request()->branch ?? 'main']) }}"
                                class="d-flex border rounded mb-1 text-decoration-none text-dark">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('frontend/service/' . $service->image) }}"
                                        style="width:140px;height:70px" alt="Demo Image" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="p-1 m-0">{{ $service->title }}</h6>
                                    @if ($service->description)
                                        <p class="text-xs text-justify">{{ $service->description }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    {{-- our projects --}}

    @if ($projects->isNotEmpty())
        <div class="col-md-6 col-sm-12">
            <div class="card mt-3 shadow-sm">
                <div class="card-header bg-warning text-light">Our Project</div>
                <div class="card-body" style="height: 400px;">
                    @forelse ($projects as $project)
                        <div class="hover-shadow">
                            <a href="javascript:void(0)" class="d-flex border rounded mb-1 text-decoration-none text-dark">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('frontend/project/' . $project->image) }}"
                                        style="width:140px;height:70px" alt="Project Image" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="p-1 m-0">{{ $project->title }}</h6>
                                    @if ($project->description)
                                        <p class="text-xs text-justify">{{ $project->description }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @endif


    @if ($branches->isNotEmpty())
        {{-- registered center --}}
        <div class="col-md-6 col-sm-12">
            <div class="card mt-3 shadow-sm">
                <div class="card-header bg-info text-light">Registered Center</div>
                <div class="card-body" style="height: 400px;overflow-x:scroll;">
                    <ol class="list-group list-group-numbered">
                        @forelse ($branches as $branch)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">
                                        <a target="_blank"
                                            href="{{ route('website.home', ['branch' => $branch->slug]) }}"
                                            class="text-decoration-none text-dark">{{ $branch->institute_name }}</a>
                                    </div>
                                    <a target="_blank" href="{{ route('website.home', ['branch' => $branch->slug]) }}"
                                        class="text-decoration-none text-dark">{{ $branch->institute_address }}</a>
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ol>
                </div>
            </div>
        </div>
    @endif

    {{-- board of directors --}}

    @if ($directors->isNotEmpty())
        <div class="col-md-6 col-sm-12">
            <div class="card mt-3 shadow-sm">
                <div class="card-header bg-success text-light">Board Of Directors</div>
                <div class="card-body" style="height: 400px;overflow-x:scroll;">
                    @forelse ($directors as $director)
                        <div class="hover-shadow">
                            <a href="javascript:void(0)"
                                class="d-flex border rounded mb-1 text-decoration-none text-dark">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('frontend/director/' . $director->image) }}"
                                        style="width:140px;height:140px" alt="Project Image" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-bold">{{ $director->name }}</div>
                                    {{ $director->designation }}
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    @if ($galleries->isNotEmpty())
        {{-- gallery --}}
        <div class="col-md-12 col-sm-12">
            <div class="card mt-3 shadow-sm">
                <div class="card-header bg-success text-light">Gallery</div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($galleries as $gallery)
                            <div class="col-md-4 col-sm-12 mt-1">
                                <div class="position-relative">
                                    <img src="{{ asset('frontend/gallery/' . $gallery->image) }}" class="img-thumbnail"
                                        alt="Image Thumbnail" srcset="" />
                                    <div class="gallery-details position-absolute"
                                        style="bottom: 0;
                            left: 0;
                            text-align: center;
                            background: rgba(0,0,0,0.5);
                            color: white;
                            margin: .25rem;
                            border-radius: 0 0 5px 5px;">
                                        {{ $gallery->title }}
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- our service -->
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
