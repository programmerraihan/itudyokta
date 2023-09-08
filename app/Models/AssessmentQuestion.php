<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function assessment_question_master()
    {
        return $this->belongsTo(AssessmentQuestionMaster::class, ('assessment_question_master_id'));
    }
    public function assessment_question_detail()
    {
        return $this->hasMany(AssessmentQuestionDetail::class);
    }
    public function assessment_submitted_answer()
    {
        return $this->hasMany(AssessmentSubmittedAnswer::class);
    }
}
