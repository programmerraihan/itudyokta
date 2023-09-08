<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OurSpeech;
use Illuminate\Http\Request;
use File;

class OurSpeechController extends Controller
{
    public function index()
    {
        // $homeSlidData = HomeSlide::find(1);

        $speeches = OurSpeech::all();
        return view('admin.frontend.home.speech.index', compact('speeches'));
    }
    //End Method


    public function addSpeech()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.frontend.home.speech.add');
    }
    //End Method

    public function store(Request $request)
    {
        // return $request->all();
        $speech = new OurSpeech();
        $speech->title         =  $request->input('title');
        $speech->long_text     =  $request->input('long_text');
        $speech->sort_text     =  $request->input('sort_text');
        $speech->video_url     =  $request->input('video_url');
        $speech->link_image    =  $request->input('link_image');
        $speech->status        =  $request->input('status') == true ? '1' : '0';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/speech/', $filename);
            $speech->image = $filename;
        }
        $speech->save();
        return redirect('/speech-index')->with('message', 'Our Speech info create successfully');
    }
    //End Method



    public function edit($id)
    {
        $speech = OurSpeech::find($id);

        return view('admin.frontend.home.speech.edit', compact('speech'));
    } //End Method


    public function update(Request $request, $id)
    {
        // dd($request);
        $speech = OurSpeech::find($id);
        $speech->title  =  $request->input('title');
        $speech->sort_text  =  $request->input('sort_text');
        $speech->long_text  =  $request->input('long_text');
        $speech->video_url  =  $request->input('video_url');
        $speech->link_image  =  $request->input('link_image');
        $speech->status  =  $request->input('status') == true ? '1' : '0';

        if ($request->hasFile('image')) {
            $destination = 'frontend/speech/' . $speech->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/speech/', $filename);
            $speech->image = $filename;
        }

        $speech->save();
        return redirect('/speech-index')->with('message', ' Our speech info Update successfully');
    }
}
