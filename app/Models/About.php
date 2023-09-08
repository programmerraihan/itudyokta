<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;


    public static $about;
    public static $message;
    protected $guarded = [];

    public static function updateAboutStatus($id)
    {
        self::$about = About::find($id);
        if (self::$about->status == 1) {
            self::$about->status = 0;
            self::$message = 'About info Unpublished Successfully ';
        } else {
            self::$about->status = 1;
            self::$message = 'About info Published Successfully ';
        }
        self::$about->save();
        return  self::$message;
    }
}
