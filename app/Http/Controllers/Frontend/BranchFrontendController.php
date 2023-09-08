<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Branch;
use App\Models\Notice;
use App\Models\OurSpeech;
use App\Models\OurProject;
use App\Models\OurService;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchFrontendController extends Controller
{

    public function branchCourseDetail($slug, $id)
    {
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;
        $course = CourseTitle::where('status', 1)->where('branch_id', $branch_id)->where('id', $id)->first();
        return view('branch.frontend.page.course_details', compact('slug', 'course'));
    }

    public function branchSpeechDetail($slug, $id)
    {
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;
        $speech = OurSpeech::where('id', $id)->where('branch_id', $branch_id)->first();
        return view('branch.frontend.page.speech_details', compact('speech'));
    }

    public function branchNoticeDetail($slug, $id)
    {
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;
        $notice = Notice::where('id', $id)->where('branch_id', $branch_id)->first();
        return view('branch.frontend.page.notice_details', compact('notice'));
    }

    public function branchServiceDetail($slug, $id)
    {
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;
        $service = OurService::where('status', 1)->where('id', $id)->where('branch_id', $branch_id)->first();
        return view('branch.frontend.page.service_detail', compact('service'));
    }

    public function branchProjectDetail($slug, $id)
    {
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;
        $project = OurProject::where('status', 1)->where('id', $id)->where('branch_id', $branch_id)->first();
        return view('branch.frontend.page.project_detail', compact('project'));
    }

    public function branchBlogDetail($slug, $id)
    {
        $branch = Branch::where('slug', $slug)->select('id')->first();
        $branch_id = $branch->id;
        $blog = Blog::where('status', 1)->where('id', $id)->where('branch_id', $branch_id)->first();
        // dd($blog);
        return view('branch.frontend.page.blog_detail', compact('blog'));
    }
}
