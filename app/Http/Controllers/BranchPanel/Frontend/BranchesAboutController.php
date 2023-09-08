<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use App\Models\About;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesAboutController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $about_pages =  About::where('branch_id', $id)->get();

        //$about_pages = About::all();
        return view('branch.branch-panel.home.about.index', compact('about_pages'));
    }
    //End Method


    public function addAbout()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.about.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $about = new About();
        $about->branch_id =  Auth::guard('branch')->user()->id;
        $about->title              =  $request->input('title');
        $about->status             =  $request->input('status');
        $about->description        =  $request->input('description');
        $about->long_text        =  $request->input('long_text');


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/about/', $filename);
            $about->image = $filename;
        }
        $about->save();
        return redirect('branches/about-index')->with('message', 'Our about info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $about = About::find($id);
        return view('branch.branch-panel.home.about.edit', compact('about'));
    } //End Method



    public function update(Request $request, $id)
    {

        $about = About::find($id);
        $about->branch_id =  Auth::guard('branch')->user()->id;

        $about->title              =  $request->input('title');
        $about->title              =  $request->input('title');
        $about->status             =  $request->input('status');
        $about->description        =  $request->input('description');
        $about->long_text        =  $request->input('long_text');


        if ($request->hasFile('image')) {
            $destination = 'frontend/about/' . $about->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/about/', $filename);
            $about->image = $filename;
        }

        $about->save();
        return redirect('branches/about-index')->with('message', ' Our service info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', About::updateAboutStatus($id));
    }


    public function destroy($id)
    {
        $this->about = About::find($id);

        $this->about->delete();
        return redirect('branches/about-index')->with('message', 'About info Delete Successfully');
    }
}
