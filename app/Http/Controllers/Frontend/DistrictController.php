<?php

namespace App\Http\Controllers\Frontend;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Division;

class DistrictController extends Controller
{
    public function index()
    {
        
        $districts = District::all();
        return view('admin.frontend.home.district.index', compact('districts'));
    }
    //End Method


    public function addDistrict()
    {

        $divisions = Division::where('status', 1)->get();
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.frontend.home.district.add', compact('divisions'));
    }
    //End Method


    public function store(Request $request)
    {
      // return $request->all();
        $district = new District();
        $district->division_id              =  $request->input('division_id');
        $district->name                     =  $request->input('name');
        $district->status                   =  $request->input('status');
        $district->save();
        return redirect('/district-index')->with('message', 'Our District info create successfully');
    }
    //End Method

    public function edit($id)
    {
        
        $divisions = Division::where('status', 1)->get();
        $district = District::find($id);
        return view('admin.frontend.home.district.edit', compact('district', 'divisions'));
    } //End Method



    public function update(Request $request, $id)
    {

        $district = District::find($id);
        $district->division_id              =  $request->input('division_id');
        $district->name              =  $request->input('name');
        $district->status             =  $request->input('status');

        $district->save();
        return redirect('/district-index')->with('message', ' Our District info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', District::updateDistrictStatus($id));
    }

    public function destroy($id)
    {
        $this->district = District::find($id);
       
        $this->district->delete();
        return redirect('/district-index')->with('message', 'district info Delete Successfully');
    }

}
