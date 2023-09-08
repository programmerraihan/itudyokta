@extends('website.layouts.layout')

@section('title', 'Online Exam')

@section('content')
    <form action="{{ route('website.online-exam.submit', ['id' => $exam->id, 'branch' => request()->branch ?? 'main']) }}" method="POST" class="w-100">
        @csrf
        <div class="col-sm-12">
            <div class="card mb-3 shadow">
                <div class="card-header bg-success text-light">Online Exam</div>
                <div class="card-body">
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}" />
                    <div class="row">
                        <div class="col-md-12 col-sm-12 text-justify">
                            <div class="text-center">
                                <h4 style="margin:0;">{!! $question_master->name !!}</h4>
                                <p class="p-1 m-0">
                                    Total Marks: {!! $question_master->total_marks !!}
                                    Duration: @if($question_master->hour) {!! $question_master->hour !!} hour @endif
                                    @if($question_master->minute) : {!! $question_master->minute !!} Minute @endif
                                </p>
                            </div>
                            <input type="hidden" id="hours" value="{{ $question_master->hour }}">
                            <input type="hidden" id="minutes" value="{{ $question_master->minute }}">
                            <input type="hidden" name="name" value="{{ $name }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="phone" value="{{ $phone }}">
                            <input type="hidden" name="address" value="{{ $address }}">
                            <div class="text-justify mt-3">
                                {!! $question_master->passege !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($questions as $question)
            <div class="col-md-12 col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        {{ $loop->iteration }}:&nbsp;&nbsp; {!! $question->question !!}&nbsp;(<small>Mark: {{ $question->mark }}</small>)
                        
                        <?php
                            $j = 0;
                            $options = App\Models\AssessmentQuestionDetail::where('assessment_question_id', $question->id)->get();
                        ?>

                        <table>
                            @foreach ($options as $key => $option)
                                <tr>
                                    <td><input type="radio" id="item{{$question->id}}_{{$key}}" name="answer[{{ $question->id }}]"
                                            value="{{ ++$j }}"></td>
                                    <td><label for="item{{$question->id}}_{{$key}}" role="button" class="form-label">{!! $option->option !!}</label></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
