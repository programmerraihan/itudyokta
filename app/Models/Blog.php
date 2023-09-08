<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public static $blog;
    public static $message;
    protected $guarded = [];

    public static function updateBlogStatus($id)
    {
        self::$blog = Blog::find($id);
        if (self::$blog->status == 1) {
            self::$blog->status = 0;
            self::$message = 'Blog info Unpublished Successfully ';
        } else {
            self::$blog->status = 1;
            self::$message = 'Blog info Published Successfully ';
        }
        self::$blog->save();
        return  self::$message;
    }
}
