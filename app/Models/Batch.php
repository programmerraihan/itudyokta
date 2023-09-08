<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;


    public static $batch;
    public static $message;
    protected $guarded = [];


    public static function updateBatchStatus($id)
    {
        self::$batch = Batch::find($id);
        if (self::$batch->status == 1) {
            self::$batch->status = 0;
            self::$message = 'Batch info Unpublished Successfully ';
        } else {
            self::$batch->status = 1;
            self::$message = 'Batch info Published Successfully ';
        }
        self::$batch->save();
        return  self::$message;
    }



    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }




    public function course()
    {
        return $this->belongsTo(CourseTitle::class, 'course_title_id');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function StudentFeeCollection()
    {
        return $this->hasMany(StudentFeeCollections::class);
    }
}
