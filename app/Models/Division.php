<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;


    public static $division;
    public static $message;
    protected $guarded = [];

    public static function updateDivisionStatus($id)
    {
        self::$division = Division::find($id);
        if (self::$division->status == 1) {
            self::$division->status = 0;
            self::$message = 'Division info Unpublished Successfully ';
        } else {
            self::$division->status = 1;
            self::$message = 'Division info Published Successfully ';
        }
        self::$division->save();
        return  self::$message;
    }

    public function district()
    {
        return $this->hasMany(District::class);
    }
}
