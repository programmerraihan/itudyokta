<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {
    use HasFactory;

    public static $assignment;
    public static $message;
    protected $guarded = [];

    public static function updateAssignmentStatus($id) {
        self::$assignment = Assignment::find($id);

        if (self::$assignment->status == 1) {
            self::$assignment->status = 0;
            self::$message            = 'Assignment info Unpublished Successfully ';
        } else {
            self::$assignment->status = 1;
            self::$message            = 'Assignment info Published Successfully ';
        }

        self::$assignment->save();
        return self::$message;
    }

    public function session() {
        return $this->belongsTo('App\Models\Session');
    }

    public function branch() {
        return $this->belongsTo('App\Models\Branch');
    }

    public function batch() {
        return $this->belongsTo('App\Models\Batch');
    }

    public function schedule() {
        return $this->belongsTo('App\Models\Schedule');
    }

    public function student_unit() {
        return $this->belongsTo('App\Models\StudentUnit');
    }

    public function course_title() {
        return $this->belongsTo('App\Models\CourseTitle');
    }

    public function teacher() {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function assignment() {
        return $this->hasMany(Assignment::class);
    }

}
