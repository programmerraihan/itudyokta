<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use App\Models\Notice;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesNoticeController extends Controller
{
    public function index()
    {

        $id = Auth::guard('branch')->user()->id;
        $notices =  Notice::where('branch_id', $id)->get();

        //$notices = Notice::all();
        return view('branch.branch-panel.home.notice.index', compact('notices'));
    }
    //End Method


    public function addNotice()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.notice.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $notice = new Notice();
        $notice->branch_id =  Auth::guard('branch')->user()->id;
        $notice->title              =  $request->input('title');
        $notice->long_text        =  $request->input('long_text');
        $notice->time              =  $request->input('time');
        $notice->status             =  $request->input('status');


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/notice/', $filename);
            $notice->image = $filename;
        }
        $notice->save();
        return redirect('branches/notice-index')->with('message', 'Notice info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $notice = Notice::find($id);
        return view('branch.branch-panel.home.notice.edit', compact('notice'));
    } //End Method



    public function update(Request $request, $id)
    {

        $notice = Notice::find($id);
        $notice->branch_id =  Auth::guard('branch')->user()->id;

        $notice->title              =  $request->input('title');
        $notice->long_text        =  $request->input('long_text');
        $notice->time              =  $request->input('time');
        $notice->status             =  $request->input('status');


        if ($request->hasFile('image')) {
            $destination = 'frontend/notice/' . $notice->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/notice/', $filename);
            $notice->image = $filename;
        }

        $notice->save();
        return redirect('branches/notice-index')->with('message', 'Notice info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Notice::updateNoticeStatus($id));
    }


    public function destroy($id)
    {
        $this->notice = Notice::find($id);
        // dd($this->notice);
        $this->notice->delete();
        return redirect('branches/notice-index')->with('message', 'Notice info Delete Successfully');
    }
}
