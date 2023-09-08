<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    public static $employee;
    public static $message;
    public static $profile_image;
    public static $imageURL;
    public static $imageExtension;
    public static $imageName;
    public static $image;



    protected $table = 'employees';
    protected $fillable = [
        'name',
        'initial_name',
        'department',
        'designation',
        'email',
        'phon_number',
        'room_no',
        'emergency_number',
        'status',
        'profile_image',
    ];



    public static function getImageURL($request, $employee = null)
    {
        if (self::$profile_image = $request->file('profile_image')) {
            if ($employee) {
                if (file_exists(self::$employee->profile_image)) {
                    if ($employee->profile_image != 'dummy.png') {
                        unlink(self::$employee->profile_image);
                    }
                }
            }

            self::$imageExtension  = self::$profile_image->getClientOriginalExtension();  //

            self::$imageName       = str_replace(" ", "-", $request->name) . '-' . time() . '.' . self::$imageExtension;

            self::$imageURL        = imageUpload(self::$profile_image, 'employee-image/', self::$imageName);
        } else {
            if ($employee) {
                self::$imageURL = $employee->profile_image;
            } else {
                self::$imageURL = 'dummy.png';
            }
        }
        return  self::$imageURL;
    }




    public static function newEmployee($request)
    {
        return self::saveBasicInfo(new Employee(), $request,  self::getImageURL($request));
    }

    public static function updateStatus($id)
    {
        self::$employee = Employee::find($id);

        if (self::$employee->status == 1) {
            self::$employee->status = 0;
            self::$message = 'Employee info unpublished successfully';
        } else {
            self::$employee->status = 1;
            self::$message = 'Employee info published successfully';
        }
        self::$employee->save();
        return self::$message;
    }

    public static function updateEmployee($request, $id)
    {
        self::saveBasicInfo(Employee::find($id), $request, self::getImageURL($request, Employee::find($id)));
    }


    private static function saveBasicInfo($employee, $request, $imageURL)
    {
        $employee->branch_id                        =  Auth::guard('branch')->user()->id ?? null;
        $employee->name                             = $request->name;
        $employee->initial_name                     = $request->initial_name;
        $employee->department                       = $request->department;
        $employee->designation                      = $request->designation;
        $employee->email                            = $request->email;
        $employee->phon_number                      = $request->phon_number;
        $employee->room_no                          = $request->room_no;
        $employee->emergency_number                 = $request->emergency_number;
        $employee->profile_image                    = $imageURL;
        $employee->status                           = $request->status;
        $employee->save();
        return $employee;
    }


    public static function deleteEmployee($id)
    {
        self::$employee = Employee::find($id);
        self::$employee->delete();
    }
}
