<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineExamResult extends Model
{
    use HasFactory;

    protected $table = 'offline_exam_results';

    protected $fillable = [
        'student_id', 'enrollment_id', 'marks', 'status', 'total', 'cgpa', 'grade',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class); 
    }
}
