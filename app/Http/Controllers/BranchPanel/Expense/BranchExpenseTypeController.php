<?php

namespace App\Http\Controllers\BranchPanel\Expense;

use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('branch.branch-panel.expense.type.manage', [

            $id = Auth::guard('branch')->user()->id,
            'expense_types' =>  ExpenseType::where('branch_id', $id)->get(),

        ]);
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
        ExpenseType::newExpenseType($request);
        return redirect()->back()->with('message', 'ExpenseType  info create successfully');
    }

    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', ExpenseType::updateExpenseTypeStatus($id));
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
        return view('branch.branch-panel.expense.type.edit', ['expenseType' => ExpenseType::find($id), 'expense_types' => ExpenseType::all()]);
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
        ExpenseType::updateExpenseType($request, $id);
        return redirect()->back()->with('message', 'ExpenseType info Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenseType = ExpenseType::find($id);
        $expenseType->delete();
        return redirect()->back()->with('message', 'ExpenseType info Delete Successfully');
    }
}
