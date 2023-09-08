<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{

    public function __construct()
    {
        $this->middleware("permission:asset-view", ['only' => ['index']]);
        $this->middleware("permission:asset-create", ['only' => ['create', 'store']]);
        $this->middleware("permission:asset-update", ['only' => ['edit', 'update']]);
        $this->middleware("permission:asset-delete", ['only' => ['destroy']]);
        $this->middleware("permission:stock-list", ['only' => ['stock']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $assets = Asset::orderBy('id', 'desc')
        ->when(auth("web")->check(), function ($query) {
            return $query->where("owner", "admin")->whereNull("branch_id");
        })
        ->when(auth("branch")->check(), function ($query) {
            return $query->where("owner", "branch")->where("branch_id", auth("branch")->user()->id);
        })
        ->paginate(10);
        return view("assets.index", compact('assets'));
    }

    /**
     * stock list
     */
    public function stock()
    {
        $assets = Asset::with(["damages"])->orderBy('id', 'desc')
        ->when(auth("web")->check(), function ($query) {
            return $query->where("owner", "admin")->whereNull("branch_id");
        })
        ->when(auth("branch")->check(), function ($query) {
            return $query->where("owner", "branch")->where("branch_id", auth("branch")->user()->id);
        })
        ->paginate(10);
        $assetsWithDamages = $assets->map(function ($asset) {
            if($asset->damages->isNotEmpty()) {
                $asset->quantity -= ($asset->damages->sum('quantity') ?? 0);
                $asset->total_purchase_price -= ($asset->damages->sum('total_damage_price') ?? 0);
                return $asset;
            }
            return $asset;
        });
        return view("assets.stock", compact("assets", "assetsWithDamages"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("assets.create");
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
            'date' => ['required', 'date'],
            'name' => ['required', 'string'],
            'supplier_name' => ['required', 'string'],
            'quantity' => ['required', 'numeric'],
            'purchase_price' => ['required', 'numeric'],
            'total_purchase_price' => ['required', 'numeric'],
        ]);

        $data = $request->all();
        $data['owner'] = auth('web')->check() ? 'admin' : 'branch';
        $data['branch_id'] = auth('web')->check() ? null : auth('branch')->user()->id;
        Asset::create($data);
        return redirect()->route("assets.index")->with("message", "Asset create successfull!");
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
        $asset = Asset::findOrFail($id);
        if(auth('branch')->check() && ($asset->branch_id != auth('branch')->user()->id)) {
            abort(404);
        }

        return view("assets.edit", compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        if(auth('branch')->check() && ($asset->branch_id != auth('branch')->user()->id)) {
            abort(404);
        }

        $request->validate([
            'date' => ['required', 'date'],
            'name' => ['required', 'string'],
            'supplier_name' => ['required', 'string'],
            'quantity' => ['required', 'numeric'],
            'purchase_price' => ['required', 'numeric'],
            'total_purchase_price' => ['required', 'numeric'],
        ]);

        $data = $request->all();
        $data['owner'] = auth('web')->check() ? 'admin' : 'branch';
        $data['branch_id'] = auth('web')->check() ? null : auth('branch')->user()->id;
        $asset->update($data);
        return redirect()->route("assets.index")->with("message", "Asset update successfull!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        if(auth('branch')->check() && ($asset->branch_id == auth('branch')->user()->id)) {
            abort(403, "You cant delete this asset!");
        }
        if(auth('web')->check() && !is_null($asset->branch_id)) {
            abort(403, "You cant delete this asset!");
        }
        $asset->delete();
        return redirect()->route('assets.index')->with("message",  "Asset delete successfull!");
    }
}
