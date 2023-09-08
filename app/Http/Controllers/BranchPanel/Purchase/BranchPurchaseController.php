<?php

namespace App\Http\Controllers\BranchPanel\Purchase;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchPurchaseController extends Controller
{
    public function add()
    {


        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.purchase.purchase.manage', [

            'units'          => Unit::orderBy('id', 'desc')->where('branch_id', $id)->get(),
            'products'       => Product::where('status', 1)->where('branch_id', $id)->get(),
            'suppliers'      => Supplier::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }

    public function branchGetAllPurchaseData()
    {

        $id = Auth::guard('branch')->user()->id;
        return response()->json([

            'units'         => Unit::orderBy('id', 'desc')->where('branch_id', $id)->get(),
            'products'      => Product::where('status', 1)->where('branch_id', $id)->get(),
            'suppliers'     => Supplier::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }



    public function create(Request $request)
    {
        // dd($request->all());
        try {
            $purchase = new Purchase();
            $purchase->branch_id             =  Auth::guard('branch')->user()->id;

            // dd($purchase->branch_id);
            $purchase->challan_number         = $request->challan_number;
            $purchase->phone_number           = $request->phone_number;
            $purchase->recipient_name         = $request->recipient_name;
            $purchase->purchase_date          = $request->purchase_date;
            $purchase->note                   = $request->note;
            // $purchase->created_by             = Auth::user()->id;
            $purchase->save();

            foreach ($request->purch as $item) {

                $purchaseItem = new PurchaseItem();
                $purchaseItem->purchase_id       = $purchase->id;
                $purchaseItem->branch_id       = Auth::guard('branch')->user()->id;
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
        $id = Auth::guard('branch')->user()->id;
        return view(
            'branch.branch-panel.purchase.purchase.show',
            [

                'purchases' => Purchase::orderBy('id', 'desc')->where('branch_id', $id)->take('1000')->get(['id', 'challan_number', 'recipient_name', 'purchase_date'])
            ]
        );
    }

    public function detail($id)
    {
        return view('branch.branch-panel.purchase.purchase.detail', ['purchase' => Purchase::find($id)]);
    }


    public function edit($id)
    {


        $branch_id = Auth::guard('branch')->user()->id;
        $purchase     = Purchase::where('branch_id', $branch_id)->find($id);

        // dd($purchase);
        $units        = Unit::orderBy('id', 'desc')->where('branch_id', $branch_id)->get();
        $products     = Product::where('status', 1)->where('branch_id', $branch_id)->get();
        $suppliers    = Supplier::where('status', 1)->where('branch_id', $branch_id)->get();

        // dd($suppliers);

        return view('branch.branch-panel.purchase.purchase.edit', compact('purchase', 'units', 'products', 'suppliers'));
    }


    public function update(Request $request, $id)
    {

        // dd($request);
        try {
            $purchase = Purchase::find($id);
            $purchase->branch_id              =  Auth::guard('branch')->user()->id;
            $purchase->challan_number         = $request->challan_number;
            $purchase->phone_number           = $request->phone_number;
            $purchase->recipient_name         = $request->recipient_name;
            $purchase->purchase_date          = $request->purchase_date;
            $purchase->note                   = $request->note;
            // $purchase->updated_by             = Auth::user()->id;
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

        return redirect('branches/manage-purchase')->with('message', ' Purchase  Update  successfully');
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
        return redirect()->back()->with('message', 'Purchase info delete successfully.');
    }

    
    public function stockProductBranch()
    {
        $branch_id = Auth::guard('branch')->user()->id;

        DB::statement("SET SQL_MODE=''");
        $stocks = PurchaseItem::groupBy('product')->where('branch_id', $branch_id)->orderBy('id', 'desc')->get();

        return view('branch.branch-panel.purchase.purchase.stock', compact('stocks'));
    }

    public function stockProductDetailBranch($product)
    {
        return view('branch.branch-panel.purchase.purchase.stockProductDetail', compact('total_quantity'));
    }

}
