<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentExam extends Model
{
    use HasFactory;

    public static $AssessmentExam;
    public static $message;

    protected $guarded = [];

    public function session()
    {
        return $this->belongsTo(Session::class, ('session_id'));
    }

    public static function updateStatus($id)
    {
        self::$AssessmentExam = AssessmentExam::find($id);

        if (self::$AssessmentExam->status == 1) {
            self::$AssessmentExam->status = 0;
            self::$AssessmentExam = 'Assessment Exam info Refuse successfully';
        } else {
            self::$AssessmentExam->status = 1;
            self::$message = ' Assessment Exam  info Process successfully';
        }
        self::$AssessmentExam->save();
        return self::$message;
    }

    public static function deleteAssessmentExam($id)
    {
        self::$AssessmentExam = AssessmentExam::find($id);
        self::$AssessmentExam->delete();
    }

    public function question()
    {
        return $this->belongsTo(AssessmentQuestionMaster::class, 'question_id');
    }
}
