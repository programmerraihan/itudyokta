<?php

namespace App\Http\Controllers\Admin;



use File;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Branch;
use App\Models\District;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class BranchController extends Controller
{

    public function index()
    {
        return view('branch.login');
    }  //End Method

    public function dashboard()
    {
        return view('branch.index')->with('message', 'Plz login first');
    } //End Method


    public function login(Request $request)
    {
        $check = $request->all();
        //return  $request->all();
        // dd(Auth::guard('branch')->attempt(['email' =>$check['email'], 'password' => $check['password']]));


        if (Auth::guard('branch')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('branch.dashboard')->with('error', 'Branch Login Successfully ');
        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
    } //End Method

    public function branchLogout()
    {

        Auth::guard('branch')->logout();
        return redirect()->route('login_from_branch')->with('error', 'Branch Logout Successfully ');
    } //End Method

    public function branchRegister()
    {
        return view('branch.branch_register');
    } //End Method

    public function branchRegisterCreate(Request $request)
    {
        // dd($request->all());
        Branch::create([
            'name'                      => $request->name,

            'email'                     => $request->email,
            'password'                  => Hash::make($request->password),
            'remember_token'            => Str::random(10),
            'email_verified_at'         => now(),
            'created_at'                => Carbon::now(),

        ]);
        return redirect()->route('login_from_branch')->with('error', 'Branch Created Successfully ');
    } //End Method


    public function addBranch()
    {
        $divisions = Division::where('status', 1)->get();
        $districts = District::where('status', 1)->get();
        $citys = City::where('status', 1)->get();
        return view('admin.branch.add', compact('divisions', 'districts', 'citys'));
    }


    public function store(Request $request)
    {
        //  dd($request);

        // dd(Str::slug($request->name));

        try {
            $branch = new Branch();
            $branch->name                = $request->name;
            $branch->slug                = Str::slug($request->name);

            $branch->email               = $request->email;
            $branch->password            = Hash::make($request->password);
            $branch->remember_token      = Str::random(10);
            $branch->email_verified_at   = now();
            $branch->created_at          = Carbon::now();

            $branch->personal_name       = $request->personal_name;
            $branch->father_name         = $request->father_name;
            $branch->mother_name         = $request->mother_name;
            $branch->mobil               = $request->mobil;
            $branch->personal_email      = $request->personal_email;
            $branch->gender              = $request->gender;
            $branch->religion            = $request->religion;
            $branch->nationality         = $request->nationality;
            $branch->division_id         = $request->division_id;
            $branch->district_id         = $request->district_id;
            $branch->city_id             = $request->city_id;
            $branch->upazila             = $request->upazila;
            $branch->post_office         = $request->post_office;
            $branch->address             = $request->address;


            $branch->institute_name                = $request->institute_name;
            $branch->institute_name_bangla         = $request->institute_name_bangla;
            $branch->institute_mobil               = $request->institute_mobil;
            $branch->institute_email               = $request->institute_email;
            $branch->institute_facebook            = $request->institute_facebook;
            $branch->account_type                  = $request->account_type;
            $branch->number_institute              = $request->number_institute;
            $branch->institute_age                 = $request->institute_age;
            $branch->institute_division_id         = $request->institute_division_id;
            $branch->institute_district_id         = $request->institute_district_id;
            $branch->institute_city_id             = $request->institute_city_id;
            $branch->institute_upazila             = $request->institute_upazila;
            $branch->institute_post_office         = $request->institute_post_office;
            $branch->institute_address             = $request->institute_address;
            $branch->status                        = $request->status;



            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/center/profile/', $filename);
                $branch->profile = $filename;
            }

            if ($request->hasFile('nid')) {
                $file = $request->file('nid');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/center/nid/', $filename);
                $branch->nid = $filename;
            }

            if ($request->hasFile('trade_license')) {
                $file = $request->file('trade_license');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/center/trade_license/', $filename);
                $branch->trade_license = $filename;
            }

            if ($request->hasFile('signature')) {
                $file = $request->file('signature');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/center/signature/', $filename);
                $branch->signature = $filename;
            }

            $check  = $branch->save();


            if ($check) {
                $sms_message = "আইটি উদ্যোক্তা ফাউন্ডেশন এর কম্পিউটার ট্রেনিং সেন্টার রেজিস্ট্রেশন  সম্পন্ন হয়েছে : {$request->institute_name} and আপনার ইউজার আইডি: {$request->institute_email}. আপনার লগইন : https://itudyokta.foundation/branches/login";

                send_sms($branch->institute_mobil, $sms_message);

                $exception = [
                    'success' => 'Branch Create Successfully',
                    'sms'     => $sms_message
                ];
            } else {
                $exception = ['error' => 'Database Error Found'];
            }
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
        return Redirect::back()->with('message', 'Our Branch info create successfully');
    } //End Method

    public function list()
    {
        return view('admin.branch.list', [
            'branches' => Branch::where('status', 1)->orderBy('id', 'desc')->take('100')->get()
        ]);
    } //End Method


    public function pending()
    {
        return view('admin.branch.pending', [
            'branches' => Branch::where('status', 0)->orderBy('id', 'desc')->take('100')->get(['id', 'institute_name', 'institute_mobil', 'email', 'status', 'profile'])
        ]);
    } //End Method


    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Branch::updateBranchStatus($id));
    } //End Method



    public function edit($id)
    {

        return view('admin.branch.edit', [
            'branch'    => Branch::find($id),
            'divisions' =>  Division::where('status', 1)->get(),
            'districts' =>  District::where('status', 1)->get(),
            'citys'     =>  City::where('status', 1)->get(),
        ]);
    } //End Method


    public function update(Request $request, $id)
    {
        try {

            $branch = Branch::find($id);
            $branch->name                = $request->name;
            $branch->email               = $request->email;
            $branch->password            = Hash::make($request->password);
            $branch->remember_token      = Str::random(10);
            $branch->email_verified_at   = now();
            $branch->created_at          = Carbon::now();

            $branch->personal_name       = $request->personal_name;
            $branch->father_name         = $request->father_name;
            $branch->mother_name         = $request->mother_name;
            $branch->mobil               = $request->mobil;
            $branch->personal_email      = $request->personal_email;
            $branch->gender              = $request->gender;
            $branch->religion            = $request->religion;
            $branch->nationality         = $request->nationality;
            $branch->division_id         = $request->division_id;
            $branch->district_id         = $request->district_id;
            $branch->city_id             = $request->city_id;
            $branch->upazila             = $request->upazila;
            $branch->post_office         = $request->post_office;
            $branch->address             = $request->address;


            $branch->institute_name                = $request->institute_name;
            $branch->institute_name_bangla         = $request->institute_name_bangla;
            $branch->institute_mobil               = $request->institute_mobil;
            $branch->institute_email               = $request->institute_email;
            $branch->institute_facebook            = $request->institute_facebook;
            $branch->account_type                  = $request->account_type;
            $branch->number_institute              = $request->number_institute;
            $branch->institute_age                 = $request->institute_age;
            $branch->institute_division_id         = $request->institute_division_id;
            $branch->institute_district_id         = $request->institute_district_id;
            $branch->institute_city_id             = $request->institute_city_id;
            $branch->institute_upazila             = $request->institute_upazila;
            $branch->institute_post_office         = $request->institute_post_office;
            $branch->institute_address             = $request->institute_address;
            $branch->status                        = $request->status;
            $branch->code  = $request->code;



            if ($request->hasFile('profile')) {
                $destination = 'admin/center/profile/' . $branch->image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('profile');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/center/profile/', $filename);
                $branch->profile = $filename;
            }


            if ($request->hasFile('nid')) {

                $destination = 'admin/center/nid/' . $branch->nid;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('nid');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/center/nid/', $filename);
                $branch->nid = $filename;
            }

            if ($request->hasFile('trade_license')) {

                $destination = 'admin/center/trade_license/' . $branch->trade_license;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('trade_license');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/center/trade_license/', $filename);
                $branch->trade_license = $filename;
            }

            if ($request->hasFile('signature')) {

                $destination = 'admin/center/signature/' . $branch->signature;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('signature');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/center/signature/', $filename);
                $branch->signature = $filename;
            }

            if ($request->hasFile('website_banner')) {

                $destination = 'admin/center/website_banner/' . $branch->signature;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('website_banner');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('admin/center/website_banner/', $filename);
                $branch->website_banner = $filename;
            }

            $branch->save();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
        return redirect('/branch-list')->with('message', ' Our branch info Update successfully');
    }

    public function detail($id)
    {
        return view('admin.branch.detail', [
            'branch' => Branch::find($id),
            'divisions' =>  Division::where('status', 1)->get(),
            'districts' =>  District::where('status', 1)->get(),
            'citys'     =>  City::where('status', 1)->get(),

        ]);
    }


    public function destroy($id)
    {
        $branch = Branch::find($id);
        // dd($this->project);
        $branch->delete();
        return redirect('/branch-list')->with('message', 'Branch info Delete Successfully');
    }


    // public function apiTest()
    // {


    //     $ap_key = '175527378032626420230117064522pmipOmxSyW';
    //     $sender_id = '347';
    //     $mobile_no = '01717175652,01710029052';
    //     $message = 'This is test SMS';
    //     $user_email = 'softbdweb@gmail.com';
    //     return techno_bulk_sms($ap_key, $sender_id, $mobile_no, $message, $user_email);
    // }



    public function divisionDistrict(Request $request)
    {
        $districts = District::where('status', 1)->where('division_id', $request->id)->get();
        return response()->json($districts);
    }
    public function districtCity(Request $request)
    {

        $citys = City::where('status', 1)->where('district_id', $request->id)->get();
        return response()->json($citys);
    }

    public function insDivisionDistrict(Request $request)
    {
        $districts = District::where('status', 1)->where('division_id', $request->id)->get();
        return response()->json($districts);
    }
    public function insDistrictCity(Request $request)
    {
        $citys = City::where('status', 1)->where('district_id', $request->id)->get();
        return response()->json($citys);
    }
}
