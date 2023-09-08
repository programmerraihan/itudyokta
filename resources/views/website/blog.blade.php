@extends('website.layouts.layout')

@section('title', 'Blog Page')

@section('content')
    <div class="col-sm-12">
        <div class="card mb-3 shadow">
            <div class="card-header bg-success text-light">All BLog</div>
            <div class="card-body">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card">
                                <img src="{{ asset('/frontend/blog/' . $blog->image) }}" class="card-img-top"
                                    alt="{{ $blog->image }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $blog->title }}</h5>
                                    <p class="card-text">{{ $blog->sort }}</p>
                                    <a href="{{ route('website.blog_detail', ['id' => $blog->id, 'branch' => request()->branch ?? 'main']) }}" class="btn btn-xs btn-primary">See
                                        More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
