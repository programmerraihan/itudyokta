<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function send_sms($phone, $message)
    {

        $api_key='$2y$10$grpWZKJBtzQUGbrpLeRhjebw0YQgF85mxD.VFclUfjeF/0MIg9KJG';
        $phone = strlen($phone)==11? "88".$phone:$phone;
        return Http::get("http://portal.jadusms.com/smsapi/non-masking?api_key=$api_key&smsType=text&mobileNo=$phone&smsContent=$message");
       
    }
}
