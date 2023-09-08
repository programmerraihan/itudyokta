<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static $system;
    public static $message;



    public static function updateSystemStatus($id)
    {
        self::$system = SystemSetting::find($id);
        if (self::$system->status == 1) {
            self::$system->status = 0;
            self::$message = 'system info Unpublished Successfully ';
        } else {
            self::$system->status = 1;
            self::$message = 'system info Published Successfully ';
        }
        self::$system->save();
        return  self::$message;
    }
}
