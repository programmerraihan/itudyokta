<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_status',
        'stu_details_id',
        'attendance_date',
        'in_time',
        'out_time',
        'status',
        'user_id',
        'branch_id',


    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'student_id', 'id');
    }


    // public function student_details()
    // {
    //     return $this->belongsTo(::class, 'stu_details_id');
    // }
}
