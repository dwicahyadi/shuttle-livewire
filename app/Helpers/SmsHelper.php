<?php
namespace App\Helpers;


use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SmsHelper
{
    public static function getCredit()
    {
        $data = file_get_contents('https://gsm.zenziva.net/api/balance/?userkey=c3y06u&passkey=e0dmk6hcl6');
        return json_decode($data)->credit;
    }

    public static function getExpired()
    {
        $data = file_get_contents('https://gsm.zenziva.net/api/balance/?userkey=c3y06u&passkey=e0dmk6hcl6');
        return json_decode($data)->expired;
    }

}
