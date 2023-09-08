<?php

namespace App\Http\Controllers;

use App\Models\OfflineExamResult;
use App\Models\Student;
use App\Models\StudentResult;
use Illuminate\Http\Request;

class OfflineExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentResults = OfflineExamResult::with(['student', 'enrollment', 'enrollment.course_title'])
        ->whereIn('student_id', function($query) {
            return $query->select('id')->from('students')->where('branch_id', auth('branch')->user()->id);
        })->get();
        return view('branch.branch-panel.result.offline.index', compact('studentResults'));
    }

    public function dateStore(Request $request) 
    {
        $request->validate([
            "id" => ["required"],
            "issue_date" => ["required"],
            "held_from" => ["required"],
            "held_to" => ["required"],
        ]);
        $studentResult = OfflineExamResult::findOrFail($request->id);
        $studentResult->issue_date = $request->issue_date;
        $studentResult->held_from = $request->held_from;
        $studentResult->held_to = $request->held_to;
        $studentResult->save();
        return redirect()->back()->with('message', "Student date set succesfull!");
    }

    public function list()
    {
        $studentResults = OfflineExamResult::with(['student', 'enrollment', 'enrollment.course_title'])
        ->get();
        return view("admin.admin.result.online", compact('studentResults'));
    }

    public function approved($id) 
    {
        $result = OfflineExamResult::findOrFail($id);
        $result->status = 'approved';
        $result->save();
        $branch = $result->student->Branch;
        $student = $result->student;
        $grade = $result->cgpa;
        $sms_message = "{$branch->name} আপনি কম্পিউটার কোর্সর পরীক্ষায় অংশগ্রহণ করে সফলতার সাথে উত্তীণ হয়েছেন , রোল নং :{$student->roll_no_student} রেজাল্ট: {$grade} ভিজিট :http://coxs.test/student/login Click Student Result ";
        send_sms($student->mobile, $sms_message);
        return redirect()->route('admin.offline-exam')->with('message', ' Student Published  Successfully');  
    }

    public function adminShow($id)
    {
        $result = OfflineExamResult::findOrFail($id);
        $marks = json_decode($result->marks);
        return view('admin.admin.result.onlineview', compact('result', 'marks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::with(['enrollment', 'enrollment.course_title'])
        ->where('status', 1)
        ->where('branch_id', auth('branch')->user()->id)
        ->orderBy('id', 'desc')
        ->get();
        return view('branch.branch-panel.result.offline.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'student' => ['required'],
            'course_title' => ['required'],
            'mcq' => ['required'],
            'assignment' => ['required'], 
            'viva' => ['required'],
            'gpa' => ['required'],
            'total_' => ['required'],
            'grade_' => ['required'],
            'cgpa' => ['required'],
        ]);
       
        $data['student_id'] = $request->student;
        $data['enrollment_id'] = $request->course_title;
        $data['total'] = ($request->total_ ?? 0);
        $data['grade'] = ($request->grade_ ?? 'F');
        $data['cgpa'] = ($request->cgpa ?? 0);

        $marks = [];
        foreach($request->subject as $key => $value) {
            $attachment = null;
            if($request->file('attachment')) {
                $file = $request->file('attachment')[$key];
                $attachment = date('d_m_y_'). substr(rand(), 0, 5) . '.' . $file->extension();
                $file->storeAs('public/attachment', $attachment);
            }
            $marks[$value] = [
                'mcq' => $request->mcq[$key],
                'assignment' => $request->assignment[$key],
                'viva' => $request->viva[$key],
                'total' => $request->total[$key],
                'gpa' => $request->gpa[$key],
                'grade' => $request->grade[$key],
                'attachment' => $attachment,
            ];
        }
        $data['marks'] = json_encode($marks);    
        OfflineExamResult::create($data);
        return redirect()->route('offline-exam.index')->with('message', ' Student Result Store  Successfully');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = OfflineExamResult::findOrFail($id);
        $marks = json_decode($result->marks);
        return view('branch.branch-panel.result.offline.view', compact('result', 'marks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = OfflineExamResult::findOrFail($id);
        $students = Student::with(['enrollment', 'enrollment.course_title'])
        ->where('status', 1)
        ->where('branch_id', auth('branch')->user()->id)
        ->orderBy('id', 'desc')
        ->get();
        $marks = json_decode($result->marks);
        
        return view('branch.branch-panel.result.offline.edit', compact('students', 'result', 'marks'));
    }
    
    
    public function onlineExamEdit($id)
    {
        $result = OfflineExamResult::findOrFail($id);
        $students = Student::with(['enrollment', 'enrollment.course_title'])
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->get();
        $marks = json_decode($result->marks);
        
        return view('admin.admin.result.edit', compact('students', 'result', 'marks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student' => ['required'],
            'course_title' => ['required'],
            'mcq' => ['required'],
            'assignment' => ['required'], 
            'viva' => ['required'],
            'gpa' => ['required'],
            'total_' => ['required'],
            'grade_' => ['required'],
            'cgpa' => ['required'],
        ]);

        $result = OfflineExamResult::findOrFail($id);
        $marks = (array)json_decode($result->marks);
        $new_marks = [];

        foreach($request->subject as $subject) 
        {
            if(isset($marks[$subject])) 
            {
                $new_marks[$subject] = $marks[$subject];
                $marks[$subject] = null;
            }
        }

        foreach($marks as $subject) 
        {
            if($subject) 
            {
                $file = public_path('storage/attachment/'. $subject->attachment);
                if(file_exists($file)) 
                {
                    unlink($file);
                }
            }
            
        }
        
        $data['student_id'] = $request->student;
        $data['enrollment_id'] = $request->course_title;
        $data['total'] = ($request->total_ ?? 0);
        $data['grade'] = ($request->grade_ ?? 'F');
        $data['cgpa'] = ($request->cgpa ?? 0);

        foreach($request->subject as $key => $value) 
        {
            $attachment = $new_marks[$value]->attachment ?? null;
            if($request->file('attachment')) 
            {
                $file = $request->file('attachment')[$key];
                $attachment = date('d_m_y_'). substr(rand(), 0, 5) . '.' . $file->extension();
                $file->storeAs('public/attachment', $attachment);
            }
            $new_marks[$value] = [
                'mcq' => $request->mcq[$key],
                'assignment' => $request->assignment[$key],
                'viva' => $request->viva[$key],
                'total' => $request->total[$key],
                'gpa' => $request->gpa[$key],
                'grade' => $request->grade[$key],
                'attachment' => $attachment,
            ];
        }

        $data['marks'] = json_encode($new_marks);
        $result->update($data);
        return redirect()->route('offline-exam.index')->with('message', ' Student Result update  Successfully'); 
    }



    public function onlineExamUpdate(Request $request, $id)
    {
        $request->validate([
            'student' => ['required'],
            'course_title' => ['required'],
            'mcq' => ['required'],
            'assignment' => ['required'], 
            'viva' => ['required'],
            'gpa' => ['required'],
            'total_' => ['required'],
            'grade_' => ['required'],
            'cgpa' => ['required'],
        ]);

        $result = OfflineExamResult::findOrFail($id);
        $marks = (array)json_decode($result->marks);
        $new_marks = [];

        foreach($request->subject as $subject) 
        {
            if(isset($marks[$subject])) 
            {
                $new_marks[$subject] = $marks[$subject];
                $marks[$subject] = null;
            }
        }

        foreach($marks as $subject) 
        {
            if($subject) 
            {
                $file = public_path('storage/attachment/'. $subject->attachment);
                if(file_exists($file)) 
                {
                    unlink($file);
                }
            }
            
        }
        
        $data['student_id'] = $request->student;
        $data['enrollment_id'] = $request->course_title;
        $data['total'] = ($request->total_ ?? 0);
        $data['grade'] = ($request->grade_ ?? 'F');
        $data['cgpa'] = ($request->cgpa ?? 0);

        foreach($request->subject as $key => $value) 
        {
            $attachment = $new_marks[$value]->attachment ?? null;
            if($request->file('attachment')) 
            {
                $file = $request->file('attachment')[$key];
                $attachment = date('d_m_y_'). substr(rand(), 0, 5) . '.' . $file->extension();
                $file->storeAs('public/attachment', $attachment);
            }
            $new_marks[$value] = [
                'mcq' => $request->mcq[$key],
                'assignment' => $request->assignment[$key],
                'viva' => $request->viva[$key],
                'total' => $request->total[$key],
                'gpa' => $request->gpa[$key],
                'grade' => $request->grade[$key],
                'attachment' => $attachment,
            ];
        }

        $data['marks'] = json_encode($new_marks);
        $result->update($data);
        return redirect()->route('admin.offline-exam')->with('message', ' Student Result update  Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = OfflineExamResult::findOrFail($id);
        $marks = json_decode($result->marks);
        foreach($marks as $subject) 
        {
            $file = public_path('storage/attachment/'. $subject->attachment);
            if(file_exists($file)) 
            {
                unlink($file);
            }
        }
        $result->delete();
        return redirect()->route('offline-exam.index')->with('message', ' Student Result delete  Successfully'); 
    }
    
    public function onlineExamDestroy($id)
    {
        $result = OfflineExamResult::findOrFail($id);
        $marks = json_decode($result->marks);
        foreach($marks as $subject) 
        {
            if (isset($subject->attachment)) {
                $file = public_path('storage/attachment/'. $subject->attachment);
                if(file_exists($file)) 
                {
                    unlink($file);
                }
            }
        }
        $result->delete();
        return redirect()->route('admin.offline-exam')->with('message', ' Student Result delete  Successfully'); 
    }
}
