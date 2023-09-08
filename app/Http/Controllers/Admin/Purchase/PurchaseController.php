<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function add()
    {

        return view('admin.purchase.purchase.manage', [
            'units'          => Unit::orderBy('id', 'desc')->get(),
            'products'       => Product::where('status', 1)->get(),
            'suppliers'      => Supplier::where('status', 1)->get(),
        ]);
    }

    public function getAllPurchaseData()
    {

        return response()->json([
            'units'         => Unit::orderBy('id', 'desc')->get(),
            'products'      => Product::where('status', 1)->get(),
            'suppliers'     => Supplier::where('status', 1)->get(),
        ]);
    }



    public function create(Request $request)
    {
        // return $request->all();
        try {
            $purchase = new Purchase();
            $purchase->challan_number         = $request->challan_number;
            $purchase->phone_number           = $request->phone_number;
            $purchase->recipient_name         = $request->recipient_name;
            $purchase->purchase_date          = $request->purchase_date;
            $purchase->note                   = $request->note;
            $purchase->created_by             = Auth::user()->id;
            $purchase->save();

            foreach ($request->purch as $item) {

                $purchaseItem = new PurchaseItem();
                $purchaseItem->purchase_id       = $purchase->id;
                $purchaseItem->supplier          = $item['supplier'];
                $purchaseItem->product           = $item['product'];
                $purchaseItem->unit              = $item['unit'];
                $purchaseItem->unit_price        = $item['unit_price'];
                $purchaseItem->quantity          = $item['quantity'];
                $purchaseItem->total_price       = $item['total_price'];
                $purchaseItem->save();
            }
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
        return redirect()->back()->with('message', ' Purchase  create   successfully');
    }



    public function manage()
    {
        return view('admin.purchase.purchase.show', ['purchases' => Purchase::orderBy('id', 'desc')->take('1000')->get(['id', 'challan_number', 'recipient_name', 'purchase_date'])]);
    }

    public function detail($id)
    {
        return view('admin.purchase.purchase.detail', ['purchase' => Purchase::find($id)]);
    }


    public function edit($id)
    {
        return view('admin.purchase.purchase.edit', [
            'purchase'      => Purchase::find($id),
            'units'         => Unit::orderBy('id', 'desc')->get(),
            'products'      => Product::where('status', 1)->get(),
            'suppliers'     => Supplier::where('status', 1)->get(),
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $purchase = Purchase::find($id);
            $purchase->challan_number         = $request->challan_number;
            $purchase->phone_number           = $request->phone_number;
            $purchase->recipient_name         = $request->recipient_name;
            $purchase->purchase_date          = $request->purchase_date;
            $purchase->note                   = $request->note;
            $purchase->updated_by             = Auth::user()->id;
            $purchase->save();


            $purchaseItems = PurchaseItem::where('purchase_id', $id)->get();
            foreach ($purchaseItems as $item) {
                // dd($purchaseItems);
                $item->delete();
            }

            foreach ($request->purch as $item) {
                //  dd($request->purch);
                $purchaseItem = new PurchaseItem();
                $purchaseItem->purchase_id     = $purchase->id;
                $purchaseItem->supplier          = $item['supplier'];
                $purchaseItem->product          = $item['product'];
                $purchaseItem->unit             = $item['unit'];
                $purchaseItem->unit_price      = $item['unit_price'];
                $purchaseItem->quantity        = $item['quantity'];
                $purchaseItem->total_price     = $item['total_price'];
                $purchaseItem->save();
            }
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

        return redirect('/manage-purchase')->with('message', ' Purchase  Update  successfully');
    }


    public function delete($id)
    {
        try {
            DB::commit();
            $purchase = Purchase::find($id);

            $purchaseItems = PurchaseItem::where('purchase_id', $id)->get();
            foreach ($purchaseItems as $item) {
                // dd($purchaseItems);
                $item->delete();
            }
            Purchase::where('id', $purchase->id)->delete();
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception->getMessage());
        }
        return redirect('/manage-purchase')->with('message', 'Purchase info delete successfully.');
    }


    public function stockProduct()
    {

        DB::statement("SET SQL_MODE=''");
        $stocks = PurchaseItem::groupBy('product')->orderBy('id', 'desc')->get();

        // dd($stocks);


        return view('admin.purchase.purchase.stock', compact('stocks'));
    }

    public function stockProductDetail($product)
    {
        // dd($product);

        
        // dd($stocks->quantity);

        // $total_quantity = 0;

        // foreach ($stocks as $stock) {
        //     $total_quantity += $stock->quantity;
        // }
        // dd($stock);




        return view('admin.purchase.purchase.stockProductDetail', compact('total_quantity'));
    }
}
