<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    use HasFactory;

    public static $service;
    public static $message;
    protected $guarded = [];

    public static function updateServiceStatus($id)
    {
        self::$service = OurService::find($id);
        if (self::$service->status == 1) {
            self::$service->status = 0;
            self::$message = 'service info Unpublished Successfully ';
        } else {
            self::$service->status = 1;
            self::$message = 'service info Published Successfully ';
        }
        self::$service->save();
        return  self::$message;
    }
}
