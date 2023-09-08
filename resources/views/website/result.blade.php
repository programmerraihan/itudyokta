@extends('website.layouts.layout')
@section('title', 'Result')

@section('content')
    <div class="col-sm-12">
        <div class="card mb-3 shadow">
            <div class="card-header bg-success text-light">Result</div>
            <div class="card-body">
                <form action="{{ route('website.result', ['branch' => request()->branch ?? 'main']) }}" method="GET">
                    <input type="hidden" name="search" value="true">
                    <div class="form-group">
                        <input class="form-control" placeholder="Roll Number" required name="roll"type="text"
                            value="{{ request()->roll }}">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (request()->search == true && !$studentResult && !$studentOffline)
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <p class="p-1 text-danger text-center">Roll Not Found!</p>
                </div>
            </div>
        </div>
    @endif

    @if ($studentResult)
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body" style="position: relative;">
                    @if ($studentResult->student->image)
                        <div>
                            <img class="profile-image"
                                src="{{ asset('admin/image/student/' . $studentResult->student->image . '') }}"
                                alt="">
                        </div>
                    @endif
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th style="width: 180px;">Your Name</th>
                                <td>{{ $studentResult->student->name }}</td>
                            </tr>
                            <tr>
                                <th>Your Roll</th>
                                <td>{{ $studentResult->student->roll_no_student }}</td>
                            </tr>
                            <tr>
                                <th>Registration</th>
                                <td>{{ $studentResult->student->reg_no_student }}</td>
                            </tr>
                            <tr>
                                <th>Grade Point</th>
                                <td>{{ $studentResult->grade }}</td>
                            </tr>
                            <tr>
                                <th>Course Name</th>
                                <td>{{ $studentResult->student->CourseTitle->title }}</td>
                            </tr>
                            <tr>
                                <th>Center Name</th>
                                <td>{{ $studentResult->branch->name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="form-group">
                        <a target="_blank"
                            href="{{ route('result.submit', ['id' => $studentResult->id, 'type' => 'online', 'branch' => request()->branch ?? 'main']) }}"
                            class="btn btn-primary">Get Certificate</a>
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if ($studentOffline)
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body" style="position: relative;">
                    @if ($studentOffline->student->image)
                        <div>
                            <img class="profile-image"
                                src="{{ asset('admin/image/student/' . $studentOffline->student->image . '') }}"
                                alt="">
                        </div>
                    @endif
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th style="width: 180px;">Your Name</th>
                                <td>{{ $studentOffline->student->name }}</td>
                            </tr>
                            <tr>
                                <th>Your Roll</th>
                                <td>{{ $studentOffline->student->roll_no_student }}</td>
                            </tr>
                            <tr>
                                <th>Registration</th>
                                <td>{{ $studentOffline->student->reg_no_student }}</td>
                            </tr>
                            <tr>
                                <th>Grade Point</th>
                                <td>{{ $studentOffline->grade }}</td>
                            </tr>
                            <tr>
                                <th>Course Name</th>
                                <td>{{ $studentOffline->student->CourseTitle->title }}</td>
                            </tr>
                            <tr>
                                <th>Center Name</th>
                                <td>{{ $studentOffline->student->Branch->name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="form-group">
                        <a target="_blank"
                            href="{{ route('result.submit', ['id' => $studentOffline->id, 'type' => 'offline', 'branch' => request()->branch ?? 'main']) }}"
                            class="btn btn-primary">Get Certificate</a>
                    </div>

                </div>
            </div>
        </div>
    @endif

@endsection
