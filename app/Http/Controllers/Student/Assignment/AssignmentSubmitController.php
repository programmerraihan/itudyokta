<?php

namespace App\Http\Controllers\Student\Assignment;

use App\Http\Controllers\Controller;

use App\Models\Assignment;
use App\Models\AssignmentSubmit;
use App\Models\Enrollment;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class AssignmentSubmitController extends Controller {

    public function show() {

        $id = Auth::guard('student')->user()->id;

        $enrollment = Enrollment::where('student_id', $id)->latest('id')->first();

        $assignments = Assignment::where('status', 1)
            ->where('session_id', $enrollment->session_id)
            ->where('branch_id', $enrollment->branch_id)
            ->where('batch_id', $enrollment->batch_id)
            ->where('schedule_id', $enrollment->schedule_id)
            ->where('course_title_id', $enrollment->course_title_id)
            ->get();
        return view('student.student.assignment.show', compact('assignments'));
    }

    public function add( $id) {
        return view('student.student.assignment.add');
    }

    public function create(Request $request) {


         // return $request->all();

          $id = Auth::guard('student')->user()->id;

          $student =  Student::where('id', $id)->first();
         

        $ass_submit = new AssignmentSubmit();

        $ass_submit->student_id = $id;

        $ass_submit->assignment_detail = $request->input('assignment_detail');
        $ass_submit->homework_assignment_id = $request->input('assignment_id');
        $ass_submit->status            = $request->input('status');

        $ass_submit->branch_id            = $student->branch_id;
        $ass_submit->course_title_id            = $student->course_title_id;
        

        if ($request->hasFile('assignment_file')) {
            $file      = $request->file('assignment_file');
            $extension = $file->getClientOriginalExtension();
            $filename  = time() . '.' . $extension;
            $file->move('student/student/assignment/', $filename);
            $ass_submit->assignment_file = $filename;
        }

        $ass_submit->save();
        return redirect('/student/manage-submitted-assignment')->with('message', 'Our Assignment Submit info Submit successfully');
    }

    //End Method

    public function manage() {
        $assignmentSubmits = AssignmentSubmit::with('assignment')->get();
        return view('student.student.assignment.manage', compact('assignmentSubmits'));
    }

    //End Method

    public function edit($id) {
        // dd($id);
        $assignment = Assignment::find($id);
       
        return view('student.student.assignment.edit', compact('assignment'));
    }

    //End Method

    public function update(Request $request, $id) {

        $ass_submit = AssignmentSubmit::find($id);
        $id = Auth::guard('student')->user()->id;

    
        $ass_submit->assignment_detail = $request->input('assignment_detail');
        $ass_submit->homework_assignment_id = $ass_submit;
        $ass_submit->status            = $request->input('status');
        $ass_submit->student_id = $id;

        if ($request->hasFile('assignment_file')) {
            $file      = $request->file('assignment_file');
            $extension = $file->getClientOriginalExtension();
            $filename  = time() . '.' . $extension;
            $file->move('student/student/assignment/', $filename);
            $ass_submit->assignment_file = $filename;
        }

        $ass_submit->save();
        return redirect('student/manage-submitted-assignment')->with('message', 'Our Assignment Submit  Update successfully');

    }

    public function updateStatus($id) {
        return redirect()->back()->with('message', AssignmentSubmit::updateAssignmentSubmitStatus($id));
    }

    public function destroy($id) {
        $assignmentSubmit = AssignmentSubmit::find($id);
        // dd($this->project);
        $assignmentSubmit->delete();
        return redirect('student/manage-submitted-assignment')->with('message', 'Our Assignment Submit info Delete Successfully');
    }

}
