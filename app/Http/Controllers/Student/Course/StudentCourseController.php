<?php

namespace App\Http\Controllers\Student\Course;

use App\Models\Student;
use App\Models\Enrollment;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function index()
    {
        $id = Auth::guard('student')->user()->id;
        // dd($id);
        $courses = Enrollment::where('student_id', $id)->with('course_title')->get(['course_title_id']);

        // dd($student_id);
        // $courses = CourseTitle::all();
        // dd($courses);

        // $student_id = Enrollment::where('student_id', $id)->get(['course_title_id']);

        // $questions = AssessmentQuestionMaster::orderBy('id', 'DESC')
        //     ->whereIn('exam_id',  function ($query) use ($student_id) {
        //         $query->select('id')
        //             ->from(with(new AssessmentExam)->getTable())
        //             ->whereIn('course_title_id', $student_id);
        //     })
        //     ->with('assessment_exam')
        //     ->get();

        // $course = CourseTitle::orderBy('id', 'DESC')
        //     ->whereIn('exam_id',  function ($query) use ($student_id) {
        //         $query->select('id')
        //             ->from(with(new CourseTitle)->getTable())
        //             ->whereIn('course_title_id', $student_id);
        //     })
        //     ->with('assessment_exam')
        //     ->get();
        // dd($course);


        return view('student.student.course.index', compact('courses'));
    }


    public function studentCourse($id)
    {
        $course = CourseTitle::where('status', 1)->where('id', $id)->first();
        return view('student.student.course.course_details', compact('course'));
    } //end function

}
