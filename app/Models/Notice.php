<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;


    public static $notice;
    public static $message;
    protected $guarded = [];

    public static function updateNoticeStatus($id)
    {
        self::$notice = Notice::find($id);
        if (self::$notice->status == 1) {
            self::$notice->status = 0;
            self::$message = 'Notice info Unpublished Successfully ';
        } else {
            self::$notice->status = 1;
            self::$message = 'Notice info Published Successfully ';
        }
        self::$notice->save();
        return  self::$message;
    }
}
