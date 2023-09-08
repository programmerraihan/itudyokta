<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    
    public static $session;
    public static $message;
    protected $guarded = [];

    public static function updateSessionStatus($id)
    {
        self::$session = Session::find($id);
        if (self::$session->status == 1) {
            self::$session->status = 0;
            self::$message = 'session info Unpublished Successfully ';
        } else {
            self::$session->status = 1;
            self::$message = 'session info Published Successfully ';
        }
        self::$session->save();
        return  self::$message;
    }

    public function batch()
    {
        return $this->hasMany(Batch::class);
    }

    public function StudentFeeCollection()
    {
        return $this->hasMany(StudentFeeCollections::class);
    }
}
