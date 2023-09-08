<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTitle extends Model
{
    use HasFactory;

    public static $course;
    public static $message;


    public static function updateCourseStatus($id)
    {
        self::$course = CourseTitle::find($id);
        if (self::$course->status == 1) {
            self::$course->status = 0;
            self::$message = 'course info Unpublished Successfully ';
        } else {
            self::$course->status = 1;
            self::$message = 'course info Published Successfully ';
        }
        self::$course->save();
        return  self::$message;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\CourseCategory');
    }

    public function batch()
    {
        return $this->hasMany(Batch::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function StudentFeeCollection()
    {
        return $this->hasMany(StudentFeeCollections::class);
    }
}
