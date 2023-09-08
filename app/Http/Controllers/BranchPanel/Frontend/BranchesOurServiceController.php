<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use App\Models\OurService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesOurServiceController extends Controller
{
    public function index()
    {

        $id = Auth::guard('branch')->user()->id;
        $services =  OurService::where('branch_id', $id)->get();

        // $services = OurService::all();
        return view('branch.branch-panel.home.service.index', compact('services'));
    }
    //End Method


    public function addService()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.service.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $service = new OurService();

        $service->branch_id =  Auth::guard('branch')->user()->id;

        $service->title              =  $request->input('title');
        $service->status             =  $request->input('status');
        $service->description        =  $request->input('description');

        $service->service_detail        =  $request->input('service_detail');
        $service->meta_keyword        =  $request->input('meta_keyword');
        $service->meta_description        =  $request->input('meta_description');


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/service/', $filename);
            $service->image = $filename;
        }
        $service->save();
        return redirect('branches/service-index')->with('message', 'Our service info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $service = OurService::find($id);
        return view('branch.branch-panel.home.service.edit', compact('service'));
    } //End Method



    public function update(Request $request, $id)
    {

        $service = OurService::find($id);

        $service->branch_id =  Auth::guard('branch')->user()->id;

        $service->title              =  $request->input('title');
        $service->status             =  $request->input('status');
        $service->description        =  $request->input('description');

        $service->service_detail        =  $request->input('service_detail');
        $service->meta_keyword          =  $request->input('meta_keyword');
        $service->meta_description      =  $request->input('meta_description');



        if ($request->hasFile('image')) {
            $destination = 'frontend/service/' . $service->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/service/', $filename);
            $service->image = $filename;
        }

        $service->save();
        return redirect('branches/service-index')->with('message', ' Our service info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', OurService::updateServiceStatus($id));
    }

    public function destroy($id)
    {
        $this->service = OurService::find($id);
        //dd($this->service);
        $this->service->delete();
        return redirect('branches/service-index')->with('message', 'service info Delete Successfully');
    }


   
}
