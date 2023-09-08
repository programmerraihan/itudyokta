<?php

namespace App\Http\Controllers\BranchPanel\HomeWork;

use File;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Session;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\HomeWork;
use App\Models\Schedule;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\HomeWorkSubmit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BranchHomeWorkController  extends Controller
{
    public function add()
    {
        return view('branch.branch-panel.home-work.homework.manage', [

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

            $homework = new HomeWork();

            $homework->course_title_id          = $request->course_title_id;
            $homework->session_id               = $request->session_id;
            $homework->branch_id              = $request->branch_id;
            $homework->batch_id                 = $request->batch_id;
            $homework->schedule_id              = $request->schedule_id;
            $homework->teacher_id              = $request->teacher_id;
           
            $homework->submission_deadline              = $request->submission_deadline;
            $homework->submission_end_deadline              = $request->submission_end_deadline;
            $homework->description              = $request->description;
            $homework->title              = $request->title;
            $homework->status                   = $request->status;
         
            // Documents
         if ($request->hasFile('sample_copy')) {
                    $file = $request->file('sample_copy');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('admin/image/homework/', $filename);
                    $homework->sample_copy = $filename;
                }
         $homework->save();

        } catch (ValidationException $e) {
            DB::rollBack();
            var_dump($e->getErrors());
        }
        DB::commit();
        return Redirect::back()->with('message', 'Home Work info create successfully');
    } //End Method

    public function manage()
    {

         $id = Auth::guard('branch')->user()->id;
        $homeworks = HomeWork::where('branch_id', $id)->get();

        return view('branch.branch-panel.home-work.homework.show', compact('homeworks'));
    } //End Method

    public function completed()
    {

        $homeWorksSubmit = HomeWorkSubmit::where('status', 1)->get();
        // dd($homeWorksSubmit);
        return view('branch.branch-panel.home-work.homework.completed', compact('homeWorksSubmit'));
    }

    public function edit($id)
    {
        return view('branch.branch-panel.home-work.homework.edit', [
            'homework' =>     HomeWork::find($id),
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
        return  redirect()->back()->with('message', HomeWork::updateHomeWorkStatus($id));
    } //End Method

    public function update(Request $request, $id)
    {
        try {
            $homework = HomeWork::find($id);

            $homework->course_title_id          = $request->course_title_id;
            $homework->session_id               = $request->session_id;
            $homework->branch_id              = $request->branch_id;
            $homework->batch_id                 = $request->batch_id;
            $homework->schedule_id              = $request->schedule_id;
            $homework->teacher_id              = $request->teacher_id;
           
            $homework->submission_deadline              = $request->submission_deadline;
            $homework->submission_end_deadline              = $request->submission_end_deadline;
            $homework->description              = $request->description;
            $homework->title              = $request->title;
            $homework->status                   = $request->status;
         
            // Documents
         if ($request->hasFile('sample_copy')) {

                    $destination = 'admin/image/homework/' . $homework->sample_copy;
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $file = $request->file('sample_copy');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('admin/image/homework/', $filename);
                    $homework->sample_copy = $filename;
                }
         $homework->save();
           
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

        return redirect('branches/manage-homework')->with('message', ' home work  Update  successfully');
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
        $this->homework = HomeWork::find($id);
        //dd($this->service);
        $this->homework->delete();
        return redirect('branches/manage-homework')->with('message', 'homework info Delete Successfully');
    }






    
    
    
}
