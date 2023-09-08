<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseType extends Model
{
    use HasFactory;
    use HasFactory;

    public static $expenseType;
    public static $message;

    public static function newExpenseType($request)
    {
        self::saveBasicInfo(new ExpenseType(), $request);
    }

    public static function updateExpenseTypeStatus($id)
    {
        self::$expenseType = ExpenseType::find($id);
        if (self::$expenseType->status == 1) {
            self::$expenseType->status = 0;
            self::$message = 'Unit info Unpublished Successfully ';
        } else {
            self::$expenseType->status = 1;
            self::$message = 'Unit info Published Successfully ';
        }
        self::$expenseType->save();
        return  self::$message;
    }


    public static function updateExpenseType($request, $id)
    {
        self::$expenseType = ExpenseType::find($id);

        self::saveBasicInfo(self::$expenseType, $request);
    }



    public static function saveBasicInfo($expenseType, $request)
    {
        $expenseType->branch_id          = Auth::guard('branch')->user()->id ?? null;
        $expenseType->name               = $request->name;
        $expenseType->description        = $request->description;
        $expenseType->status             = $request->status;
        $expenseType->save();
    }
}
