<?php

namespace App\Models;

use App\Models\CourseTitle;
use Laravel\Sanctum\HasApiTokens;
use App\Models\StudentFeeCollections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    public static $student;
    public static $message;




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard = 'student';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function updateStudentStatus($id)
    {
        self::$student = Student::find($id);
        if (self::$student->status == 1) {
            self::$student->status = 0;
            self::$message = 'student info Unpublished Successfully ';
        } else {
            self::$student->status = 1;
            self::$message = 'student info Published Successfully ';
        }
        self::$student->save();
        if(self::$student->status == 1) {
            $name = self::$student->name;
            $mobile = self::$student->mobile;
            $sms_message = "আইটি উদ্যোক্তা ফাউন্ডেশন এর কম্পিউটার ট্রেনিং কোর্সে  আপনার ভর্তি  সম্পন্ন হয়েছে , {$name} and আপনার ইউজার আইডি: {$mobile}. আপনার লগইন ". route('login_from_student') . "";
            send_sms($mobile, $sms_message);
        }
        return  self::$message;
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }


    public function CourseTitle()
    {
        return $this->belongsTo(CourseTitle::class);
    }


    public function studentEduction()
    {
        return $this->hasMany(StudentEduction::class, 'student_id', 'id');
    }

    public function enrollment()
    {
        return $this->hasMany(Enrollment::class);
    }


    public function studentFee()
    {
        return $this->hasMany(StudentFee::class, 'student_id', 'id');
    }

    public function acTransaction()
    {
        return $this->hasMany(AcTransaction::class, 'student_id', 'id');
    }

    public function studentFeeCollections()
    {
        return $this->hasMany(StudentFeeCollections::class);
    }

    public function studentResult()
    {
        return $this->hasMany(StudentResult::class);
    }
}
