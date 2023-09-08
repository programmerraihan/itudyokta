<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    
    public static $district;
    public static $message;
    protected $guarded = [];

    public static function updateDistrictStatus($id)
    {
        self::$district = District::find($id);
        if (self::$district->status == 1) {
            self::$district->status = 0;
            self::$message = 'Division info Unpublished Successfully ';
        } else {
            self::$district->status = 1;
            self::$message = 'Division info Published Successfully ';
        }
        self::$district->save();
        return  self::$message;
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function city()
    {
        return $this->hasMany(City::class);
    }

   

}
