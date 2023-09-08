<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\RegistrationCenter;
use App\Http\Controllers\Controller;

use File;

class RegistrationCenterController extends Controller
{
    public function index()
    {

        $centers = RegistrationCenter::all();
        return view('admin.frontend.home.center.index', compact('centers'));
    }
    //End Method


    public function addCenter()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.frontend.home.center.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $center = new RegistrationCenter();

        $center->title              =  $request->input('title');
        $center->status             =  $request->input('status');
        $center->description        =  $request->input('description');


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/center/', $filename);
            $center->image = $filename;
        }
        $center->save();
        return redirect('/center-index')->with('message', 'Our center info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $center = RegistrationCenter::find($id);
        return view('admin.frontend.home.center.edit', compact('center'));
    } //End Method



    public function update(Request $request, $id)
    {

        $center = RegistrationCenter::find($id);

        $center->title              =  $request->input('title');
        $center->status             =  $request->input('status');
        $center->description        =  $request->input('description');


        if ($request->hasFile('image')) {
            $destination = 'frontend/center/' . $center->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/center/', $filename);
            $center->image = $filename;
        }

        $center->save();
        return redirect('/center-index')->with('message', ' Center info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', RegistrationCenter::updateCenterStatus($id));
    }


    public function destroy($id)
    {
        $this->center = RegistrationCenter::find($id);
        // dd($this->project);
        $this->center->delete();
        return redirect('/center-index')->with('message', 'Center info Delete Successfully');
    }
}
