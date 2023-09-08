<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesCourseTitleController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $courses =  CourseTitle::where('branch_id', $id)->orderBy('id', 'desc')->get();
        return view('branch.branch-panel.home.course.index', compact('courses'));
    }
    //End Method


    public function addCourse()
    {
        $id = Auth::guard('branch')->user()->id;
        $categories = CourseCategory::where('status', 1)->where('branch_id', $id)->get();
        return view('branch.branch-panel.home.course.add', compact('categories'));
    }
    //End Method


    public function store(Request $request)
    {
        $course = new CourseTitle();
        $course->category_id            =  $request->input('category_id');
        $course->branch_id =  Auth::guard('branch')->user()->id;
        $course->title                  =  $request->input('title');

        $course->price                  =  $request->input('price');
        $course->offer_price            =  $request->input('offer_price');
        $course->status                 =  $request->input('status');
        $course->video_duration         =  $request->input('video_duration');
        $course->total_video            =  $request->input('total_video');
        $course->course_link            =  $request->input('course_link');
        $course->course_type            =  $request->input('course_type');
        $course->course_detail          =  $request->input('course_detail');
        $course->meta_keyword           =  $request->input('meta_keyword');
        $course->meta_description       =  $request->input('meta_description');
        $course->day                    =  $request->input('day'); 
        $course->subject_list           =  $request->input('subject_list');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/course/', $filename);
            $course->image = $filename;
        }
        $course->save();
        return redirect('branches/course-index')->with('message', 'Our course info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $branch_id = Auth::guard('branch')->user()->id;
        $categories = CourseCategory::where('status', 1)->where('branch_id', $branch_id)->get();
        $course = CourseTitle::find($id);
        return view('branch.branch-panel.home.course.edit', compact('course', 'categories'));
    } //End Method

    public function detail($id)
    {
        $branch_id = Auth::guard('branch')->user()->id;
        $categories = CourseCategory::where('status', 1)->where('branch_id', $branch_id)->get();
        $course = CourseTitle::find($id);
        return view('branch.branch-panel.home.course.edit', compact('course', 'categories'));
    } //End Method




    public function update(Request $request, $id)
    {
        $course = CourseTitle::find($id);

        $course->category_id            =  $request->input('category_id');
        $course->branch_id              =  Auth::guard('branch')->user()->id;
        $course->title                  =  $request->input('title');

        $course->price                  =  $request->input('price');
        $course->offer_price            =  $request->input('offer_price');
        $course->status                 =  $request->input('status');
        $course->video_duration         =  $request->input('video_duration');
        $course->total_video            =  $request->input('total_video');
        $course->course_link            =  $request->input('course_link');
        $course->course_type            =  $request->input('course_type');
        $course->course_detail          =  $request->input('course_detail');
        $course->meta_keyword           =  $request->input('meta_keyword');
        $course->meta_description       =  $request->input('meta_description');

        $course->day                    =  $request->input('day'); 
        $course->subject_list           =  $request->input('subject_list');

        if ($request->hasFile('image')) {
            $destination = 'frontend/course/' . $course->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/course/', $filename);
            $course->image = $filename;
        }

        $course->save();
        return redirect('branches/course-index')->with('message', ' Our course info Update successfully');
    }

    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', CourseTitle::updateCourseStatus($id));
    }




    public function destroy($id)
    {
        $course = CourseTitle::find($id);
        $course->delete();
        return redirect('branches/course-index')->with('message', 'Course info Delete Successfully');
    }
}
