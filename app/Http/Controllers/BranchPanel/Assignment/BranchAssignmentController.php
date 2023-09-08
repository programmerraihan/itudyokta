<?php

namespace App\Http\Controllers\BranchPanel\Assignment;

use File;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Teacher;
use App\Models\Schedule;
use App\Models\Assignment;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\AssignmentSubmit;

class BranchAssignmentController extends Controller
{
    public function add()
    {
        return view('branch.branch-panel.assignment.manage', [

             $id = Auth::guard('branch')->user()->id,
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $id)->get(),
            'sessions' => Session::where('status', 1)->where('branch_id', $id)->get(),
            'teachers' => Teacher::where('status', 1)->where('branch_id', $id)->get(),

        ]);
    } //End Method

    public function create(Request $request)
    {
     // return $request->all();

      DB::beginTransaction();
      try {

            $assignment = new Assignment();

            $assignment->course_title_id          = $request->course_title_id;
            $assignment->session_id               = $request->session_id;
            $assignment->branch_id              = $request->branch_id;
            $assignment->batch_id                 = $request->batch_id;
            $assignment->schedule_id              = $request->schedule_id;
            $assignment->teacher_id              = $request->teacher_id;
           
            $assignment->submission_deadline              = $request->submission_deadline;
            $assignment->submission_end_deadline              = $request->submission_end_deadline;
            $assignment->description              = $request->description;
            $assignment->title              = $request->title;
            $assignment->status                   = $request->status;
         
            // Documents
         if ($request->hasFile('sample_copy')) {
                    $file = $request->file('sample_copy');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('admin/image/homework/', $filename);
                    $assignment->sample_copy = $filename;
                }
         $assignment->save();

        } catch (ValidationException $e) {
            DB::rollBack();
            var_dump($e->getErrors());
        }
        DB::commit();
        return Redirect::back()->with('message', 'Home Work info create successfully');
    } //End Method

    public function manage()
    {
        return view('branch.branch-panel.assignment.show', [
            $id = Auth::guard('branch')->user()->id,
            'assignments' => Assignment::where('status', 1)->where('branch_id', $id)->get(['id', 'title', 'batch_id', 'submission_deadline', 'submission_end_deadline',  'branch_id', 'status']),
        ]);
    } //End Method

    public function completed()
    {
        return view('branch.branch-panel.assignment.completed',[
             $id = Auth::guard('branch')->user()->id,
            'assignments' => Assignment::where('branch_id', $id)->get(['id', 'title', 'batch_id', 'submission_deadline', 'submission_end_deadline',  'branch_id', 'status']),
        ]);
    }

    public function edit($id)
    {
        return view('branch.branch-panel.assignment.edit', [

            $id = Auth::guard('branch')->user()->id,

            'assignment' =>     Assignment::find($id),
            'courseTitles' => CourseTitle::where('status', 1)->where('branch_id', $id)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->where('branch_id', $id)->get(),
            'schedules' => Schedule::where('status', 1)->where('branch_id', $id)->get(),
            'sessions' => Session::where('status', 1)->where('branch_id', $id)->get(),
            'teachers' => Teacher::where('status', 1)->where('branch_id', $id)->get(),
        ]);
    } //End Method

    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Assignment::updateAssignmentStatus($id));
    } //End Method

    public function update(Request $request, $id)
    {
        try {
            $assignment = Assignment::find($id);

            $assignment->course_title_id          = $request->course_title_id;
            $assignment->session_id               = $request->session_id;
            $assignment->branch_id              = $request->branch_id;
            $assignment->batch_id                 = $request->batch_id;
            $assignment->schedule_id              = $request->schedule_id;
            $assignment->teacher_id              = $request->teacher_id;
           
            $assignment->submission_deadline              = $request->submission_deadline;
            $assignment->submission_end_deadline              = $request->submission_end_deadline;
            $assignment->description              = $request->description;
            $assignment->title              = $request->title;
            $assignment->status                   = $request->status;
         
            // Documents
         if ($request->hasFile('sample_copy')) {

                    $destination = 'admin/image/assignment/' . $assignment->sample_copy;
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $file = $request->file('sample_copy');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('admin/image/assignment/', $filename);
                    $assignment->sample_copy = $filename;
                }
         $assignment->save();
           
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

        return redirect('/assignment-manage')->with('message', ' Assignment  Update  successfully');
    }

     
    // public function destroy($id)
    // {
    //     $this->homework = HomeWork::find($id);
    //     // dd($this->director);
    //     $this->homework->delete();
    //     return redirect('/manage-homework')->with('message', 'homework info Delete Successfully');
    // }

    public function destroy($id)
    {
        $assignment = Assignment::find($id);
        //dd($this->service);
        $assignment->delete();
        return redirect('/manage-assignment')->with('message', 'Assignment info Delete Successfully');
    }


    public function ssa()
    {

     
        return view('branch.branch-panel.assignment.ssa', [
            $id = Auth::guard('branch')->user()->id,
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->where('id', $id)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            
        ]);
    }

    
    public function assignmentDownload(Request $request)
    {
        $org_info   = Branch::where('status', 1)->where('id',  $request->branch_id)->orderBy('id', 'DESC')->first();
        $branch_id   = $request->branch_id;
        $course_title_id  = $request->course_title_id;
       
        $results = AssignmentSubmit::where('status', 1)->where('branch_id', $branch_id)
            ->where('course_title_id', $course_title_id)
            ->with('student')
            ->get();
        return view('branch.branch-panel.assignment.assesment_result', compact('results', 'org_info'));
    }

    
    public function assignmentEditNumber($id)
    {
        $assignment =  AssignmentSubmit::find($id);
        return view('branch.branch-panel.assignment.result_edit', compact('assignment'));
    } //End Method

    public function assignmentUpdate(Request $request, $id)
    {
        $assignment =  AssignmentSubmit::find($id);
        $assignment->result =$request->result;
        $assignment->save();
        return redirect()->route('branch.student.submitted.assignment')->with('message', ' submitted  Update  successfully');
    } //End Method

    



}
