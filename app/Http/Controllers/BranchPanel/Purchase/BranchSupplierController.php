<?php

namespace App\Http\Controllers\BranchPanel\Purchase;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchSupplierController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;

        $suppliers =  Supplier::where('branch_id', $id)->get();

        return view('branch.branch-panel.purchase.supplier.manage', compact('suppliers'));
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
        Supplier::newSupplier($request);
        return redirect()->back()->with('message', 'Supplier  info create successfully');
    }

    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Supplier::updateSupplierStatus($id));
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

        return view('branch.branch-panel.purchase.supplier.edit', ['supplier' => Supplier::find($id), 'suppliers' => Supplier::all()]);
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
        Supplier::updateSupplier($request, $id);
        return redirect()->back()->with('message', 'Supplier info Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->back()->with('message', 'Unit info Delete Successfully');
    }
}
