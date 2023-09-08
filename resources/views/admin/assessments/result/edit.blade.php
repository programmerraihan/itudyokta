@extends('admin.admin_master')


@section('css')
    <style type="text/css">
        fieldset {
            min-width: 0px;
            padding: 15px;
            margin: 7px;
            border: 2px solid #a66df5;
        }

        legend {
            float: none;
            background-image: linear-gradient(to bottom right, #062689, #5b076f);
            padding: 4px;
            width: 50%;
            color: rgb(255, 255, 255);
            border-radius: 7px;
            font-size: 17px;
            font-weight: 700;
            text-align: center;
        }

        hr.new3 {
            border-bottom: 3px dotted rgba(3, 13, 210, 0.841);
            padding: 20px;
        }

        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
    </style>
@endsection

@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            @if ($message = Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{-- @dd($message) --}}
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add Question</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                <li class="breadcrumb-item active">Add Question</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <fieldset>
                <legend>Question Show
                </legend>

                <h5 class="animated fadeOut"> {{ Session::get('message') }} </h5>
                <div class="card">
                    <div class="row" style="padding: 25px 50px;">
                        <div class="col-md-12" style="text-align: center;">

                            <h4 style="text-align: center; margin:0;">
                                {!! $question_master->assessment_exam->name ?? "N/A" !!}<br>
                                {!! $question_master->name !!}
                            </h4>

                            <h4 style=" text-align: center; margin:0;">
                                Total Marks: {!! $question_master->total_mark !!} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ 'duretion' }}: {!! $question_master->hour !!} {{ 'hour' }} {!! $question_master->minute !!}
                                {{ 'minute' }}
                            </h4>
                        </div>
                        <hr>
                        <div class="passege col-md-12" style="font-size: 16px; text-align: left; ">
                            {!! $question_master->passege !!}
                        </div>
                    </div>
                    <form action="{{ route('submitted.assessment.update', $test_taker->id) }}" method="POST"
                        class="form-horizontal col-md-12" enctype="multipart/form-data" style="padding: 15px;">
                        @csrf
                        @php $i=0; @endphp
                        <hr>
                        @foreach ($answers as $answer)
                            @php  $i++; @endphp
                            <div class="row">
                                <div class="col-sm-11">
                                    <table>
                                        <tr>
                                            <td style="position: relative; width: 25px;">
                                                <b style="position: absolute; top: 2px;">{{ $i }}.</b>
                                            </td>
                                            <td style=" top: 2px;  font-weight: bold;  font-size: 16px;">
                                                {!! $answer->assessment_question->question !!}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-1">
                                    <h5> <span>{{ $answer->assessment_question->mark }}</span></h5>
                                </div>
                            </div>
                            @php
                                $j = 0;
                                $options = App\Models\AssessmentQuestionDetail::where('assessment_question_id', $answer->assessment_question->id)->get();
                            @endphp

                            <table>
                                @foreach ($options as $option)
                                    @php $j++; @endphp
                                    <tr>
                                        <td>
                                            <input type="radio" @if ($answer->answer == $j) checked="checked" @endif
                                                onclick="return false;">
                                        </td>
                                        <td>{!! $option->option !!}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td> </td>
                                    <td>
                                        <span style="font-size: 16px; font-weight:700;">Mark:</span>
                                        <input type="text" class="mark"
                                            name='given_mark[{{ $answer->assessment_question->id }}]'
                                            @if ($answer->assessment_question->answer == $answer->answer) value="{{ $answer->assessment_question->mark }}" style="color:green" 
                                                            @else value="0" style="color:red" @endif>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <hr>
                        @endforeach

                        <input type="submit" class="btn btn-success" value="{{ 'submit' }}"
                            style="float: right; margin-top: 15px;">


                    </form>
                </div>
            </fieldset>
        </div>
    </div>
@endsection

@section('script')
@endsection
