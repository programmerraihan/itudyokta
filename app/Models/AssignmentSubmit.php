<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmit extends Model
{
    use HasFactory;

    public static $submit;
    public static $message;
    protected $guarded = [];

    public static function updateAssignmentSubmitStatus($id)
    {
        self::$submit = AssignmentSubmit::find($id);
        if (self::$submit->status == 1) {
            self::$submit->status = 0;
            self::$message = 'Assignment Submit info Unpublished Successfully ';
        } else {
            self::$submit->status = 1;
            self::$message = 'Assignment Submit info Published Successfully ';
        }
        self::$submit->save();
        return  self::$message;
    }



    public function student()
    {
        return $this->belongsTo(Student::class, ('student_id'));
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, ('homework_assignment_id'));
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
}
