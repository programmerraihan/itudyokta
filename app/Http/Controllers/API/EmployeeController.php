<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('status', 1)->get();
        return response()->json([
            "status" => "success",
            "message" => "All employee list",
            "data" => $employees,
        ], 200);
    }
    public function store(Request $request)
    {
        $validator =  Validator::make(
            $request->all(),

            [
                'name'                          => 'required',
                'initial_name'                 => 'required',
                'department'                    => 'required',
                'designation'                   => 'required',
                'email'                         => 'required',
                'phon_number'                   => 'required',
                'room_no'                        => 'required',
                'emergency_number'              => 'required',
                'status'                        => 'required',
                // 'profile_image'                 => 'required',
            ],
        );
        if ($validator->fails()) {
            // dd($validator->getMessageBag());
            return redirect()->json([
                'status' => 422,
                'message' => $validator->getMessageBag()
            ], 422);
        } else {
            $employee = new Employee;
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
            // return $employee;
            return response()->json([
                'status' => "success",
                'message' => 'employee Created Successfully ',
                "data" => $employee,
            ], 200);
        }
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            return response()->json([
                "status" => "success",
                "message" => " single employee list",
                "employee" => $employee
            ], 200);
        } else {

            return response()->json([
                "status" => "404 ",
                "message" => " id not found",
                "employee" => "Employee  id not found"
            ], 404);
        }


        // simple id is show dada all null 
        // return response()->json([
        //     "status" => "success",
        //     "message" => " single employee list",
        //     "employee" => $employee
        // ], 200);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if ($employee) {

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
            $employee->update();
            return response()->json([
                "status" => "success",
                "message" => "  Employee  Update successfully",
                "employee" => $employee
            ], 200);
        } else {
            return response()->json([
                "status" => "404 ",
                "message" => " id not found",
                "employee" => "Employee  id not found"
            ], 404);
        }
    }
}
