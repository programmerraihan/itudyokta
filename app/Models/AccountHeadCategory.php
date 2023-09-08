<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHeadCategory extends Model
{
    use HasFactory;


    public static $accountHeadCategory;
    public static $message;
    protected $guarded = [];

    public static function updateAccountHeadCategoryStatus($id)
    {
        self::$accountHeadCategory = AccountHeadCategory::find($id);
        if (self::$accountHeadCategory->status == 1) {
            self::$accountHeadCategory->status = 0;
            self::$message = 'Account Head info Unpublished Successfully ';
        } else {
            self::$accountHeadCategory->status = 1;
            self::$message = 'Account Head info Published Successfully ';
        }
        self::$accountHeadCategory->save();
        return  self::$message;
    }
}
