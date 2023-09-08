<?php

namespace App\Http\Controllers\Admin\Requisition;

use App\Models\Requisition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequisitionController extends Controller
{
    public function index()
    {
        $requisition = Requisition::where('status', 1)->with('requisitionDetail')->get();
        return view('admin.admin.requisition.show', compact('requisition'));
    }

    public function detail($id)
    {

        // dd($id);
        $requisition = Requisition::with('requisitionDetail')->get()->find($id);
        return view('admin.admin.requisition.detail', compact('requisition'));
    }



    public function status($id)
    {
        $requisition = Requisition::find($id);

        if ($requisition->status == 1) {
            $requisition->status = 0;
        } else {
            $requisition->status = 1;
        }
        $requisition->save();
        return redirect()->back()->with('message', 'Status updated Successfully');
    }




    public function complete()
    {
        $requisition = Requisition::where('status', 0)->with('requisitionDetail')->get();
        return view('admin.admin.requisition.complete', compact('requisition'));
    }
}
