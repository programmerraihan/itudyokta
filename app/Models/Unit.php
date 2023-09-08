<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    public static $unit;
    public static $message;
    protected $guarded = [];

    public static function newUnit($request)
    {
        self::saveBasicInfo(new Unit(), $request);
    }

    public static function updateUnitStatus($id)
    {
        self::$unit = Unit::find($id);
        if (self::$unit->status == 1) {
            self::$unit->status = 0;
            self::$message = 'Unit info Unpublished Successfully ';
        } else {
            self::$unit->status = 1;
            self::$message = 'Unit info Published Successfully ';
        }
        self::$unit->save();
        return  self::$message;
    }


    public static function updateUnit($request, $id)
    {
        self::$unit = Unit::find($id);

        self::saveBasicInfo(self::$unit, $request);
    }



    public static function saveBasicInfo($unit, $request)
    {
        $unit->branch_id =  Auth::guard('branch')->user()->id ?? null;
        $unit->name               = $request->name;
        $unit->description        = $request->description;
        $unit->status             = $request->status;
        $unit->save();
    }
}
