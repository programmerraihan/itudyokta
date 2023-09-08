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

            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="">
                            <div class="invoice-title">

                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('assessment.question.update', $question->id) }}" method="POST"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <legend>Add Question
                            </legend>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name"> Title Name</label>
                                                    <input type="text" name="name" value="{{ $question->name }}"
                                                        class="form-control" id="name">
                                                </div>
                                            </div>                                            
                                        </div>

                                        {{-- @dd($question); --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hour"> Duration hours</label>
                                                    <input type="number" value="{{ $question->hour }}" name="hour"
                                                        class="form-control" id="hour">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="minutes"> Duration minutes</label>
                                                    <input type="any" value="{{ $question->minute }}" name="minute"
                                                        class="form-control" id="minutes">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name"> Passege </label>
                                                    <textarea type="text" name="passege" class="form-control summernote" id="title">{{ $question->passege }} </textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <fieldset>
                                <legend>Question sections
                                </legend>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body" id="questionDivBody">
                                            @foreach ($ass_questions as $ass_question)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name"> Question Title </label>
                                                            <textarea type="text" name="ques[{{ $ass_question->question_no }}][question]" class="form-control question-title "
                                                                id="title">{!! $ass_question->question !!} </textarea>

                                                        </div>
                                                    </div>

                                                    @php
                                                        $o = 0;
                                                        $options = App\Models\AssessmentQuestionDetail::where('assessment_question_id', $ass_question->id)->get();
                                                    @endphp

                                                    @foreach ($options as $option)
                                                        @php $o++; @endphp
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name"> Option</label>
                                                                <textarea type="text" name="ques[{{ $ass_question->question_no }}][option][{{ $o }}]"
                                                                    class="form-control summernote  question-option-one" id="title"> {!! $option->option !!} </textarea>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="name">Answer </label>
                                                            <input type="text"
                                                                name="ques[{{ $ass_question->question_no }}][answer]"
                                                                class="form-control question-answer" id="answer"
                                                                value="{{ $ass_question->answer }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="name">Mark </label>
                                                            <input type="text"
                                                                name="ques[{{ $ass_question->question_no }}][mark]"
                                                                class="form-control question-mark" id="mark"
                                                                value="{{ $ass_question->mark }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>

                                    </div>
                                </div>


                                <hr class="new3">


                                <div class="col-lg-12">
                                    <div class="card row" id="question">

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <span style="width: 150px" id="questionAddBtn"
                                                        class="btn btn-primary">ADD
                                                        Question </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>


                            <button style="width: 100px" type="reset" class=" float-right btn btn-secondary">Reset
                            </button>
                            <button style="width: 150px" type="submit" class=" float-right btn btn-primary"> Question
                                Submit
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var i = 0;
        $('#questionAddBtn').on('click', function() {
            i++;
            $("#question").append(`
            <div class="col-lg-12 optionBox">
                <div class="card">
                    <div class="card-body" id="questionDivBody">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Question Title </label>
                                    <textarea type="text" name="mcq[` + i + `][question]" class="form-control question-title " id="title"> </textarea>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"> Option 1 </label>
                                    <textarea type="text" name="mcq[` + i + `][option][1]" class="form-control summernote  question-option-one" id="title"> </textarea>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"> Option 2 </label>
                                    <textarea type="text" name="mcq[` + i + `][option][2]" class="form-control summernote question-option-two " id="title"> </textarea>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"> Option 3 </label>
                                    <textarea type="text" name="mcq[` + i + `][option][3]" class="form-control summernote question-option-three"
                                        id="title"> </textarea>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"> Option 4 </label>
                                    <textarea type="text" name="mcq[` + i + `][option][4]" class="form-control summernote question-option-fourth "
                                        id="title"> </textarea>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Answer </label>
                                    <input type="text" name="mcq[` + i + `][answer]"
                                        class="form-control question-answer" id="answer">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Mark </label>
                                    <input type="text" name="mcq[` + i + `][mark]"
                                        class="form-control question-mark" id="mark">

                                </div>
                            </div>
                        </div>


                    </div>

                </div>

             

                <span class="remove btn btn-danger btn-next-to " style="height: 40px; width: 40px; float: right;"> 
                    <i class="fas fa-times"></i> 
                </span>
                
                <hr class="new3 !important">
            </div>
            

            

        `);
            // $(function() {
            //     $('.summernote').summernote()
            // });

            $(document).ready(function() {
                $('.summernote').summernote({
                    // set editor height
                    height: 100, // set editor height
                    minHeight: 100, // set minimum height of editor
                    // maxHeight: 500,
                    disableResizeEditor: false
                });
            });





            $('.optionBox').on('click', '.remove', function() {
                $(this).parent().remove();
            });

        });



        // $(document).on('click', '.purchase-remove-btn', function() {
        //     $(this).closest('tr').remove();
        // });
    </script>
@endsection
