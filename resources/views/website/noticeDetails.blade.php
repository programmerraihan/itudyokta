@extends('website.layouts.layout')
@section('title', $notice->title)

@section('content')
    <div class="col-sm-12">
        <div class="card mb-3 shadow">
            <div class="card-header bg-success text-light">{{$notice->title}}</div>
            <div class="card-body">
                {!! $notice->long_text !!}
            </div>
        </div>
    </div>
@endsection
