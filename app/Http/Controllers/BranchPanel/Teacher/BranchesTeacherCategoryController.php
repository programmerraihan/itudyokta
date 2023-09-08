<?php

namespace App\Http\Controllers\BranchPanel\Teacher;

use Illuminate\Http\Request;
use App\Models\TeacherCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesTeacherCategoryController extends Controller
{

    public function index()
    {

        $id = Auth::guard('branch')->user()->id;
        $categories =  TeacherCategory::where('branch_id', $id)->get();

        // $categories = TeacherCategory::all();
        return view('branch.branch-panel.teacher.category.index', compact('categories'));
    }
    //End Method


    public function addCategory()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.teacher.category.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $category = new TeacherCategory();
        $category->branch_id =  Auth::guard('branch')->user()->id;
        $category->name              =  $request->input('name');
        $category->status             =  $request->input('status');

        $category->save();
        return redirect('branches/teacher-category-index')->with('message', 'Teacher Category info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $category = TeacherCategory::find($id);
        return view('branch.branch-panel.teacher.category.edit', compact('category'));
    } //End Method



    public function update(Request $request, $id)
    {
        $category = TeacherCategory::find($id);
        $category->branch_id        =  Auth::guard('branch')->user()->id;
        $category->name               =  $request->input('name');
        $category->status             =  $request->input('status');

        $category->save();
        return redirect('branches/teacher-category-index')->with('message', ' Teacher Category info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', TeacherCategory::updateTeacherCategoryStatus($id));
    }


    public function destroy($id)
    {
        $this->category = TeacherCategory::find($id);
        // dd($this->project);
        $this->category->delete();
        return redirect('branches/teacher-category-index')->with('message', 'Teacher Category info Delete Successfully');
    }
}
