<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;

    public static $slider;
    public static $message;

    protected $guarded = [];

    // protected $fillable = [
    //     'title',
    //     'short_title',
    //     'home_slide',
    //     'video_url',
    // ];



    public static function updateStatus($id)
    {
        self::$slider = HomeSlide::find($id);

        if (self::$slider->status == 1) {
            self::$slider->status = 0;
            self::$message = 'Home Slide info unpublished successfully';
        } else {
            self::$slider->status = 1;
            self::$message = 'Home Slide info published successfully';
        }
        self::$slider->save();
        return self::$message;
    }

    public static function deleteSlider($id)
    {
        self::$slider = Employee::find($id);
        self::$slider->delete();
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

}
