@extends('website.layouts.layout')

@section('title', 'Itudyokta Website')

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
                        <p class="text-justify">{!! $speech->long_text !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
