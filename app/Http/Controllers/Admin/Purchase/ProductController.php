<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:product-update", ["only" => ["update", "edit"]]);
        $this->middleware("permission:product-create", ["only" => ["store"]]);
        $this->middleware("permission:product-delete", ["only" => ["destroy"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.purchase.product.manage', ['products' => Product::all()]);
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
        Product::newProduct($request);
        return redirect()->back()->with('message', 'Product  info create successfully');
    }

    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Product::updateProductStatus($id));
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
        return view('admin.purchase.product.edit', ['product' => Product::find($id), 'products' => Product::all()]);
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
        Product::updateProduct($request, $id);
        return redirect('product')->with('message', 'Product info Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { {
            $this->product = Product::find($id);
            $this->product->delete();
            return redirect('product')->with('message', 'Product info Delete Successfully');
        }
    }
}
