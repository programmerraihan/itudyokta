<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;
    public static $director;
    public static $message;


    public static function updateDirectorStatus($id)
    {
        self::$director = Director::find($id);
        if (self::$director->status == 1) {
            self::$director->status = 0;
            self::$message = 'director info Unpublished Successfully ';
        } else {
            self::$director->status = 1;
            self::$message = 'Project info Published Successfully ';
        }
        self::$director->save();
        return  self::$message;
    }
}
