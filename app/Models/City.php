<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;


    public static $city;
    public static $message;
    protected $guarded = [];

    public static function updateCityStatus($id)
    {
        self::$city = City::find($id);
        if (self::$city->status == 1) {
            self::$city->status = 0;
            self::$message = 'City info Unpublished Successfully ';
        } else {
            self::$city->status = 1;
            self::$message = 'City info Published Successfully ';
        }
        self::$city->save();
        return  self::$message;
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
}
