<?php

namespace App\Http\Controllers\Admin\Expense;

use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware("permission:expense-type-view", ["only" => ["index"]]);
        $this->middleware("permission:expense-type-create", ["only" => ["store"]]);
        $this->middleware("permission:expense-type-update", ["only" => ["edit", "update"]]);
        $this->middleware("permission:expense-type-delete", ["only" => ["destroy"]]);
        $this->middleware("permission:expense-type-approved", ["only" => ["updateStatus"]]);
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.expense.type.manage', ['expense_types' => ExpenseType::all()]);
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
        return view('admin.expense.type.edit', ['expenseType' => ExpenseType::find($id), 'expense_types' => ExpenseType::all()]);
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
        return redirect('expenseType')->with('message', 'ExpenseType info Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $this->expenseType = ExpenseType::find($id);
        $this->expenseType->delete();
        return redirect('expenseType')->with('message', 'ExpenseType info Delete Successfully');
    }
}
