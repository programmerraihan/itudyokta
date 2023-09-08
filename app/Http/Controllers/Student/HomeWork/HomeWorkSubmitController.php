<?php

namespace App\Http\Controllers\Student\HomeWork;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\HomeWork;
use App\Models\HomeWorkSubmit;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeWorkSubmitController extends Controller {

    public function showWork() {
        $id         = Auth::guard('student')->user()->id;
        $enrollment = Enrollment::where('student_id', $id)->latest('id')->first();
        //dd($enrollment);
        $homeworks = HomeWork::where('status', 1)
            ->where('session_id', $enrollment->session_id)
            ->where('branch_id', $enrollment->branch_id)
            ->where('batch_id', $enrollment->batch_id)
            ->where('schedule_id', $enrollment->schedule_id)
            ->where('course_title_id', $enrollment->course_title_id)
            ->get();
        // dd($homeworks);
        return view('student.student.homework.show', compact('homeworks'));
    }

    public function add() {
        return view('student.student.homework.add');
    }

    public function create(Request $request) {
    //    return $request->all();

        $student_id = Auth::guard('student')->user()->id;
        try {
            DB::commit();

            $homework = new HomeWorkSubmit();

            $homework->student_id = $student_id;

            $homework->answers = $request->input('answers');
            $homework->status  = $request->input('status');

            if ($request->hasFile('file')) {
                $file      = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename  = time() . '.' . $extension;
                $file->move('student/student/homework', $filename);
                $homework->file = $filename;
            }

            $homework->save();
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception->getMessage();
        }

        return redirect()->route('submitted.homework.manage')->with('message', 'Our HomeWork Submit info Submit successfully');
    }

    //End Method

    public function manage() {
        $homeworks = HomeWorkSubmit::all();
        return view('student.student.homework.manage', compact('homeworks'));
    }
    //End Method

    public function edit($id) {

        //dd($id);
        $homeWork = HomeWork::find($id);

       // dd($assignmentSubmit);
        return view('student.student.homework.edit', compact('homeWork'));
    }
    //End Method

    public function update(Request $request, $id) {
      //return $request->all();
       $student_id = Auth::guard('student')->user()->id;
       $homework = new HomeWorkSubmit();

        $homework->home_work_id = $request->homeWork_id;

        $homework->answers = $request->input('assignment_detail');
        $homework->status            = $request->input('status');
        $homework->student_id            = $student_id;

        if ($request->hasFile('assignment_file')) {
            $file      = $request->file('assignment_file');
            $extension = $file->getClientOriginalExtension();
            $filename  = time() . '.' . $extension;
            $file->move('student/student/homework', $filename);
            $homework->file = $filename;
        }

        $homework->save();
        return redirect()->route('submitted.homework.manage')->with('message', 'Our HomeWork Submit Update successfully');

    }

    public function updateStatus($id) {
        return redirect()->back()->with('message', HomeWorkSubmit::updateHomeWorkSubmitStatus($id));
    }

    public function destroy($id) {
        $assignmentSubmit = HomeWorkSubmit::find($id);
        $assignmentSubmit->delete();
        return redirect()->back()->with('message', 'Our HomeWork Submit in fo Delete Successfully');
    }

}
