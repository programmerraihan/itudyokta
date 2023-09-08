<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.purchase.supplier.manage', ['suppliers' => Supplier::all()]);
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
        return view('admin.purchase.supplier.edit', ['supplier' => Supplier::find($id), 'suppliers' => Supplier::all()]);
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
        return redirect('supplier')->with('message', 'Supplier info Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { {
            $this->supplier = Supplier::find($id);
            $this->supplier->delete();
            return redirect('supplier')->with('message', 'Unit info Delete Successfully');
        }
    }
}
