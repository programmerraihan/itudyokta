@extends('website.layouts.layout')

@section('title', $blog->title)

@section('content')
    <div class="col-sm-12">
        <div class="card mb-3 shadow">
            <div class="card-header bg-success text-light">{{$blog->title}}</div>
            <div class="card-body">
                <img src="{{ asset('/frontend/blog/' . $blog->image) }}" class="card-img-top" alt="About Cover Page">
                <p class="text-justify">{!! $blog->body !!}</p>
            </div>
        </div>
    </div>
@endsection
