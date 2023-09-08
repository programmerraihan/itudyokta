<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use App\Models\Director;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesDirectorController extends Controller
{

    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $directors =  Director::where('branch_id', $id)->get();
       // $directors = Director::all();
        return view('branch.branch-panel.home.director.index', compact('directors'));
    }
    //End Method


    public function addDirector()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.director.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $director = new Director();
        $director->branch_id =  Auth::guard('branch')->user()->id;

        $director->title              =  $request->input('title');
        $director->name              =  $request->input('name');

        $director->designation              =  $request->input('designation');
        $director->director_type              =  $request->input('director_type');
        $director->address              =  $request->input('address');
        $director->status             =  $request->input('status');



        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/director/', $filename);
            $director->image = $filename;
        }
        $director->save();
        return redirect('branches/director-index')->with('message', 'Our director info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $director = Director::find($id);
        return view('branch.branch-panel.home.director.edit', compact('director'));
    } //End Method
    public function update(Request $request, $id)
    {
        $director = Director::find($id);
        $director->branch_id =  Auth::guard('branch')->user()->id;
        $director->title              =  $request->input('title');
        $director->name              =  $request->input('name');

        $director->designation              =  $request->input('designation');
        $director->director_type              =  $request->input('director_type');
        $director->address              =  $request->input('address');
        $director->status             =  $request->input('status');


        if ($request->hasFile('image')) {
            $destination = 'frontend/director/' . $director->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/director/', $filename);
            $director->image = $filename;
        }

        $director->save();
        return redirect('branches/director-index')->with('message', ' Our service info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Director::updateDirectorStatus($id));
    }


    public function destroy($id)
    {
        $this->director = Director::find($id);
        // dd($this->director);
        $this->director->delete();
        return redirect('branches/director-index')->with('message', 'director info Delete Successfully');
    }
}
