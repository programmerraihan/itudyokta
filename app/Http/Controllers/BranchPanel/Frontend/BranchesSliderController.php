<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use App\Models\HomeSlide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use File;

class BranchesSliderController extends Controller
{
    public function branchAddSlider()
    {
        return view('branch.branch-panel.home.slide.add');
    }

    public function store(Request $request)
    {
        $slider = new HomeSlide;
        $slider->branch_id =  Auth::guard('branch')->user()->id;

        $slider->title  =  $request->input('title');
        $slider->short_title  =  $request->input('short_title');
        $slider->video_url  =  $request->input('video_url');
        $slider->link_image  =  $request->input('link_image');
        $slider->status  =  $request->input('status') == true ? '1' : '0';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/slider/', $filename);
            $slider->image = $filename;
        }

        $slider->save();
        return redirect('branches/add-slide')->with('message', 'Home Slide info create successfully');
    }

    public function homeSlide()
    {

        $id = Auth::guard('branch')->user()->id;
        $sliders =  HomeSlide::where('branch_id', $id)->get();

        return view('branch.branch-panel.home.slide.home_slide', compact('sliders'));
    }
    //End Method


    public function updateStatus($id)
    {
        return redirect()->back()->with(HomeSlide::updateStatus($id));
    } //End Method

    public function edit($id)
    {
        $slider = HomeSlide::find($id);
        return view('branch.branch-panel.home.slide.edit', compact('slider'));
    } //End Method



    public function update(Request $request, $id)
    {
        // return $request->all();

        $slider = HomeSlide::find($id);

        $slider->branch_id =  Auth::guard('branch')->user()->id;
        $slider->title  =  $request->input('title');
        $slider->short_title  =  $request->input('short_title');
        $slider->video_url  =  $request->input('video_url');
        $slider->link_image  =  $request->input('link_image');
        $slider->status  =  $request->input('status') == true ? '1' : '0';

        if ($request->hasFile('image')) {
            $destination = 'frontend/slider/' . $slider->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/slider/', $filename);
            $slider->image = $filename;
        }

        $slider->save();
        return redirect('/branches/index-slide')->with('message', 'Home Slide info Update successfully');
    }
}
