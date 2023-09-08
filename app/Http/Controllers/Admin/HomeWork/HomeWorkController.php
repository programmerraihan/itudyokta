<?php

namespace App\Http\Controllers\Admin\HomeWork;

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
use Illuminate\Support\Facades\Redirect;
use File;

class HomeWorkController extends Controller
{
    public function add()
    {
        return view('admin.admin.hw-assignment.homework.manage', [

            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'teachers' => Teacher::where('status', 1)->get(),

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
        return view('admin.admin.hw-assignment.homework.show', [
            'homeworks' => HomeWork::where('status', 1)->get(['id', 'title', 'batch_id', 'submission_deadline', 'submission_end_deadline',  'branch_id', 'status']),
        ]);
    } //End Method

    public function pending()
    {
        return view('admin.admin.hw-assignment.homework.show',[
            'homeworks' => HomeWork::where('status', 0)->get(['id', 'title', 'batch_id', 'submission_deadline', 'submission_end_deadline',  'branch_id', 'status']),
        ]);
    }

    public function edit($id)
    {
        return view('admin.admin.hw-assignment.homework.edit', [
            'homework' =>     HomeWork::find($id),
            'courseTitles' => CourseTitle::where('status', 1)->get(),
            'branches' => Branch::where('status', 1)->get(),
            'batches' => Batch::where('status', 1)->get(),
            'schedules' => Schedule::where('status', 1)->get(),
            'sessions' => Session::where('status', 1)->get(),
            'teachers' => Teacher::where('status', 1)->get(),
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

        return redirect('/manage-homework')->with('message', ' home work  Update  successfully');
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
        return redirect('/manage-homework')->with('message', 'homework info Delete Successfully');
    }






    
    
    
}
