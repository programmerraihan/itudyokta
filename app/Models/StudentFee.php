<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function StudentFeeCollection()
    {
        return $this->hasMany(StudentFeeCollections::class);
    }

    public function ac_head()
    {
        return $this->belongsTo(AccountHead::class, 'account_head_id');
    }
}
