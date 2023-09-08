<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurProject extends Model
{
    use HasFactory;

    public static $project;
    public static $message;
    protected $guarded = [];

    public static function updateProjectStatus($id)
    {
        self::$project = OurProject::find($id);
        if (self::$project->status == 1) {
            self::$project->status = 0;
            self::$message = 'Project info Unpublished Successfully ';
        } else {
            self::$project->status = 1;
            self::$message = 'Project info Published Successfully ';
        }
        self::$project->save();
        return  self::$message;
    }
}
