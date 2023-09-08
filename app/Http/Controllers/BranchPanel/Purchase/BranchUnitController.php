<?php

namespace App\Http\Controllers\BranchPanel\Purchase;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('branch.branch-panel.purchase.unit.manage', [
            $id = Auth::guard('branch')->user()->id,
            'units' =>  Unit::where('branch_id', $id)->get(),
            // 'units' => Unit::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Unit::newUnit($request);
        return redirect()->back()->with('message', 'Unit  info create successfully');
    }

    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Unit::updateUnitStatus($id));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('branch.branch-panel.purchase.unit.edit', ['unit' => Unit::find($id), 'units' => Unit::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Unit::updateUnit($request, $id);
        return redirect()->back()->with('message', 'Unit info Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->back()->with('message', 'Unit info Delete Successfully');
    }
}
