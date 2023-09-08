<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use File;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::all();
        return view('admin.frontend.home.category-course.index', compact('categories'));
    }
    //End Method


    public function addCategory()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.frontend.home.category-course.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $category = new CourseCategory();

        $category->title              =  $request->input('title');
        $category->status             =  $request->input('status');



        $category->save();
        return redirect('/category-index')->with('message', 'category info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $category = CourseCategory::find($id);
        return view('admin.frontend.home.category-course.edit', compact('category'));
    } //End Method



    public function update(Request $request, $id)
    {

        $category = CourseCategory::find($id);
        $category->title              =  $request->input('title');
        $category->status             =  $request->input('status');


        $category->save();
        return redirect('/category-index')->with('message', ' category info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', CourseCategory::updateCategoryStatus($id));
    }


    public function destroy($id)
    {
        $this->category = CourseCategory::find($id);
        // dd($this->project);
        $this->category->delete();
        return redirect('/category-index')->with('message', 'Category info Delete Successfully');
    }
}
