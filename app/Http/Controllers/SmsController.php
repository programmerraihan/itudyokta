<?php

namespace App\Http\Controllers;

use App\Models\SmsProvider;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = SmsProvider::with(['branch'])->orderBy('id', 'desc')
        ->when(auth('branch')->check(), function($query) {
            return $query->where('branch_id', auth('branch')->user()->id);
        })
        ->when(auth('web')->check(), function($query) {
            return $query->whereNull('branch_id');
        })
        ->get();
        return view('sms.index', compact('providers'));
    }

    public function active($sms_provider, $status) 
    {
        $provider = SmsProvider::findOrFail($sms_provider);
        $provider->active = $status == 'on';
        $provider->save();
        return redirect()->route('sms-provider.index')->with('message', 'SMS Provider updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sms.create');
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
            "name" => "required",
            "provider_url" => "required",
            "sms_check_url" => "required",
            "phone" => 'required',
            "message" => "required",
            "branch_id" => "nullable",
        ]);

        $data = $request->all();
        $extra['phone'] = $request->phone;
        $extra['message'] = $request->message;
        $extra['extra'] = [];
        if($request->value) {
            foreach($request->value as $key => $value) {
                $extra['extra'][$request->key[$key]] = $value;
            }
        }
        $data['active'] = false;
        if($request->active) {
            $data['active'] = true;
        }
       
        $data['extra'] = json_encode($extra);
        SmsProvider::create($data);
        return redirect()->route('sms-provider.index')->with('message', 'SMS Provider create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sms_provider)
    {
        $provider = SmsProvider::findOrFail($sms_provider);
        $extra = json_decode($provider->extra);

        return view('sms.edit', compact('provider', 'extra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sms_provider)
    {
        $request->validate([
            "name" => "required",
            "provider_url" => "required",
            "sms_check_url" => "required",
            "phone" => 'required',
            "message" => "required",
            "branch_id" => "nullable",
        ]);

        $data = $request->all();
        $extra['phone'] = $request->phone;
        $extra['message'] = $request->message;
        $extra['extra'] = [];
        if($request->value) {
            foreach($request->value as $key => $value) {
                $extra['extra'][$request->key[$key]] = $value;
            }
        }
        $data['active'] = false;
        if($request->active) {
            $data['active'] = true;
        }
       
        $data['extra'] = json_encode($extra);
        $provider = SmsProvider::findOrFail($sms_provider);
        $provider->update($data);
        return redirect()->route('sms-provider.index')->with('message', 'SMS Provider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sms_provider)
    {
        $provider = SmsProvider::findOrFail($sms_provider);
        $provider->delete();
        return redirect()->route('sms-provider.index')->with('message', 'SMS Provider deleted successfully');
    }
}
