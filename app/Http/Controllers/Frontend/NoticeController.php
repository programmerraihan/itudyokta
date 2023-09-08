<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

use File;

class NoticeController extends Controller
{
    public function index()
    {

        $notices = Notice::all();
        return view('admin.frontend.home.notice.index', compact('notices'));
    }
    //End Method


    public function addNotice()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('admin.frontend.home.notice.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $notice = new Notice();
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
        return redirect('/notice-index')->with('message', 'Notice info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $notice = Notice::find($id);
        return view('admin.frontend.home.notice.edit', compact('notice'));
    } //End Method



    public function update(Request $request, $id)
    {

        $notice = Notice::find($id);

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
        return redirect('/notice-index')->with('message', 'Notice info Update successfully');
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
        return redirect('/notice-index')->with('message', 'Notice info Delete Successfully');
    }
}
