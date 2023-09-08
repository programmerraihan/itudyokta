<?php

namespace App\Http\Controllers\Admin;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function index()
    {

        $sessions = Session::all();
        return view('admin.admin.session.index', compact('sessions'));
    }
    //End Method


    public function addSession()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.admin.session.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $session = new Session();
        $session->year              =  $request->input('year');
        $session->name              =  $request->input('name');
        $session->status             =  $request->input('status');
       
        $session->save();
        return redirect('/session-index')->with('message', 'Our session info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $session = Session::find($id);
        return view('admin.admin.session.edit', compact('session'));
    } //End Method



    public function update(Request $request, $id)
    {
        $session = Session::find($id);
        $session->year              =  $request->input('year');
        $session->name              =  $request->input('name');
        $session->status             =  $request->input('status');
        $session->save();
        return redirect('/session-index')->with('message', ' Our service info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Session::updateSessionStatus($id));
    }


    public function destroy($id)
    {
        $this->session = Session::find($id);
        // dd($this->session);
        $this->session->delete();
        return redirect('/session-index')->with('message', 'session info Delete Successfully');
    }
}
