<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Frontend\notify;

class GalleryStudentController extends Controller
{
    public function index()
    {

        $galleries = Gallery::all();
        return view('admin.frontend.home.gallery.index', compact('galleries'));
    }
    //End Method


    public function addGallery()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.frontend.home.gallery.add');
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

                Gallery::create([
                    'image' => $imageName,
                    'title'   => $gi['title'],
                ]);
            }
            return redirect('/gallery-index')->with('message', 'Our project info create successfully');
        } catch (\Exception $exception) {

            return $exception->getMessage();
        }
    }
    //End Method



    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('admin.frontend.home.gallery.edit', compact('gallery'));
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

                $file = $request->file('image');
                $imageName = $this->upload_image_file($file, 'frontend/gallery/', "gallery");
                $gallery->update([
                    'image' => $imageName,
                    'title' => $request->input('title'),
                ]);
            } else {
                $gallery->update([
                    'title' => $request->input('title'),
                ]);
            }

            $gallery->save();


            return redirect('/gallery-index')->with('message', 'Our gallery info create successfully');
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
