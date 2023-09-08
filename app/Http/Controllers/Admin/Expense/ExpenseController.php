<?php

namespace App\Http\Controllers\Admin\Expense;

use App\Models\Bank;
use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    public function add()
    {
        return view('admin.expense.expense.manage', [
            'expense_types' => ExpenseType::where('status', 1)->get(),
            'banks' => Bank::where('status', 1)->get(),
        ]);
    }

    public function create(Request $request)
    {
        // return $request->all();
        $this->expense = Expense::newExpense($request);
        return redirect('/add-new-expense')->with('message', 'Expense info create successfully');
    }

    public function manage()
    {
        return view('admin.expense.expense.show', ['expenses' => Expense::orderBy('id', 'desc')->take('100')->get(['id',  'expense_name',  'bank_id',  'expense_amount',  'status', 'expense_date'])]);
    }

    public function updateStatus($id)
    {
        return redirect()->back()->with(Expense::updateStatus($id));
    }


    public function detail($id)
    {
        return view('admin.expense.expense.detail', ['expense' => Expense::find($id)]);
    }


    public function edit($id)
    {
        return view('admin.expense.expense.edit',
            [
                'expense' => Expense::find($id),
                'expense_types' => ExpenseType::where('status', 1)->get(),
                'banks' => Bank::where('status', 1)->get(),
            ]
        );
    }

    public function update(Request $request, $id)
    {
        Expense::updateExpense($request, $id);
        return redirect('/manage-expense')->with('message', 'Expense info update successfully');
    }


    public function delete(Request $request, $id)
    {

        Expense::deleteExpense($id);
        return redirect('/manage-expense')->with('message', 'Expense info delete successfully.');
    }
}
