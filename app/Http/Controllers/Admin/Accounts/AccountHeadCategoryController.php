<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Models\AccountHead;
use Illuminate\Http\Request;
use App\Models\AccountHeadType;
use App\Models\AccountHeadCategory;
use App\Http\Controllers\Controller;

class AccountHeadCategoryController extends Controller
{
    public function index()
    {

        $accountHeadCategories = AccountHeadCategory::all();
        return view('admin.admin.accounts.account-head-category.index', compact('accountHeadCategories'));
    }
    //End Method


    public function addAddAccount()
    {
        $accountHeadTypes = AccountHeadType::get();
        // dd($accountHeads);
        return view('admin.admin.accounts.account-head-category.add', compact('accountHeadTypes'));
    }
    //End Method


    public function store(Request $request)
    {
        // return $request->all();
        $accountHeadCategory = new AccountHeadCategory();
        $accountHeadCategory->name              =  $request->input('name');
        $accountHeadCategory->account_head_type_id              =  $request->input('account_head_type_id');
        $accountHeadCategory->details              =  $request->input('details');
        $accountHeadCategory->status             =  $request->input('status');
        $accountHeadCategory->save();
        return redirect('/account-category-index')->with('message', 'Our Account Head Category info create successfully');
    }
    //End Method

    public function edit($id)
    {
        // dd($id);
        $accountHeadTypes = AccountHeadType::get();
        //dd($accountHeads);
        $accountHeadCategory = AccountHeadCategory::find($id);

        // dd($accountHeadCategory);
        return view('admin.admin.accounts.account-head-category.edit', compact('accountHeadCategory', 'accountHeadTypes'));
    } //End Method



    public function update(Request $request, $id)
    {

        //return $request->all();
        $accountHeadCategory = AccountHeadCategory::find($id);

        $accountHeadCategory->name              =  $request->input('name');
        $accountHeadCategory->account_head_type_id              =  $request->input('account_head_type_id');
        $accountHeadCategory->details              =  $request->input('details');
        $accountHeadCategory->status             =  $request->input('status');
        $accountHeadCategory->save();
        return redirect('/account-category-index')->with('message', ' Our Account Head Category info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', AccountHeadCategory::updateAccountHeadCategoryStatus($id));
    }


    public function destroy($id)
    {
        $accountHeadCategory = AccountHeadCategory::find($id);
        $accountHeadCategory->delete();
        return redirect('/account-category-index')->with('message', 'Account Head info Delete Successfully');
    }
}
