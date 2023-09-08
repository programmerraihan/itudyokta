<?php

use App\Models\SmsProvider;

require_once __DIR__."/number_format.php";

function imageUpload($image, $directory, $imageName = null)
{
    if ($imageName) {
        $name = $imageName;
    } else {
        $name = $image->getClientOriginalName();
    }

    $image->move($directory, $name);
    return $directory . $name;
}

function techno_bulk_sms($ap_key, $sender_id, $mobile_no, $message, $user_email)
{
    $url = 'https://24bulksms.com/24bulksms/api/api-sms-send';
    $data = array(
        'api_key' => $ap_key,
        'sender_id' => $sender_id,
        'message' => $message,
        'mobile_no' => $mobile_no,
        'user_email' => $user_email
    );

    // use key 'http' even if you send the request to https://...
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($curl);
    curl_close($curl);
    print_r($output);
}

/**
 * send message to client phone
 * @param int $mobile
 * @param mixed $message
 * @return void
 */
function bulk_sms_send($mobile,  $message, $branch_id=null)
{
    try {
        $provider = SmsProvider::where('active', true)
        ->when(!is_null($branch_id), function ($query)use($branch_id) {
            return $query->where('branch_id', $branch_id);
        })
        ->first();
        if(!$provider) {
            $provider = SmsProvider::where('active', true)
            ->whereNull('branch_id')
            ->first();
        }
        $url = $provider->provider_url;
        $extra = json_decode($provider->extra);
        $data[$extra->phone] = $mobile;
        $data[$extra->message] = $message;
        if($extra->extra) {
            foreach($extra->extra as $key => $value) {
                $data[$key] = $value;
            }
        }

        // use key 'http' even if you send the request to https://...
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($curl);
        curl_close($curl);
        print_r($output);
    }catch(\Exception $e) {
        return;
        // abort('505', 'Something went worng');
    }
    return;
}

function send_sms($mobile_no,  $message, $branch_id=null)
{
    // $ap_key = '175527378032626420230117064522pmipOmxSyW';
    // $sender_id = '347';
    // $user_email = 'softbdweb@gmail.com';
    // return techno_bulk_sms($ap_key, $sender_id, $mobile_no, $message, $user_email);
    return bulk_sms_send($mobile_no, $message, $branch_id);
}


function init_payment($requestData)
{
    $response = Http::withHeaders([
        'Content-Type'          => 'application/json',
        'RT-UDDOKTAPAY-API-KEY' => env("UDDOKTAPAY_API_KEY"),
    ])
        ->asJson()
        ->withBody(json_encode($requestData), "JSON")
        ->post(env("UDDOKTAPAY_PAYMENT_DOMAIN") . "/api/checkout");

    if ($response->successful()) {
        return $response->collect()['payment_url'];
    } else {
        dd($response->body());
    }
}
