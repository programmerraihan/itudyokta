<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use App\Models\OurProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesOurProjectController extends Controller
{
    public function index()
    {

        $id = Auth::guard('branch')->user()->id;
        $projects =  OurProject::where('branch_id', $id)->get();
        // $projects = OurProject::all();
        return view('branch.branch-panel.home.project.index', compact('projects'));
    }
    //End Method


    public function addProject()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.project.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $project = new OurProject();
        $project->branch_id =  Auth::guard('branch')->user()->id;

        $project->title              =  $request->input('title');
        $project->status             =  $request->input('status');
        $project->description        =  $request->input('description');

        $project->project_detail        =  $request->input('project_detail');
        $project->meta_keyword          =  $request->input('meta_keyword');
        $project->meta_description      =  $request->input('meta_description');


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/project/', $filename);
            $project->image = $filename;
        }
        $project->save();
        return redirect('branches/project-index')->with('message', 'Our project info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $project = OurProject::find($id);
        return view('branch.branch-panel.home.project.edit', compact('project'));
    } //End Method



    public function update(Request $request, $id)
    {

        $project = OurProject::find($id);
        $project->branch_id =  Auth::guard('branch')->user()->id;

        $project->title              =  $request->input('title');
        $project->status             =  $request->input('status');
        $project->description        =  $request->input('description');

        $project->project_detail        =  $request->input('project_detail');
        $project->meta_keyword          =  $request->input('meta_keyword');
        $project->meta_description      =  $request->input('meta_description');


        if ($request->hasFile('image')) {
            $destination = 'frontend/project/' . $project->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/project/', $filename);
            $project->image = $filename;
        }

        $project->save();
        return redirect('branches/project-index')->with('message', ' Our service info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', OurProject::updateProjectStatus($id));
    }


    public function destroy($id)
    {
        $this->project = OurProject::find($id);
        // dd($this->project);
        $this->project->delete();
        return redirect('branches/project-index')->with('message', 'project info Delete Successfully');
    }
}
