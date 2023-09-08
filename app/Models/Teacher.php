<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    public static $teacher;
    public static $message;
    protected $guarded = [];



    public static function updateTeacherStatus($id)
    {
        self::$teacher = Teacher::find($id);
        if (self::$teacher->status == 1) {
            self::$teacher->status = 0;
            self::$message = 'Teacher info Unpublished Successfully ';
        } else {
            self::$teacher->status = 1;
            self::$message = 'Teacher info Published Successfully ';
        }
        self::$teacher->save();
        return  self::$message;
    }


    // public static function updateTeacherStatus($id)
    // {
    //     self::$teacher = Teacher::find($id);
    //     if (self::$teacher->status == 1) {
    //         self::$teacher->status = 0;
    //         self::$message = 'Teacher info Unpublished Successfully ';
    //     } else {
    //         self::$teacher->status = 1;
    //         self::$message = 'Teacher info Published Successfully ';
    //     }
    //     self::$teacher->save();
    //     return  self::$message;
    // }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function teacherCategory()
    {
        return $this->belongsTo('App\Models\TeacherCategory');
    }
}
