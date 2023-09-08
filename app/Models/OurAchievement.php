<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurAchievement extends Model
{
    use HasFactory;
    public static $achievement;
    public static $message;
    protected $guarded = [];

    public static function updateAchievementStatus($id)
    {
        self::$achievement = OurAchievement::find($id);
        if (self::$achievement->status == 1) {
            self::$achievement->status = 0;
            self::$message = 'Achievement info Unpublished Successfully ';
        } else {
            self::$achievement->status = 1;
            self::$message = 'Achievement info Published Successfully ';
        }
        self::$achievement->save();
        return  self::$message;
    }
}
