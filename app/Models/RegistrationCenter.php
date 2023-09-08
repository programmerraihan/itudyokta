<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationCenter extends Model
{
    use HasFactory;


    public static $center;
    public static $message;
    protected $guarded = [];

    public static function updateCenterStatus($id)
    {
        self::$center = RegistrationCenter::find($id);
        if (self::$center->status == 1) {
            self::$center->status = 0;
            self::$message = 'Center info Unpublished Successfully ';
        } else {
            self::$center->status = 1;
            self::$message = 'Center info Published Successfully ';
        }
        self::$center->save();
        return  self::$message;
    }
}
