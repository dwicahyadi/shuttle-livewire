<?php
namespace App\Helpers;


use App\Http\Livewire\Reservation;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SmsHelper
{
    public static function getCredit()
    {
        $endpoint = config('settings.sms_services_url')
            .'balance/?userkey='.config('settings.sms_services_user')
            .'&passkey='.config('settings.sms_services_key');

        $data = file_get_contents($endpoint);
        return json_decode($data)->credit;
    }

    public static function getExpired()
    {
        $endpoint = config('settings.sms_services_url')
            .'balance/?userkey='.config('settings.sms_services_user')
            .'&passkey='.config('settings.sms_services_key');

        $data = file_get_contents($endpoint);
        return json_decode($data)->expired;
    }

    public static function generateMsg($reservationId)
    {
        $reservation = \App\Models\Reservation::find($reservationId);
        $link = self::shortUrl(route('cust.view',['reservationId'=>$reservationId]));
        $payload['phone'] = $reservation->customer->phone;
        $payload['message'] = "Hore! Bookingan kamu bhsl.
        Pastikan datang max 10 mnt sblm kbrgktn.
        Deetail booking: $link
        -dikirim otmtis by system";

        dispatch(new \App\Jobs\SendSms($payload));
    }

    public static function sendMsg($destinationNumber, $message)
    {
        $userkey = config('settings.sms_services_user');
        $passkey = config('settings.sms_services_key');
        $endpoint = config('settings.sms_services_url').'sendsms/';

        if (!$userkey || !$passkey ){
            return false;
        }
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $endpoint);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'nohp' => $destinationNumber,
            'pesan' => $message
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
        return $results;
    }

    /**
     * @param $url
     */
    private static function shortUrl($url)
    {
        $domain_data["fullName"] = "rebrand.ly";
        $post_data["destination"] = $url;
        $post_data["domain"] = $domain_data;
        //$post_data["slashtag"] = "A_NEW_SLASHTAG";
        //$post_data["title"] = "Rebrandly YouTube channel";
        $ch = curl_init("https://api.rebrandly.com/v1/links");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "apikey: 5b66f500065f48dc90783492e75396a3",
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result, true);
//        dd($url);
        return $response["shortUrl"];
    }

}
