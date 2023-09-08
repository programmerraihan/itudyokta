<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesCityController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $citys =  City::where('branch_id', $id)->get();
        // $citys = City::all();
        return view('branch.branch-panel.home.city.index', compact('citys'));
    }
    //End Method


    public function addCity()
    {

        $districts = District::where('status', 1)->get();
       // dd( $districts);
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.city.add', compact('districts'));
    }
    //End Method


    public function store(Request $request)
    {
      // return $request->all();
        $city = new City();
        $city->branch_id =  Auth::guard('branch')->user()->id;
        $city->district_id              =  $request->input('district_id');
        $city->name                     =  $request->input('name');
        $city->status                   =  $request->input('status');
        $city->save();
        return redirect('branches/city-index')->with('message', 'Our city info create successfully');
    }
    //End Method

    public function edit($id)
    {
        
        $districts = District::where('status', 1)->get();
        $city = City::find($id);
        return view('branch.branch-panel.home.city.edit', compact('city', 'districts'));
    } //End Method



    public function update(Request $request, $id)
    {

        $city = City::find($id);
        $city->branch_id =  Auth::guard('branch')->user()->id;
        $city->district_id              =  $request->input('district_id');
        $city->name              =  $request->input('name');
        $city->status             =  $request->input('status');

        $city->save();
        return redirect('branches/city-index')->with('message', ' Our City info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', City::updateCityStatus($id));
    }

    public function destroy($id)
    {
        $this->city = City::find($id);
       
        $this->city->delete();
        return redirect('branches/city-index')->with('message', 'City info Delete Successfully');
    }
}
