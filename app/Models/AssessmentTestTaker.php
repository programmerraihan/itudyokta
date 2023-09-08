<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentTestTaker extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assessment_submitted_answer()
    {
        return $this->hasMany(AssessmentSubmittedAnswer::class);
    }
    public function assessment_exam()
    {
        return $this->belongsTo(AssessmentExam::class, ('assessment_exam_id'));
    }
}
