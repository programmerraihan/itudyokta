<?php

namespace App\Http\Controllers\Frontend;

use File; // For File
use App\Models\Branch;
use App\Models\HomeSlide;
use Storage; // For Storage
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeSliderController extends Controller
{
    public static $File;


    public function homeSlider()
    {
        // $homeSlidData = HomeSlide::find(1);

        $sliders = HomeSlide::all();
        return view('admin.frontend.home.home_slide', compact('sliders'));
    }
    //End Method


    public function addSlider()
    {
        // $homeSlidData = HomeSlide::find(1);
        // $branches = Branch::where('status',1)->get();
        return view('admin.frontend.home.add');
    }
    //End Method

    public function store(Request $request)
    {

        // //  return $request->all();


        $slider = new HomeSlide;
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
        return redirect('/home-slide')->with('message', 'Home Slide info create successfully');
        // // $homeSlidData = HomeSlide::find(1);
        // return view('admin.frontend.home.add');

        // $this->slide = HomeSlide::newHomeSlide($request);

    }
    //End Method

    public function updateStatus($id)
    {
        return redirect()->back()->with(HomeSlide::updateStatus($id));
    } //End Method

    public function edit($id)
    {
        $slider = HomeSlide::find($id);
        return view('admin.frontend.home.edit', compact('slider'));
    } //End Method



    public function update(Request $request, $id)
    {

        $slider = HomeSlide::find($id);
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
        return redirect('/home-slide')->with('message', 'Home Slide info Update successfully');
    }


    // public function delete(Request $request, $id)
    // {

    //     $this->slide = HomeSlide::find($id);
    //     $this->slide->delete();
    //     // return redirect('color')->with('message', 'Color info delete successfully.');

    //     // HomeSlide::deleteSlider($id);
    //     return redirect('/home-slide')->with('message', 'Home Slide info Delete successfully');
    // }

    //End Method



}
