<?php

namespace App\Http\Controllers\BranchPanel\Frontend;
use File;
use App\Models\Testimonial;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesTestimonialStudentController extends Controller
{
    public function index()
    {

        
        $id = Auth::guard('branch')->user()->id;
        $testimonials =  Testimonial::where('branch_id', $id)->get();

        // $testimonials = Testimonial::all();
        return view('branch.branch-panel.home.testimonial.index', compact('testimonials'));
    }
    //End Method


    public function addTestimonial()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.testimonial.add');
    }
    //End Method


    public function store(Request $request)
    {
        // return $request->all();
        $testimonial = new Testimonial();

        $testimonial->branch_id =  Auth::guard('branch')->user()->id;

        $testimonial->title              =  $request->input('title');
        $testimonial->status             =  $request->input('status');
        $testimonial->sort_title        =  $request->input('sort_title');


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/testimonial/', $filename);
            $testimonial->image = $filename;
        }

        
        if ($request->hasFile('student_image')) {
            $file = $request->file('student_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/student_image/', $filename);
            $testimonial->student_image = $filename;
        }
        $testimonial->save();
        return redirect('branches/testimonial-index')->with('message', 'Our Testimonial info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('branch.branch-panel.home.testimonial.edit', compact('testimonial'));
    } //End Method



    public function update(Request $request, $id)
    {

        $testimonial = Testimonial::find($id);
        $testimonial->branch_id =  Auth::guard('branch')->user()->id;
        $testimonial->title              =  $request->input('title');
        $testimonial->status             =  $request->input('status');
        $testimonial->sort_title        =  $request->input('sort_title');


        if ($request->hasFile('image')) {
            $destination = 'frontend/testimonial/' . $testimonial->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/testimonial/', $filename);
            $testimonial->image = $filename;
        }

        if ($request->hasFile('student_image')) {
            $destination = 'frontend/student_image/' . $testimonial->student_image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('student_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/student_image/', $filename);
            $testimonial->student_image = $filename;
        }

        $testimonial->save();
        return redirect('branches/testimonial-index')->with('message', ' Testimonial info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Testimonial::updateTestimonialStatus($id));
    }


    public function destroy($id)
    {
        $this->testimonial = Testimonial::find($id);
        // dd($this->project);
        $this->testimonial->delete();
        return redirect('branches/testimonial-index')->with('message', 'Testimonial info Delete Successfully');
    }
}
