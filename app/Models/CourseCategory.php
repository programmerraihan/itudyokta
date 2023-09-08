<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;


    public static $category;
    public static $message;
    protected $guarded = [];

    public static function updateCategoryStatus($id)
    {
        self::$category = CourseCategory::find($id);
        if (self::$category->status == 1) {
            self::$category->status = 0;
            self::$message = 'Category info Unpublished Successfully ';
        } else {
            self::$category->status = 1;
            self::$message = 'Category info Published Successfully ';
        }
        self::$category->save();
        return  self::$message;
    }
}
