<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public static $product;
    public static $message;
    protected $guarded = [];

    public static function newProduct($request)
    {
        self::saveBasicInfo(new Product(), $request);
    }

    public static function updateProductStatus($id)
    {
        self::$product = Product::find($id);
        if (self::$product->status == 1) {
            self::$product->status = 0;
            self::$message = 'Product info Unpublished Successfully ';
        } else {
            self::$product->status = 1;
            self::$message = 'Product info Published Successfully ';
        }
        self::$product->save();
        return  self::$message;
    }


    public static function updateProduct($request, $id)
    {
        self::$product = Product::find($id);

        self::saveBasicInfo(self::$product, $request);
    }



    public static function saveBasicInfo($product, $request)
    {

        $product->branch_id =  Auth::guard('branch')->user()->id ?? null;
        $product->name               = $request->name;
        $product->description        = $request->description;
        $product->status             = $request->status;
        $product->save();
    }
}
