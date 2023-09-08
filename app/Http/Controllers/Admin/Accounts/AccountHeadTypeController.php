<?php

namespace App\Http\Controllers\Admin\Accounts;

use Illuminate\Http\Request;
use App\Models\AccountHeadType;
use App\Http\Controllers\Controller;

class AccountHeadTypeController extends Controller
{
    public function index()
    {

        $accountHeadTypes = AccountHeadType::all();
        return view('admin.admin.accounts.account-head-type.index', compact('accountHeadTypes'));
    }
    //End Method


    public function addAddAccount()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.admin.accounts.account-head-type.add');
    }
    //End Method


    public function store(Request $request)
    {
        // return $request->all();
        $accountHeadTypes = new AccountHeadType();
        $accountHeadTypes->name              =  $request->input('name');
        $accountHeadTypes->status             =  $request->input('status');
        $accountHeadTypes->save();
        return redirect('/account-head-type-index')->with('message', 'Our Account Head info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $accountHeadType = AccountHeadType::find($id);
        return view('admin.admin.accounts.account-head-type.edit', compact('accountHeadType'));
    } //End Method



    public function update(Request $request, $id)
    {
        $accountHeadType = AccountHeadType::find($id);

        $accountHeadType->name              =  $request->input('name');
        $accountHeadType->status             =  $request->input('status');
        $accountHeadType->save();
        return redirect('/account-head-type-index')->with('message', ' Our Account Head info Update successfully');
    }


    public function updateStatus($id)
    {

        // dd($id);
        return  redirect()->back()->with('message', AccountHeadType::updateAccountHeadStatus($id));
    }


    public function destroy($id)
    {
        $accountHead = AccountHeadType::find($id);
        $accountHead->delete();
        return redirect('/account-head-type-index')->with('message', 'Account Head info Delete Successfully');
    }
}
