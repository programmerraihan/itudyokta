<?php

namespace App\Models;

use App\Models\Student;
use App\Models\HomeWork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeWorkSubmit extends Model
{
    use HasFactory;

    public static $submit;
    public static $message;
    protected $guarded = [];

    public static function updateHomeWorkSubmitStatus($id)
    {
        self::$submit = HomeWorkSubmit::find($id);
        if (self::$submit->status == 1) {
            self::$submit->status = 0;
            self::$message = 'Home Work Submit Submit info Unpublished Successfully ';
        } else {
            self::$submit->status = 1;
            self::$message = 'Home Work Submit Submit info Published Successfully ';
        }
        self::$submit->save();
        return  self::$message;
    }


  
    public function student(){
        return $this->belongsTo(Student::class,('student_id'));
    }

    public function home_work(){
        return $this->belongsTo(HomeWork::class,('home_work_id'));
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
    
}
