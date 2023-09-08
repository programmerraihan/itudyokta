<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use App\Models\OurSpeech;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesOurSpeechController extends Controller
{
    public function index()
    {
        // $homeSlidData = HomeSlide::find(1);


        $id = Auth::guard('branch')->user()->id;
        $speeches =  OurSpeech::where('branch_id', $id)->get();

        //$speeches = OurSpeech::all();
        return view('branch.branch-panel.home.speech.index', compact('speeches'));
    }
    //End Method


    public function addSpeech()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.speech.add');
    }
    //End Method

    public function store(Request $request)
    {
        // return $request->all();
        $speech = new OurSpeech();
        $speech->branch_id     =  Auth::guard('branch')->user()->id;
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
        return redirect('branches/speech-index')->with('message', 'Our Speech info create successfully');
    }
    //End Method



    public function edit($id)
    {


        $speech = OurSpeech::find($id);
        return view('branch.branch-panel.home.speech.edit', compact('speech'));
    } //End Method


    public function update(Request $request, $id)
    {

        $speech = OurSpeech::find($id);
        $speech->branch_id =  Auth::guard('branch')->user()->id;
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
        return redirect('branches/speech-index')->with('message', ' Our speech info Update successfully');
    }
}
