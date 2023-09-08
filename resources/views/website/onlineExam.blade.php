@extends('website.layouts.layout')

@section('title', 'Online Exam')

@section('content')

    <div class="col-sm-12">
        <div class="card mb-3 shadow">
            <div class="card-header bg-success text-light">Online Exam</div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}!</div>
                @endif
                <table style="width:100%; background:#fff" class="table table-bordered ">
                    <tr>
                        <th>SL</th>
                        <th>Exams</th>
                        <th>Question</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($exams as $key => $exam)
                        <tr>
                            <td style="width:5%">
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <p style="font-weight: bolder;"> {{ $exam->name }} </p>
                            </td>
                            <td>
                                <p style="font-weight: bolder;"> {{ $exam->question->name ?? 'N/A' }} </p>
                            </td>
                            <td>
                                <a href="{{ route('website.online-exam.test', ['id' => $exam->id, 'branch' => request()->branch ?? 'main']) }}"> (Click Here) </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
