<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHeadType extends Model
{
    use HasFactory;

    public static $accountHead;
    public static $message;
    protected $guarded = [];

    public static function updateAccountHeadStatus($id)
    {
        self::$accountHead = AccountHeadType::find($id);
        if (self::$accountHead->status == 1) {
            self::$accountHead->status = 0;
            self::$message = 'Account Head info Unpublished Successfully ';
        } else {
            self::$accountHead->status = 1;
            self::$message = 'Account Head info Published Successfully ';
        }
        self::$accountHead->save();
        return  self::$message;
    }
}
