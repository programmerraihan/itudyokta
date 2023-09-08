<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;

class AboutController extends Controller
{
    public function index()
    {

        $about_pages = About::all();
        return view('admin.frontend.about.index', compact('about_pages'));
    }
    //End Method


    public function addAbout()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.frontend.about.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $about = new About();

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
        return redirect('/about-index')->with('message', 'Our about info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $about = About::find($id);
        return view('admin.frontend.about.edit', compact('about'));
    } //End Method



    public function update(Request $request, $id)
    {

        $about = About::find($id);

        $about->title              =  $request->input('title');
        $about->status             =  $request->input('status');
        $about->description        =  $request->input('description');


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
        return redirect('/about-index')->with('message', ' Our service info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', About::updateAboutStatus($id));
    }


    public function destroy($id)
    {
        $this->about = About::find($id);

        $this->about->delete();
        return redirect('/about-index')->with('message', 'About info Delete Successfully');
    }
}
