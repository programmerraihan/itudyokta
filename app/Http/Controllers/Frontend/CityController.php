<?php

namespace App\Http\Controllers\Frontend;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index()
    {
        
        $citys = City::all();
        return view('admin.frontend.home.city.index', compact('citys'));
    }
    //End Method


    public function addCity()
    {

        $districts = District::where('status', 1)->get();
       // dd( $districts);
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.frontend.home.city.add', compact('districts'));
    }
    //End Method


    public function store(Request $request)
    {
      // return $request->all();
        $city = new City();
        $city->district_id              =  $request->input('district_id');
        $city->name                     =  $request->input('name');
        $city->status                   =  $request->input('status');
        $city->save();
        return redirect('/city-index')->with('message', 'Our city info create successfully');
    }
    //End Method

    public function edit($id)
    {
        
        $districts = District::where('status', 1)->get();
        $city = City::find($id);
        return view('admin.frontend.home.city.edit', compact('city', 'districts'));
    } //End Method



    public function update(Request $request, $id)
    {

        $city = City::find($id);
        $city->district_id              =  $request->input('district_id');
        $city->name              =  $request->input('name');
        $city->status             =  $request->input('status');

        $city->save();
        return redirect('/city-index')->with('message', ' Our City info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', City::updateCityStatus($id));
    }

    public function destroy($id)
    {
        $this->city = City::find($id);
       
        $this->city->delete();
        return redirect('/city-index')->with('message', 'City info Delete Successfully');
    }
}
