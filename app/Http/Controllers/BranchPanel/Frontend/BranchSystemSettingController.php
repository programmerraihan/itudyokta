<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use File;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchSystemSettingController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $systems = SystemSetting::Where('branch_id', $id)->get();
        return view('branch.frontend.system.index', compact('systems'));
    }


    public function addSystem()
    {
        return view('branch.frontend.system.add');
    }

    public function store(Request $request)
    {

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $logo = time() . '.' . $extension;
            $file->move('frontend/image/logo/', $logo);
        }

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time() . '.' . $extension;
            $file->move('frontend/image/icon/', $icon);
        }

        $id = Auth::guard('branch')->user()->id;

        $data = ([
            'branch_id'        => $id,
            'name'             => $request->input('name'),
            'phon'             => $request->input('phon'),
            'instagram'        => $request->input('instagram'),
            'pinterest'        => $request->input('pinterest'),
            'youtube'          => $request->input('youtube'),
            'facebook'         => $request->input('facebook'),
            'twitter'          => $request->input('twitter'),
            'address1'         => $request->input('address1'),
            'phone1'           => $request->input('phone1'),
            'gmail1'           => $request->input('gmail1'),
            'address2'         => $request->input('address2'),
            'phone2'           => $request->input('phone2'),
            'gmail2'           => $request->input('gmail2'),
            'start_day_time'   => $request->input('start_day_time'),
            'status'           => $request->input('status'),
            'facebook_embed'   => $request->input('facebook_embed'),
            'google_embed'     => $request->input('google_embed'),
            'logo'             => $logo,
            'icon'             => $icon,
        ]);
        $SystemSetting = SystemSetting::create($data);
        return redirect('branches/system-index')->with('message', ' System Setting  info Create  successfully');
    }


    public function edit($id)
    {
        $system = SystemSetting::find($id);
        return view('branch.frontend.system.edit', compact('system'));
    }




    public function update(Request $request, $id)
    {
        // dd($request);

        $system = SystemSetting::find($id);
        $logo = $system->logo;
        $icon = $system->icon;

        if ($request->hasFile('logo')) {


            $destination = 'frontend/image/logo/' . $system->logo;
            if (File::exists($destination)) {
                File::delete($destination);
            }


            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $logo = time() . '.' . $extension;
            $file->move('frontend/image/logo/', $logo);
        }

        if ($request->hasFile('icon')) {


            $destination = 'frontend/image/icon/' . $system->icon;
            if (File::exists($destination)) {
                File::delete($destination);
            }


            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time() . '.' . $extension;
            $file->move('frontend/image/icon/', $icon);
        }

        $branch_id = Auth::guard('branch')->user()->id;

        $data = ([
            'branch_id'        => $branch_id,
            'name'             => $request->input('name'),
            'phon'             => $request->input('phon'),
            'instagram'        => $request->input('instagram'),
            'pinterest'        => $request->input('pinterest'),
            'youtube'          => $request->input('youtube'),
            'facebook'         => $request->input('facebook'),
            'twitter'          => $request->input('twitter'),
            'address1'         => $request->input('address1'),
            'phone1'           => $request->input('phone1'),
            'gmail1'           => $request->input('gmail1'),
            'address2'         => $request->input('address2'),
            'phone2'           => $request->input('phone2'),
            'gmail2'           => $request->input('gmail2'),
            'start_day_time'   => $request->input('start_day_time'),
            'status'           => $request->input('status'),
            'facebook_embed'   => $request->input('facebook_embed'),
            'google_embed'     => $request->input('google_embed'),
            'logo'             => $logo,
            'icon'             => $icon,
        ]);

        $acTransaction = SystemSetting::where('id', $system->id)->update($data);

        return redirect('branches/system-index')->with('message', ' Our District info Update successfully');
    }


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', SystemSetting::updateSystemStatus($id));
    }

    public function destroy($id)
    {
        $system = SystemSetting::find($id);

        $system->delete();
        return redirect('branches/system-index')->with('message', 'system info Delete Successfully');
    }
}
