<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentQuestionDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function assessment_question()
    {
        return $this->belongsTo(AssessmentQuestion::class, ('assessment_question_id'));
    }
}
