<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SalePayment;
use App\Models\Unit;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::with(['saleItems', 'saleItems.unit'])
        ->when(auth()->check(), function ($query) {
            return $query->whereNull("branch_id");
        })
        ->when(auth('branch')->check(), function ($query) {
            return $query->where("branch_id", auth("branch")->user()->id);
        })
        ->paginate(10);
        return view("sales.index", compact("sales"));
    }

    public function invoice($sale) 
    {
        $sale = Sale::with('salePayment')->findOrFail($sale);
        // dd($sale);
        return view("sales.invoice", compact("sale"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select("id", "name")
        ->when(auth()->check(), function ($query) {
            return $query->whereNull("branch_id");
        })
        ->when(auth('branch')->check(), function ($query) {
            return $query->where("branch_id", auth("branch")->user()->id);
        })
        ->get();
        $units = Unit::select("id", "name")
        ->when(auth()->check(), function ($query) {
            return $query->whereNull("branch_id");
        })
        ->when(auth('branch')->check(), function ($query) {
            return $query->where("branch_id", auth("branch")->user()->id);
        })
        ->get();
        return view("sales.create", compact("products", "units"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "date" => ["required", "date"],
            "customer" => ["required"],
            "phone" => ["required"],
            "note" => ["nullable"], 
            "paid_amount" => ["required"],
            "product_id" => ["required", "array", "min:1"],
            "unit_id" => ["required", "array", "min:1"],
        ]);

        $data = $request->all();
        // dd($request->paid_amount);
        if(auth("branch")->check()) {
            $data['branch_id'] = auth("branch")->user()->id;
        }
        $data['reference_no'] = time().mt_rand(10000, 99999);
        $data['due_amount'] = $request->net_amount - $request->paid_amount;
        $data['paid_amount'] = $request->paid_amount;
        $sale = Sale::create($data);

        $data['sale_id'] = $sale->id;
        $data['paid_amount'] = $request->paid_amount;
        $salesPayment = SalePayment::create($data);
        foreach($request->product_id as $key => $productId) {
            $saleItem = [
                "product_id" => $productId,
                "sale_id" => $sale->id,
                "unit_id" => $request->unit_id[$key] ?? 0,
                "unit_price" => $request->unit_price[$key] ?? 0,
                "quantity" => $request->unit_quantity[$key] ?? 0,
                "discount" => $request->unit_discount[$key] ?? 0,
                "amount" => $request->unit_total[$key] ?? 0,
            ];
            SaleItem::create($saleItem);
        }
        return redirect()->route("sales.index")->with("message", "Sale create successfull!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::with(['saleItems', 'saleItems.unit'])->findOrFail($id);
        if(auth()->check() && !is_null($sale->branch_id)) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }
        if(auth('branch')->check() && $sale->branch_id != auth('branch')->user()->id) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }
        return view("sales.view", compact("sale"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::with(['saleItems', 'saleItems.unit'])->findOrFail($id);
        if(auth()->check() && !is_null($sale->branch_id)) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }
        if(auth('branch')->check() && $sale->branch_id != auth('branch')->user()->id) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }

        $products = Product::select("id", "name")
        ->when(auth()->check(), function ($query) {
            return $query->whereNull("branch_id");
        })
        ->when(auth('branch')->check(), function ($query) {
            return $query->where("branch_id", auth("branch")->user()->id);
        })
        ->get();
        $units = Unit::select("id", "name")
        ->when(auth()->check(), function ($query) {
            return $query->whereNull("branch_id");
        })
        ->when(auth('branch')->check(), function ($query) {
            return $query->where("branch_id", auth("branch")->user()->id);
        })
        ->get();

        return view("sales.edit", compact("sale", "products", "units"));
    }

    public function dueCollection($id)
    {
        $sale = Sale::with(['saleItems', 'saleItems.unit'])->findOrFail($id);
        if(auth()->check() && !is_null($sale->branch_id)) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }
        if(auth('branch')->check() && $sale->branch_id != auth('branch')->user()->id) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }

        $products = Product::select("id", "name")
        ->when(auth()->check(), function ($query) {
            return $query->whereNull("branch_id");
        })
        ->when(auth('branch')->check(), function ($query) {
            return $query->where("branch_id", auth("branch")->user()->id);
        })
        ->get();
        $units = Unit::select("id", "name")
        ->when(auth()->check(), function ($query) {
            return $query->whereNull("branch_id");
        })
        ->when(auth('branch')->check(), function ($query) {
            return $query->where("branch_id", auth("branch")->user()->id);
        })
        ->get();

        return view("sales.duecollection", compact("sale", "products", "units"));
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
        $request->validate([
            "date" => ["required", "date"],
            "reference_no" => ["required", "unique:sales,reference_no," . $id],
            "customer" => ["required"],
            "phone" => ["required"],
            "note" => ["nullable"], 
            "paid_amount" => ["required"],
            "product_id" => ["required", "array", "min:1"],
            "unit_id" => ["required", "array", "min:1"],
        ]);

        $data = $request->all();
        $data['due_amount'] = $request->net_amount - $request->paid_amount;
        $data['paid_amount'] = $request->paid_amount;
        $sale = Sale::with(['saleItems','salePayment'])->findOrFail($id);

        if(auth()->check() && !is_null($sale->branch_id)) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }
        if(auth('branch')->check() && $sale->branch_id != auth('branch')->user()->id) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }
        
        $sale->update($data);
        $paymentid = SalePayment::where('sale_id',$sale->id)->first();
        $salesPayment = SalePayment::find($paymentid->id);
        $salesPayment->amount = $request->amount;
        $salesPayment->paid_amount = $request->paid_amount;
        $salesPayment->due_amount = $request->net_amount - $request->paid_amount;
        $salesPayment->grand_total = $request->grand_total;
        $salesPayment->save();

        // sale items delete
        $sale->saleItems()->delete();

        foreach($request->product_id as $key => $productId) {
            $saleItem = [
                "product_id" => $productId,
                "sale_id" => $sale->id,
                "unit_id" => $request->unit_id[$key] ?? 0,
                "unit_price" => $request->unit_price[$key] ?? 0,
                "quantity" => $request->unit_quantity[$key] ?? 0,
                "discount" => $request->unit_discount[$key] ?? 0,
                "amount" => $request->unit_total[$key] ?? 0,
            ];
            SaleItem::create($saleItem);
        }
        return redirect()->route("sales.index")->with("message", "Sale update successfull!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        if(auth()->check() && !is_null($sale->branch_id)) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }
        if(auth('branch')->check() && $sale->branch_id != auth('branch')->user()->id) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }

        $sale->saleItems()->delete();
        $sale->delete();
        return redirect()->route("sales.index")->with("message", "Sale delete successfull!");
    }

    public function dueCollectionStore(Request $request, $id)
    {
        $request->validate([
            "paid_amount" => ["required"],
        ]);

        $data = $request->all();
        $sale = Sale::with(['saleItems','salePayment'])->findOrFail($id);
        $data['due_amount'] = $sale->due_amount - $request->paid_amount;
        $data['paid_amount'] = $sale->paid_amount + $request->paid_amount;

        if(auth()->check() && !is_null($sale->branch_id)) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }
        if(auth('branch')->check() && $sale->branch_id != auth('branch')->user()->id) {
            return redirect()->route("sales.index")->with("message", "Sorry! You can not delete it!");
        }
        
        $sale->update($data);
        
        $salesPayment = new SalePayment;
        $salesPayment->date = $request->date;
        $salesPayment->sale_id = $sale->id;
        $salesPayment->reference_no = $sale->reference_no;
        $salesPayment->customer = $sale->customer;
        $salesPayment->phone = $sale->phone;
        $salesPayment->quantity = $sale->quantity;
        $salesPayment->discount_amount = $sale->discount_amount;
        $salesPayment->amount = $request->amount;
        $salesPayment->paid_amount = $request->paid_amount;
        $salesPayment->due_amount = $sale->due_amount - $request->paid_amount;
        $salesPayment->grand_total = $request->grand_total;
        $salesPayment->save();

        
        return redirect()->route("sales.index")->with("message", "Due collect successfull!");
    }
}
