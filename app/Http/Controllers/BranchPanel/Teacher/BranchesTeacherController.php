<?php

namespace App\Http\Controllers\BranchPanel\Teacher;

use File;

use App\Models\Branch;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\TeacherCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesTeacherController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.teacher.teacher.index', [
            'teachers' =>  Teacher::where('branch_id', $id)->select(['id', 'name', 'phone', 'photo', 'email', 'status'])->get(),

        ]);
    }

    public function addTeacher()
    {
        $id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.teacher.teacher.add', [
            'categories'  => TeacherCategory::where('branch_id', $id)->where('status', 1)->get(['id', 'name']),
        ]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        try {
            DB::commit();

            $id =  Auth::guard('branch')->user()->id;

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('image/teacher/', $filename);
            }
            $inputs = [
                "name"                  => $request->name,
                "photo"                 => $filename,
                "branch_id"             => $id,

                "phone"                 => $request->phone,
                "email"                 => $request->email,
                "birth_date"            => $request->birth_date,
                "blood_group"           => $request->blood_group,

                "passport_no"            => $request->passport_no,
                "passport_expiry_date"   => $request->passport_expiry_date,
                "marital_status"         => $request->marital_status,
                "father_name"            => $request->father_name,
                "mother_name"            => $request->mother_name,
                "spouse_name"            => $request->spouse_name,
                "gender"                 => $request->gender,
                "religion"               => $request->religion,
                "nationality"            => $request->nationality,

                "present_address"           => $request->present_address,
                "permanent_address"         => $request->permanent_address,
                "emergency_contact_name"    => $request->emergency_contact_name,
                "emergency_contact_no"      => $request->emergency_contact_no,
                "emergency_relationship"    => $request->emergency_relationship,
                "emergency_address"         => $request->emergency_address,

                "edu_qualification"        => $request->edu_qualification,
                "teacher_code"             => $request->teacher_code,
                "designation"              => $request->designation,
                "designation"              => $request->designation,
                "branch_id"                => $id,
                "teacher_categories_id"    => $request->teacher_categories_id,
                "status"                   => $request->status,
            ];
            Teacher::create($inputs);
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception->getMessage());
        }

        return redirect('branches/teacher-index')->with('message', 'Teacher info create successfully');
    } //End Method


    public function edit($id)
    {

        $branch_id = Auth::guard('branch')->user()->id;
        return view('branch.branch-panel.teacher.teacher.edit', [

            'teacher' => Teacher::find($id),
            'categories'  => TeacherCategory::where('status', 1)->where('branch_id', $branch_id)->get(['id', 'name']),
        ]);
    } //End Method



    public function update(Request $request, $id)
    {
        // return $request->all();
        try {
            DB::commit();

            $teacher = Teacher::findOrfail($id);
            $filename = $teacher->photo;

            $id =  Auth::guard('branch')->user()->id;


            if ($request->hasFile('photo')) {

                $destination = 'image/teacher/' . $teacher->photo;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('image/teacher/', $filename);
            }
            $teacher->update([
                "name"                => $request->name,
                "photo"               => $filename,
                "branch_id"            => $id,


                "phone"               => $request->phone,
                "email"               => $request->email,
                "birth_date"          => $request->birth_date,
                "blood_group"         => $request->blood_group,

                "passport_no"            => $request->passport_no,
                "passport_expiry_date"   => $request->passport_expiry_date,
                "marital_status"         => $request->marital_status,
                "father_name"            => $request->father_name,
                "mother_name"            => $request->mother_name,
                "spouse_name"            => $request->spouse_name,
                "gender"                 => $request->gender,
                "religion"               => $request->religion,
                "nationality"            => $request->nationality,

                "present_address"           => $request->present_address,
                "permanent_address"         => $request->permanent_address,
                "emergency_contact_name"    => $request->emergency_contact_name,
                "emergency_contact_no"      => $request->emergency_contact_no,
                "emergency_relationship"    => $request->emergency_relationship,
                "emergency_address"         => $request->emergency_address,

                "edu_qualification"        => $request->edu_qualification,
                "teacher_code"             => $request->teacher_code,
                "designation"              => $request->designation,
                "designation"              => $request->designation,
                "branch_id"                => $id,
                "teacher_categories_id"    => $request->teacher_categories_id,
                "status"                   => $request->status,
            ]);
            //  Teacher::updated($inputs);

        } catch (\Exception $exception) {
            DB::rollback();
            return $exception->getMessage();
        }

        return redirect('branches/teacher-index')->with('message', ' Teacher info Update successfully');
    }



    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Teacher::updateTeacherStatus($id));
    }



    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect('branches/teacher-index')->with('message', 'Teacher info Delete Successfully');
    }
}
