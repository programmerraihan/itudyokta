<?php

namespace App\Http\Controllers\BranchPanel\Academic;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesSessionController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $sessions =  Session::where('branch_id', $id)->get();
        return view('branch.branch-panel.academic-module.session.index', compact('sessions'));
    }

    public function addSession()
    {
        return view('branch.branch-panel.academic-module.session.add');
    }

    public function store(Request $request)
    {
        $session = new Session();
        $session->branch_id      =  Auth::guard('branch')->user()->id;
        $session->year           =  $request->input('year');
        $session->name           =  $request->input('name');
        $session->status         =  $request->input('status');
        $session->save();
        return redirect('branches/session-index')->with('message', 'Our session info create successfully');
    }


    public function edit($id)
    {
        $session = Session::find($id);
        return view('branch.branch-panel.academic-module.session.edit', compact('session'));
    }


    public function update(Request $request, $id)
    {
        $session = Session::find($id);
        $session->branch_id         =  Auth::guard('branch')->user()->id;
        $session->year              =  $request->input('year');
        $session->name              =  $request->input('name');
        $session->status            =  $request->input('status');
        $session->save();
        return redirect('branches/session-index')->with('message', ' Our service info Update successfully');
    }

    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Session::updateSessionStatus($id));
    }

    public function destroy($id)
    {
        $session = Session::find($id);
        $session->delete();
        return redirect('branches/session-index')->with('message', 'session info Delete Successfully');
    }
}
