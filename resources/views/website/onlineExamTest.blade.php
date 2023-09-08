@extends('website.layouts.layout')

@section('title', 'Online Exam Test Student')

@section('content')
    <div class="col-sm-12">
        <form action="{{ route('website.online-exam.start', ['id' => $id, 'branch' => request()->branch ?? 'main']) }}" method="GET" class="w-100">
           
            <div class="card mb-3 shadow">
                <div class="card-header bg-success text-light">Online Exam Test Student</div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label>Name*</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter your full name">
                            @error('name')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Enter your Email address">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label>Phone</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Enter your Phone Number">
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                placeholder="Enter your Address">
                            @error('address')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit & Start</button>
                </div>
            </div>
        </form>
    </div>
@endsection
