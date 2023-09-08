<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Branch extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    public static $branch;
    public static $message;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard = 'branch';

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





    public static function updateBranchStatus($id)
    {
        self::$branch = Branch::find($id);
        if (self::$branch->status == 1) {
            self::$branch->status = 0;
            self::$message = 'branch info Pending Successfully ';
        } else {
            self::$branch->status = 1;
            self::$message = 'branch info Accepted Successfully ';
        }
        self::$branch->save();
        return  self::$message;
    }


    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }



    public function batch()
    {
        return $this->hasMany(Batch::class);
    }


    public function CourseTitle()
    {
        return $this->hasMany(CourseTitle::class);
    }

    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function StudentFeeCollection()
    {
        return $this->hasMany(StudentFeeCollections::class);
    }
}
