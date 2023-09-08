<?php

namespace App\Http\Controllers\BranchPanel\Expense;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = Auth::guard('branch')->user()->id;
        $banks = Bank::where('branch_id', $id)->get();
        // dd($banks);
        return view('branch.branch-panel.expense.bank.manage', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        Bank::newBank($request);
        return redirect()->back()->with('message', 'Bank  info create successfully');
    }

    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Bank::updateBankStatus($id));
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
        return view('branch.branch-panel.expense.bank.edit', ['bank' => Bank::find($id), 'banks' => Bank::all()]);
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

        Bank::updateBank($request, $id);
        return redirect('branches/branches-bank')->with('message', 'Bank info Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();
        return  redirect()->back()->with('message', 'Unit info Delete Successfully');
    }
}
