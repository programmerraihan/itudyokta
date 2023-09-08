<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesCourseCategoryController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $categories =  CourseCategory::where('branch_id', $id)->get();
        return view('branch.branch-panel.home.category-course.index', compact('categories'));
    }
    //End Method


    public function addCategory()
    {
        return view('branch.branch-panel.home.category-course.add');
    }
    //End Method


    public function store(Request $request)
    {
        $category = new CourseCategory();
        $category->branch_id          =  Auth::guard('branch')->user()->id;
        $category->title              =  $request->input('title');
        $category->status             =  $request->input('status');
        $category->save();
        return redirect('branches/category-index')->with('message', 'category info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $category = CourseCategory::find($id);
        return view('branch.branch-panel.home.category-course.edit', compact('category'));
    } //End Method



    public function update(Request $request, $id)
    {

        $category = CourseCategory::find($id);
        $category->branch_id          =  Auth::guard('branch')->user()->id;
        $category->title              =  $request->input('title');
        $category->status             =  $request->input('status');


        $category->save();
        return redirect('branches/category-index')->with('message', ' category info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', CourseCategory::updateCategoryStatus($id));
    }


    public function destroy($id)
    {
        $category = CourseCategory::find($id);
        $category->delete();
        return redirect('branches/category-index')->with('message', 'Category info Delete Successfully');
    }
}
