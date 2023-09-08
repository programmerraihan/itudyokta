<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public static $contact;
    public static $message;
    protected $guarded = [];

    public static function updateContactStatus($id)
    {
        self::$contact = Contact::find($id);
        if (self::$contact->status == 1) {
            self::$contact->status = 0;
            self::$message = 'Contact info Unpublished Successfully ';
        } else {
            self::$contact->status = 1;
            self::$message = 'Contact info Published Successfully ';
        }
        self::$contact->save();
        return  self::$message;
    }

}
