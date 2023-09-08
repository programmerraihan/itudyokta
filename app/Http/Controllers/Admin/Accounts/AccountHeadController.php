<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Models\AccountHead;
use Illuminate\Http\Request;
use App\Models\AccountHeadType;
use App\Http\Controllers\Controller;
use App\Models\AccountHeadCategory;

class AccountHeadController extends Controller
{
  public function index()
  {
    $accountHeads = AccountHead::all();
    return view('admin.admin.accounts.account-head.index', compact('accountHeads'));
  }
  //End Method


  public function addAddAccount()
  {
    $accountHeadTypes = AccountHeadType::get();
    $accountHeadCategories = AccountHeadCategory::get();
    return view('admin.admin.accounts.account-head.add', compact('accountHeadTypes', 'accountHeadCategories'));
  }
  //End Method


  public function store(Request $request)
  {
    // return $request->all();
    $accountHead = new AccountHead();
    $accountHead->name                        =  $request->input('name');
    $accountHead->account_head_category_id    =  $request->input('account_head_category_id');
    $accountHead->account_head_type_id        =  $request->input('account_head_type_id');
    $accountHead->user_id                     =  $request->input('user_id');
    $accountHead->details                     =  $request->input('details');
    $accountHead->status                      =  $request->input('status');
    $accountHead->save();
    return redirect('/account-head-index')->with('message', 'Our Account Head Category info create successfully');
  }
  //End Method

  public function edit($id)
  {

    $accountHeadTypes = AccountHeadType::get();
    $accountHeadCategories = AccountHeadCategory::get();

    $accountHead = AccountHead::find($id);

    //dd($accountHeadTypes);


    return view('admin.admin.accounts.account-head.edit', compact('accountHeadCategories', 'accountHeadTypes', 'accountHead'));
  } //End Method



  public function update(Request $request, $id)
  {

    //return $request->all();
    $accountHead = AccountHead::find($id);

    $accountHead->name                        =  $request->input('name');
    $accountHead->account_head_category_id    =  $request->input('account_head_category_id');
    $accountHead->account_head_type_id        =  $request->input('account_head_type_id');
    $accountHead->user_id                     =  $request->input('user_id');
    $accountHead->details                     =  $request->input('details');
    $accountHead->status                      =  $request->input('status');
    $accountHead->save();
    return redirect('/account-head-index')->with('message', ' Our Account Head Category info Update successfully');
  }


  public function updateStatus($id)
  {
    return  redirect()->back()->with('message', AccountHead::updateAccountHeadStatus($id));
  }


  public function destroy($id)
  {
    $accountHead = AccountHead::find($id);
    $accountHead->delete();
    return redirect('/account-head-index')->with('message', 'Account Head info Delete Successfully');
  }
}
