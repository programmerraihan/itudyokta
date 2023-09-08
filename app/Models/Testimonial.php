<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    public static $testimonial;
    public static $message;
    protected $guarded = [];

    public static function updateTestimonialStatus($id)
    {
        self::$testimonial = Testimonial::find($id);
        if (self::$testimonial->status == 1) {
            self::$testimonial->status = 0;
            self::$message = 'Testimonial info Unpublished Successfully ';
        } else {
            self::$testimonial->status = 1;
            self::$message = 'Testimonial info Published Successfully ';
        }
        self::$testimonial->save();
        return  self::$message;
    }
}
