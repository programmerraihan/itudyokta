<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    public static $gallery;
    public static $message;
    protected $guarded = [];

    public static function updateGalleryStatus($id)
    {
        self::$gallery = Gallery::find($id);
        if (self::$gallery->status == 1) {
            self::$gallery->status = 0;
            self::$message = 'Project info Unpublished Successfully ';
        } else {
            self::$gallery->status = 1;
            self::$message = 'Project info Published Successfully ';
        }
        self::$gallery->save();
        return  self::$message;
    }
}
