<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    public static $supplier;
    public static $message;
    protected $guarded = [];

    public static function newSupplier($request)
    {
        self::saveBasicInfo(new Supplier(), $request);
    }

    public static function updateSupplierStatus($id)
    {
        self::$supplier = Supplier::find($id);
        if (self::$supplier->status == 1) {
            self::$supplier->status = 0;
            self::$message = 'Unit info Unpublished Successfully ';
        } else {
            self::$supplier->status = 1;
            self::$message = 'Unit info Published Successfully ';
        }
        self::$supplier->save();
        return  self::$message;
    }


    public static function updateSupplier($request, $id)
    {
        self::$supplier = Supplier::find($id);

        self::saveBasicInfo(self::$supplier, $request);
    }



    public static function saveBasicInfo($supplier, $request)
    {
        $supplier->branch_id =  Auth::guard('branch')->user()->id ?? null;
        $supplier->name               = $request->name;
        $supplier->description        = $request->description;
        $supplier->status             = $request->status;
        $supplier->save();
    }
}
