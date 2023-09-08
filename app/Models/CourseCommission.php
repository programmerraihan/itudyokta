<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'method', 'branch_id', 'course_title_id', 'student_id', 'amount', 'created_by', 'tran_type'
    ];

    public function branch() 
    {
        return $this->belongsTo(Branch::class);
    }

    public function courseTitle() 
    {
        return $this->belongsTo(CourseTitle::class);
    }

    public function student() 
    {
        return $this->belongsTo(Student::class);
    }
}
