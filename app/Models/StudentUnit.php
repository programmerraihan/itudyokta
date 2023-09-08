<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentUnit extends Model
{
    use HasFactory;


    public static $unit;
    public static $message;
    protected $guarded = [];

    public static function updateStudentUnitStatus($id)
    {
        self::$unit = StudentUnit::find($id);
        if (self::$unit->status == 1) {
            self::$unit->status = 0;
            self::$message = 'StudentUnit info Unpublished Successfully ';
        } else {
            self::$unit->status = 1;
            self::$message = 'StudentUnit info Published Successfully ';
        }
        self::$unit->save();
        return  self::$message;
    }
}
