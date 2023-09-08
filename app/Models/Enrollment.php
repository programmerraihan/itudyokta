<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function course_title()
    {
        return $this->belongsTo('App\Models\CourseTitle');
    }

    public function session()
    {
        return $this->belongsTo('App\Models\Session');
    }

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Models\Schedule');
    }

    public function studentResult()
    {
        return $this->hasMany(StudentResult::class);
    }
}
