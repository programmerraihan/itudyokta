<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use Illuminate\Http\Request;

use App\Models\OurAchievement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesOurAchievementController extends Controller
{
    public function index()
    {

        $id = Auth::guard('branch')->user()->id;
        $achievements =  OurAchievement::where('branch_id', $id)->get();

      //  $achievements = OurAchievement::all();
        return view('branch.branch-panel.home.achievement.index', compact('achievements'));
    }
    //End Method


    public function addAchievement()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.achievement.add');
    }
    //End Method


    public function store(Request $request)
    {
        // return $request->all();
        $achievement = new OurAchievement();
        $achievement->branch_id =  Auth::guard('branch')->user()->id;

        $achievement->student              =  $request->input('student');

        $achievement->instructor           =  $request->input('instructor');
        $achievement->tutorial           =  $request->input('tutorial');
        $achievement->employee           =  $request->input('employee');

        $achievement->status               =  $request->input('status');


        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extension;
        //     $file->move('frontend/achievement/', $filename);
        //     $achievement->image = $filename;
        // }
        $achievement->save();
        return redirect('branches/achievement-index')->with('message', 'Our Achievement info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $achievement = OurAchievement::find($id);
        return view('branch.branch-panel.home.achievement.edit', compact('achievement'));
    } //End Method



    public function update(Request $request, $id)
    {

        $achievement = OurAchievement::find($id);


        $achievement->student              =  $request->input('student');
        $achievement->branch_id =  Auth::guard('branch')->user()->id;

        $achievement->instructor           =  $request->input('instructor');
        $achievement->tutorial           =  $request->input('tutorial');
        $achievement->employee           =  $request->input('employee');

        $achievement->status               =  $request->input('status');


        $achievement->save();
        return redirect('branches/achievement-index')->with('message', ' Achievement info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', OurAchievement::updateAchievementStatus($id));
    }


    public function destroy($id)
    {
        $this->achievement = OurAchievement::find($id);
        // dd($this->project);
        $this->achievement->delete();
        return redirect('branches/achievement-index')->with('message', 'Achievement info Delete Successfully');
    }
}
