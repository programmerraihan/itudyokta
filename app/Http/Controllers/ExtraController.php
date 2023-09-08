<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Student;
use App\Models\Branch;
use App\Models\Student as ModelsStudent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ExtraController extends Controller
{

    public function setNewPassword()
    {
        if(!request()->type) {
            return redirect()->route('home');
        }
        return view('auth.change-password');
    }

    public function storeNewPassword(Request $request) {
        $request->validate([
            'type' => 'required|string',
            'verification_code' => ['required', 'numeric', 'exists:change_password'],
            'password' => 'required|confirmed',
        ]);
        $password_change = DB::table("change_password")->where('verification_code', $request->verification_code)->first();
        $valid_date = Carbon::parse($password_change->valid_till);
        $now = Carbon::now();
        if(!$now->lessThan($valid_date)) {
            return redirect()->back()->with('error', 'Your verification code expired');
        }

        if($request->type == 'student') {
            $student = ModelsStudent::where('mobile', $password_change->mobile)->first();
            $student->password = Hash::make($request->password);
            $student->save();
            Auth::guard('student')->login($student);
            return redirect('student/dashboard')->with('error', 'Student Login Successfully ');
        }
        
        if($request->type == 'branch') {
            $branch = Branch::where('mobil', $password_change->mobile)->first();
            $branch->password = Hash::make($request->password);
            $branch->save();
            Auth::guard('branch')->login($branch);
            return redirect()->route('branch.dashboard')->with('error', 'Branch Login Successfully ');
        }

        return redirect()->back()->with('error', 'Something went worng!');
    }

    /**
     * reset password by email
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function changePassword(Request $request)
    {
        if($request->type == 'student') {
            return $this->studentPasswordReset($request);
        }

        if($request->type == 'branch') {
            return $this->branchPasswordReset($request);
        }

        if($request->type == 'admin') {
            return redirect()->back()->with('message', 'Sorry! you don\'t have mobile number');
        }
    }

    public function branchPasswordReset($request) {
        $branch = Branch::where('mobil', $request->mobile)->first();
        if(!$branch) {
            return redirect()->back()->with('message', 'Mobile number is invalid');
        }
        $code = substr(rand(),0, 6);        
        $check = DB::table('change_password')->where('verification_code', $code)->first();
        while($check) {
            $code = substr(rand(),0, 6);
            $check = DB::table('change_password')->where('verification_code', $code)->first();
        }

        $verification_code = $code;
        $mobile = $request->mobile;
        $valid_till = Carbon::now()->addMinutes(10);
        $data = compact('verification_code', 'mobile', 'valid_till');
        DB::table('change_password')->insert($data);
        $text = "Your verification code is ". $code . " . Click here for " . route('set.new.password', ['type' => 'branch']) . ' for reset password.' ;
        bulk_sms_send($request->mobile, $text);
        return redirect()
        ->route('set.new.password', ['type' => 'branch'])
        ->with([
            'message' => 'Verification code sent your mobile.',
            'time' => date('h:i A', strtotime($valid_till)),
        ]);
    }

    public function studentPasswordReset($request) {
        $student = ModelsStudent::where('mobile', $request->mobile)->first();
        if(!$student) {
            return redirect()->back()->with('message', 'Mobile number is invalid');
        }
        $code = substr(rand(),0, 6);        
        $check = DB::table('change_password')->where('verification_code', $code)->first();
        while($check) {
            $code = substr(rand(),0, 6);
            $check = DB::table('change_password')->where('verification_code', $code)->first();
        }

        $verification_code = $code;
        $mobile = $request->mobile;
        $valid_till = Carbon::now()->addMinutes(10);
        $data = compact('verification_code', 'mobile', 'valid_till');
        DB::table('change_password')->insert($data);
        $text = "Hello " . $student->name . ", Your verification code is ". $code . " . Click here for " . route('set.new.password', ['type' => 'student']) . ' for reset password.' ;
        bulk_sms_send($request->mobile, $text);
        return redirect()
        ->route('set.new.password', ['type' => 'student'])
        ->with([
            'message' => 'Verification code sent your mobile.',
            'time' => date('h:i A', strtotime($valid_till)),
        ]);
    }
}
