<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;
    public static $bank;
    public static $message;
    protected $guarded = [];

    public static function newBank($request)
    {
        self::saveBasicInfo(new Bank(), $request);
    }

    public static function updateBankStatus($id)
    {
        self::$bank = Bank::find($id);
        if (self::$bank->status == 1) {
            self::$bank->status = 0;
            self::$message = 'Unit info Unpublished Successfully ';
        } else {
            self::$bank->status = 1;
            self::$message = 'Unit info Published Successfully ';
        }
        self::$bank->save();
        return  self::$message;
    }


    public static function updateBank($request, $id)
    {
        self::$bank = Bank::find($id);

        self::saveBasicInfo(self::$bank, $request);
    }



    public static function saveBasicInfo($bank, $request)
    {
        // dd($request);
        $bank->branch_id          =  Auth::guard('branch')->user()->id ?? null;
        //  dd($bank->branch_id);

        $bank->name               = $request->name;
        $bank->description        = $request->description;
        $bank->status             = $request->status;
        // dd($bank);
        $bank->save();
    }

    public function StudentFeeCollection()
    {
        return $this->hasMany(StudentFeeCollections::class);
    }
}
