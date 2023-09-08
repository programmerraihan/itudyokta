<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use App\Models\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;
use Yajra\DataTables\Facades\DataTables;

class BranchesBlogController extends Controller
{
    public function index()
    {

        // $id = Auth::guard('branch')->user()->id;
        // $blogs =  Blog::where('branch_id', $id)->get();
        // dd($blogs);

        // $blogs = Blog::all();
        return view('branch.branch-panel.home.blog.index');
    }
    //End Method

    public function getBlog()
    {
        $id = Auth::guard('branch')->user()->id;

        $blogs =  Blog::where('branch_id', $id)->get();
        // dd($blogs);

        // $blogs = Blog::get();
        return DataTables::of($blogs)
            ->addIndexColumn()
            ->setRowAttr(['align' => 'center'])
            ->addColumn('status', function (Blog $blog) {

                if ($blog->status == 1) {
                    $status = '<span class="badge badge-pill badge-soft-success font-size-12">Published</span>';
                } elseif ($blog->status == 0) {
                    $status = '<span class="badge badge-pill badge-soft-warning font-size-12">Unpublished</span>';
                } else {
                    $status = '<span class="mj_btn btn btn-warning">Pending</span>';
                }
                return $status;
            })

            ->addColumn('image', function (Blog $blog) {

                return '<img src="frontend/blog/' . $blog->image . ' " width=100px />';
            })

            ->addColumn('action', function (Blog $blog) {


                $status = ' <a href="' . route('branch.blog.update-status', $blog->id) . '"
                    class="btn {{ $blog->status == 1 ? ' . ' btn - info' . ' : ' . 'btn - warning ' . ' }} btn-sm">
                    <i class="fas fa-arrow-alt-circle-up"></i>
                </a>';


                $edit = '<a href="' . route('branch.blog.edit', $blog->id) . '" class="btn btn-success btn-sm waves-effect">
                <i class="fas fa-edit"></i></a>';

                $delete = '<a href="javascript:void(0);" data-id="' . $blog->id . '" data-toggle="modal" data-target="#DeleteModal" id="getDeleteId" data-toggle="tooltip" class="delete btn" style="padding: 2px;"><i class="fa fa-trash text-danger actions_icon" title="Click to Delete"></i></a>';

                // $show = ' <a data-target=".show-modal-' . $blog->id . '" data-toggle="modal" class="btn" title="Click to View" style="padding: 8px;">
                // <i class="fa fa-eye text-primary"></i> </a>';
                return $status . $edit . $delete;
            })

            ->rawColumns(['status', 'action', 'image'])
            ->make(true);
    }


    public function addBlog()
    {
        // $homeSlidData = HomeSlide::find(1);
        return view('branch.branch-panel.home.blog.add');
    }
    //End Method


    public function store(Request $request)
    {
        //return $request->all();
        $blog = new Blog();
        $blog->branch_id =  Auth::guard('branch')->user()->id;

        $blog->title              =  $request->input('title');
        $blog->status             =  $request->input('status');
        $blog->body                   =  $request->input('body');
        $blog->sort                   =  $request->input('sort');
        $blog->slug                   =  $request->input('slug');
        $blog->user_id                =  $request->input('user_id');


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/blog/', $filename);
            $blog->image = $filename;
        }
        $blog->save();
        return redirect('branches/blog-index')->with('message', 'Our Blog info create successfully');
    }
    //End Method

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('branch.branch-panel.home.blog.edit', compact('blog'));
    } //End Method



    public function update(Request $request, $id)
    {

        $blog = Blog::find($id);

        $blog->branch_id =  Auth::guard('branch')->user()->id;

        $blog->title                  =  $request->input('title');
        $blog->status                 =  $request->input('status');
        $blog->body                   =  $request->input('body');
        $blog->sort                   =  $request->input('sort');
        $blog->slug                   =  $request->input('slug');
        $blog->user_id                =  $request->input('user_id');


        if ($request->hasFile('image')) {
            $destination = 'frontend/blog/' . $blog->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('frontend/blog/', $filename);
            $blog->image = $filename;
        }

        $blog->save();
        return redirect('branches/blog-index')->with('message', ' Our Blog info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Blog::updateBlogStatus($id));
    }


    public function destroy($id)
    {
        $this->blog = Blog::find($id);

        $this->blog->delete();
        return redirect('branches/blog-index')->with('message', 'Blog info Delete Successfully');
    }
}
