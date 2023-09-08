<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:purchase-unit-create", ["only" => ["store"]]);
        $this->middleware("permission:purchase-unit-delete", ["only" => ["destroy"]]);
        $this->middleware("permission:purchase-unit-update", ["only" => ["edit", "update"]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.purchase.unit.manage', ['units' => Unit::all()]);
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
        return view('admin.purchase.unit.edit', ['unit' => Unit::find($id), 'units' => Unit::all()]);
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
        return redirect('unit')->with('message', 'Unit info Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { {
            $this->unit = Unit::find($id);
            $this->unit->delete();
            return redirect('unit')->with('message', 'Unit info Delete Successfully');
        }
    }
}
