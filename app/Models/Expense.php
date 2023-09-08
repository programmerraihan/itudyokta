<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    public static $expense;
    public static $message;
    protected $guarded = [];



    public static function newExpense($request)
    {
        return self::saveBasicInfo(new Expense(), $request);
    }

    public static function updateStatus($id)
    {
        self::$expense = Expense::find($id);

        if (self::$expense->status == 1) {
            self::$expense->status = 0;
            self::$message = 'Expense info Refuse successfully';
        } else {
            self::$expense->status = 1;
            self::$message = 'Expense info Process successfully';
        }
        self::$expense->save();
        return self::$message;
    }



    public static function updateExpense($request, $id)
    {
        self::saveBasicInfo(Expense::find($id), $request);
    }

    private static function saveBasicInfo($expense, $request)
    {
        $expense->branch_id =  Auth::guard('branch')->user()->id ?? null;
        $expense->expense_name            = $request->expense_name;
        $expense->expense_amount          = $request->expense_amount;
        $expense->expenseType_id          = $request->expenseType_id;
        $expense->bank_id                 = $request->bank_id;
        $expense->expense_date            = $request->expense_date;
        $expense->expense_description     = $request->expense_description;
        $expense->status                  = $request->status;
        $expense->save();
        return $expense;
    }


    public static function deleteExpense($id)
    {
        self::$expense = Expense::find($id);
        self::$expense->delete();
    }

    public function ExpenseType()
    {
        return $this->belongsTo('App\Models\ExpenseType');
    }
    public function Bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }
}
