<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Damage;
use Illuminate\Http\Request;

class DamageController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:damage-view", ['only' => ['index']]);
        $this->middleware("permission:damage-create", ['only' => ['create', 'store']]);
        $this->middleware("permission:damage-update", ['only' => ['edit', 'update']]);
        $this->middleware("permission:damage-delete", ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $damages = Damage::with(['asset', 'asset.branch'])->orderBy('id', 'desc')
        ->when(auth("web")->check(), function ($query) {
            return $query->where("owner", "admin")->whereNull("branch_id");
        })
        ->when(auth("branch")->check(), function ($query) {
            return $query->where("owner", "branch")->where("branch_id", auth("branch")->user()->id);
        })
        ->paginate(10);
        return view('damage.index', compact("damages"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assets = Asset::select("id", "name")
        ->when(auth("web")->check(), function ($query) {
            return $query->where("owner", "admin")->whereNull("branch_id");
        })
        ->when(auth("branch")->check(), function ($query) {
            return $query->where("owner", "branch")->where("branch_id", auth("branch")->user()->id);
        })
        ->get();
        return view("damage.create", compact("assets"));
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
            'date' => ["required", "date"],
            "asset_id" => ["required", "numeric"],
            "quantity" => ["required", "numeric"],
            "damage_price" => ["required", "numeric"],
            "total_damage_price" => ["required", "numeric"]
        ]);

        $data = $request->all();
        $data['owner'] = auth('web')->check() ? 'admin' : 'branch';
        $data['branch_id'] = auth('web')->check() ? null : auth('branch')->user()->id;
        Damage::create($data);
        return redirect()->route("damage.index")->with("message", "Damage create successfull!");
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
    public function edit(Damage $damage)
    {
        $assets = Asset::select("id", "name")
        ->when(auth("web")->check(), function ($query) {
            return $query->where("owner", "admin")->whereNull("branch_id");
        })
        ->when(auth("branch")->check(), function ($query) {
            return $query->where("owner", "branch")->where("branch_id", auth("branch")->user()->id);
        })
        ->get();
        return view("damage.edit", compact("damage", "assets"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Damage $damage)
    {
        $request->validate([
            'date' => ["required", "date"],
            "asset_id" => ["required", "numeric"],
            "quantity" => ["required", "numeric"],
            "damage_price" => ["required", "numeric"],
            "total_damage_price" => ["required", "numeric"]
        ]);

        $data = $request->all();
        $data['owner'] = auth('web')->check() ? 'admin' : 'branch';
        $data['branch_id'] = auth('web')->check() ? null : auth('branch')->user()->id;
        $damage->update($data);
        return redirect()->route("damage.index")->with("message", "Damage update successfull!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Damage $damage)
    {
        if(auth('branch')->check() && ($damage->branch_id == auth('branch')->user()->id)) {
            abort(403, "You cant delete this damage!");
        }
        if(auth('web')->check() && !is_null($damage->branch_id)) {
            abort(403, "You cant delete this damage!");
        }
        $damage->delete();
        return redirect()->route('damage.index')->with("message",  "Damage delete successfull!");
    }
}
