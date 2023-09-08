<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentSubmittedAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assessment_question()
    {
        return $this->belongsTo(AssessmentQuestion::class, ('assessment_question_id'));
    }

    public function assessment_test_taker()
    {
        return $this->belongsTo(AssessmentTestTaker::class, ('assessment_test_taker_id'));
    }
}
