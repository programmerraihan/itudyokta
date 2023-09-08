<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'student_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
