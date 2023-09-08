<?php

namespace App\Http\Controllers\BranchPanel\Expense;

use App\Models\Bank;
use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchExpenseController extends Controller
{
    public function add()
    {
        return view('branch.branch-panel.expense.expense.manage', [
            $id = Auth::guard('branch')->user()->id,
            'expense_types' => ExpenseType::where('status', 1)->where('branch_id', $id)->get(),
            'banks' => Bank::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    }

    public function create(Request $request)
    {
        // return $request->all();
        $this->expense = Expense::newExpense($request);
        return redirect('branches/add-new-expense')->with('message', 'Expense info create successfully');
    }

    public function manage()
    {
        return view('branch.branch-panel.expense.expense.show', [
            $id = Auth::guard('branch')->user()->id,
            'expenses' => Expense::orderBy('id', 'desc')->where('branch_id', $id)->take('100')->get(['id',  'expense_name',  'bank_id',  'expense_amount',  'status', 'expense_date']),
        ]);
    }

    public function updateStatus($id)
    {
        return redirect()->back()->with(Expense::updateStatus($id));
    }


    public function detail($id)
    {
        return view('branch.branch-panel.expense.expense.detail', ['expense' => Expense::find($id)]);
    }


    public function edit($id)
    {
        return view(
            'branch.branch-panel.expense.expense.edit',
            [
                $branch_id = Auth::guard('branch')->user()->id,
                'expense' => Expense::find($id),
                'expense_types' => ExpenseType::where('status', 1)->where('branch_id', $branch_id)->get(),
                'banks' => Bank::where('status', 1)->where('branch_id', $branch_id)->get(),
            ]
        );
    }

    public function update(Request $request, $id)
    {
        Expense::updateExpense($request, $id);
        return redirect('branches/manage-expense')->with('message', 'Expense info update successfully');
    }


    public function delete(Request $request, $id)
    {

        Expense::deleteExpense($id);
        return redirect('branches/manage-expense')->with('message', 'Expense info delete successfully.');
    }
}
