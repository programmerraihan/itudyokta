@extends('branch.branch_master')

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
                        <h4 class="mb-0 font-size-18">Offline Exam</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Offline Examp</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('offline-exam.index') }}" class="btn btn-info">Offline Exam List</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('offline-exam.update', ['offline_exam' => $result->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card">
                            <div class="card-header bg-success">
                                <h4 class="card-title">Add New Offline Exam</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="student">Student*</label>
                                        <select name="student" id="student" class="form-control" required>
                                            <option value="" hidden>Select a Student</option>
                                            @forelse ($students as $student)
                                                <option value="{{ $student->id }}" @if($result->student_id == $student->id) selected @endif >{{ $student->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="course_title">Course Title*</label>
                                        <select name="course_title" id="course_title" class="form-control" required>
                                            <option value="" hidden>Select a Course Title</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-body" id="subject_list"> </div>
                                </div>
                            </div>
                        </div>
                        <div id="subject_mark_list">
                            @foreach ($marks as $key => $subject)
                            <?php
                                $id = substr(rand(), 0, 5);
                            ?>
                            <div id="box-{{$id}}" class="card">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <input type="text" name="subject[]" value="{{$key}}" class="form-control"
                                                placeholder="Subject Name*" readonly />
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <input type="number" step="any" value="{{$subject->mcq}}" min="0" name="mcq[]"
                                                class="number form-control" placeholder="MCQ*" required />
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <input type="number" step="any" value="{{$subject->assignment}}" min="0" name="assignment[]"
                                                class="number form-control" placeholder="Assignment*" required />
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <input type="number" step="any" value="{{$subject->viva}}" min="0" name="viva[]"
                                                class="number form-control" placeholder="Viva*" required />
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <input type="number" step="any" value="{{$subject->total}}" min="0" name="total[]"
                                                class="form-control total" placeholder="Total*" required />
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <input type="number" step="any" value="{{$subject->gpa}}" min="0" name="gpa[]"
                                                class="form-control gpa" placeholder="GPA*" required />
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <input type="text" name="grade[]" value="{{$subject->grade}}" class="form-control grade"
                                                placeholder="Grade*" required />
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <input type="file" accept=".pdf,.zip" name="attachment[]"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <button data-id="{{$id}}" type="button" class="btn btn-danger remove_box"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach                            
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <button type="button" id="add_new_mark" class="btn btn-success">Add New
                                            Mark</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="total">Total*</label>
                                                <input type="number" min="0" value="{{$result->total}}" step="any" name="total_"
                                                    placeholder="Total" class="form-control" required />
                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="gpa">CGPA*</label>
                                                <input type="number" min="0" value="{{$result->cgpa}}" step="any" name="cgpa"
                                                    placeholder="CGPA" class="form-control" required />
                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="grade">Grade*</label>
                                                <input type="text" name="grade_" value="{{$result->grade}}" placeholder="Grade*"
                                                    class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#student').select2({
                placeholder: "Select a Student"
            });

            $('#add_new_mark').click(function() {
                var id = Number(Math.random() * 1453).toFixed();
                let output = `<div id="box-${id}" class="card"><div class="card-body"><div class="form-row">
                                <div class="col-md-4 col-sm-12 form-group">
                                    <input type="text" name="subject[]" class="form-control" placeholder="Subject Name*" required/>
                                </div>
                                <div class="col-md-4 col-sm-12 form-group">
                                    <input type="number" step="any" min="0" name="mcq[]" class="number form-control" placeholder="MCQ*" required/>
                                </div>
                                <div class="col-md-4 col-sm-12 form-group">
                                    <input type="number" step="any" min="0" name="assignment[]" class="number form-control" placeholder="Assignment*" required/>
                                </div>
                                <div class="col-md-4 col-sm-12 form-group">
                                    <input type="number" step="any" min="0" name="viva[]" class="number form-control" placeholder="Viva*" required/>
                                </div>
                                <div class="col-md-4 col-sm-12 form-group">
                                    <input type="number" step="any" min="0" name="total[]" class="form-control total" placeholder="Total*" required/>
                                </div>
                                <div class="col-md-4 col-sm-12 form-group">
                                    <input type="number" step="any" min="0" name="gpa[]" class="form-control gpa" placeholder="GPA*" required/>
                                </div>
                                <div class="col-md-4 col-sm-12 form-group">
                                    <input type="text" name="grade[]" class="form-control grade" placeholder="Grade*" required/>
                                </div>
                                <div class="col-md-4 col-sm-12 form-group">
                                    <input type="file" accept=".pdf,.zip" name="attachment[]" class="form-control" />
                                </div>
                                <div class="col-md-4 col-sm-12 form-group">
                                    <button data-id="${id}" type="button" class="btn btn-danger remove_box"><i class="fa fa-trash"></i></button>
                                </div>
                            </div></div></div>`;
                $('#subject_mark_list').append(output);
            });

            $(document).on('click', '.remove_box', function() {
                let id = $(this).data('id');
                $('#box-' + id).remove();
            })

            $('#course_title').select2({});

            var students = @json($students);

            $('#student').on("change", function() {
                var student_id = $(this).val();
                var student = students.find(function(student) {
                    if (student.id == student_id) {
                        return student;
                    }
                });
                var output = []
                student.enrollment.map(function(enrollment) {
                    output.push({
                        id: enrollment.id,
                        text: enrollment.course_title.title
                    });
                });
                $('#course_title').html(null).select2({
                    data: output,
                    placeholder: "Select a Course Title"
                }).val(null).trigger('change');
            });

            $('#course_title').change(function() {
                let student_id = $('#student').val();
                var enrollment_id = $(this).val();
                let student = students.find(function(student) {
                    if (student.id == student_id) {
                        return student;
                    }
                });

                let enrollment = student.enrollment.find(function(enrollment) {
                    if (enrollment.id == enrollment_id) {
                        return enrollment;
                    }
                });

                if (enrollment) {
                    $('#subject_list').html(enrollment.course_title.subject_list);
                }
            })

            $('#student').trigger('change');
            $('#course_title').val('{{$result->enrollment_id}}').trigger('change');
            $(document).on("input", '.number', function() {
                let card = $(this).closest('.card');
                let mcq = +$(card).find('input[name="mcq[]"]').val();
                let viva = +$(card).find('input[name="viva[]"]').val();
                let assignment = +$(card).find('input[name="assignment[]"]').val();
                let total = +(mcq + viva + assignment);
                $($(card).find('input[name="total[]"]')).val(total);
                let gpa = '0';
                let grade = 'F';
                if (total >= 80 && total <= 100) {
                    grade = 'A+';
                    gpa = 5;
                }
                if (total >= 70 && total <= 79) {
                    grade = 'A';
                    gpa = 4.5;
                }
                if (total >= 60 && total <= 69) {
                    grade = 'A-';
                    gpa = 4;
                }
                if (total >= 50 && total <= 59) {
                    grade = 'B';
                    gpa = 3.5;
                }
                if (total >= 40 && total <= 49) {
                    grade = 'C';
                    gpa = 3;
                }
                if (total >= 33 && total <= 39) {
                    grade = 'D';
                    gpa = 2;
                }
                $(card).find('input[name="gpa[]"]').val(gpa);
                $(card).find('input[name="grade[]"]').val(grade);

                var totalSum = 0;
                var totalGpa = 0;
                var totalGrade = '';
                var totalsub = 0;
                $(document).find('.total').each(function(index, elem) {
                    totalSum += +($(elem).val() ?? 0);
                });

                $(document).find('.gpa').each(function(index, elem) {
                    totalGpa += +($(elem).val() ?? 0);
                    totalsub++;
                });

                var cgpa = Number(totalGpa / totalsub).toFixed(2);

                if (cgpa == 5) {
                    totalGrade = 'A+';
                }

                if (cgpa >= 4.50 && cgpa < 5) {
                    totalGrade = 'A';
                }

                if (cgpa >= 4 && cgpa < 4.50) {
                    totalGrade = 'A-';
                }

                if (cgpa >= 3 && cgpa < 4) {
                    totalGrade = 'B';
                }

                if (cgpa >= 2 && cgpa < 3) {
                    totalGrade = 'C';
                }

                if (cgpa == 2) {
                    totalGrade = 'D';
                }

                if (cgpa < 2) {
                    totalGrade = 'F';
                }

                $('input[name="total_"]').val(totalSum);
                $('input[name="cgpa"]').val(cgpa);
                $('input[name="grade_"]').val(totalGrade);

            });

        });
    </script>
@endpush
