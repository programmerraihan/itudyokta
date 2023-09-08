<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public $customer;

    public function add()
    {
        return view('admin.employee.manage');
    }


    public function create(Request $request)
    {
        // return $request->all();
        // validation
        // $validator =  Validator::make(
        //     $request->all(),

        //     [
        //         'name'                          => 'required',
        //         'initial_name'                 => 'required',
        //         'department'                    => 'required',
        //         'designation'                   => 'required',
        //         'email'                         => 'required',
        //         'phon_number'                   => 'required',
        //         'number'                        => 'required',
        //         'emergency_number'              => 'required',
        //         'status'                        => 'required',
        //         'profile_image'                 => 'required',
        //     ],
        // );
        // if ($validator->fails()) {
        //     // dd($validator->getMessageBag());
        //     return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        // }


        $this->customer = Employee::newEmployee($request);
        return redirect('/add-new-employee')->with('message', 'Employee info create successfully');
    }



    public function manage()
    {
        return view('admin.employee.show', ['employees' => Employee::orderBy('id', 'desc')->take('1000')->get(['id', 'name', 'initial_name', 'department', 'status', 'email'])]);
    }


    public function detail($id)
    {
        return view('admin.employee.detail', ['employee' => Employee::find($id)]);
    }

    public function edit($id)
    {
        return view('admin.employee.edit', ['employee'    => Employee::find($id)]);
    }


    public function update(Request $request, $id)
    {
        Employee::updateEmployee($request, $id);
        return redirect('/manage-employee')->with('message', 'Employee info update successfully');
    }


    public function updateStatus($id)
    {
        return redirect()->back()->with(Employee::updateStatus($id));
    }

    public function delete(Request $request, $id)
    {

        // $this->color = Color::find($id);
        // $this->color->delete();
        // return redirect('color')->with('message', 'Color info delete successfully.');

        Employee::deleteEmployee($id);
        return redirect('/manage-employee')->with('message', 'Employee info delete successfully.');
    }
}
