<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\notify;

class BranchesGalleryStudentController extends Controller
{
    public function index()
    {

        $id = Auth::guard('branch')->user()->id;
        $galleries =  Gallery::where('branch_id', $id)->get();

        return view('branch.branch-panel.home.gallery.index', compact('galleries'));
    }
    //End Method


    public function addGallery()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.gallery.add');
    }
    //End Method


    public function store(Request $request)
    {
        // return $request->all();


        try {
            foreach ($request->gi as $key => $gi) {
                if (!$gi['image']) {
                    return redirect()->back();
                }

                $imageName = $this->upload_image_file($gi['image'], 'frontend/gallery/', "gallery");

                $id =  Auth::guard('branch')->user()->id;

                Gallery::create([
                    'image' => $imageName,
                    'title'   => $gi['title'],
                    'branch_id'   => $id,
                ]);
            }
            return redirect('branches/gallery-index')->with('message', 'Our project info create successfully');
        } catch (\Exception $exception) {

            return $exception->getMessage();
        }
    }
    //End Method



    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('branch.branch-panel.home.gallery.edit', compact('gallery'));
    } //End Method



    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Gallery::updateGalleryStatus($id));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            $gallery = Gallery::find($id);

            if ($request->hasFile('image')) {
                $path = public_path() . "frontend/gallery/" . $gallery->image;

                if (file_exists($path)) {
                    unlink($path);
                }

                $id =  Auth::guard('branch')->user()->id;
                $file = $request->file('image');
                $imageName = $this->upload_image_file($file, 'frontend/gallery/', "gallery");
                $gallery->update([
                    'image' => $imageName,
                    'title' => $request->input('title'),
                    'branch_id'   => $id,
                ]);
            } else {
                $gallery->update([
                    'title' => $request->input('title'),
                ]);
            }

            $gallery->save();


            return redirect('branches/gallery-index')->with('message', 'Our gallery info create successfully');
        } catch (\Exception $exception) {
            // dd($exception);

            return $exception->getMessage();
        }
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();

        return redirect()->back()->with('message', 'gallery info Delete Successfully');
    }
}
