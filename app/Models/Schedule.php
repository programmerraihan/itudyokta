<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];
    public static $schedule;
    public static $message;



    protected function day(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }


    public static function updateScheduleStatus($id)
    {
        self::$schedule = Schedule::find($id);
        if (self::$schedule->status == 1) {
            self::$schedule->status = 0;
            self::$message = 'schedule info Unpublished Successfully ';
        } else {
            self::$schedule->status = 1;
            self::$message = 'schedule info Published Successfully ';
        }
        self::$schedule->save();
        return  self::$message;
    }




    public function courseTitle()
    {
        return $this->belongsTo('App\Models\CourseTitle', 'courseTitle_id');
    }

    // public function courseTitle()
    // {
    //     return $this->hasMany(CourseTitle::class);
    // }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
