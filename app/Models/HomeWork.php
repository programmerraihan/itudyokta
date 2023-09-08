<?php

namespace App\Models;

use App\Models\HomeWorkSubmit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeWork extends Model
{
    use HasFactory;
    
    protected $guarded=[];

    public static $homework;
    public static $message;

    public static function updateHomeWorkStatus($id)
    {
        self::$homework = HomeWork::find($id);
        if (self::$homework->status == 1) {
            self::$homework->status = 0;
            self::$message = 'Home Work info Unpublished Successfully ';
        } else {
            self::$homework->status = 1;
            self::$message = 'Home Work info Published Successfully ';
        }
        self::$homework->save();
        return  self::$message;
    }



    public function session()
    {
        return $this->belongsTo('App\Models\Session');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Models\Schedule');
    }


    public function student_unit()
    {
        return $this->belongsTo('App\Models\StudentUnit');
    }


    public function course_title()
    {
        return $this->belongsTo('App\Models\CourseTitle');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function home_work_submit(){
        return $this->hasMany(HomeWorkSubmit::class);
    }

}