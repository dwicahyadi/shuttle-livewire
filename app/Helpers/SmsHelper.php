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
        if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'){
            //$link = ShortLinkHelper::shortUrl('https://google.com');
            $link = 'sys.suryashuttle.com/';
        }else{
            //$link = ShortLinkHelper::shortUrl(route('cust.view', ['reservationId' => $reservationId]));
            $link = 'sys.suryashuttle.com/s/'.$reservationId;
        }
        $reservation->short_url = $link ?? '';
        $reservation->save();

        if ($reservation->transfer_amount)
        {
            $msg = "Silakan lakukan transfer sebesar ".number_format($reservation->transfer_amount)." ke rek ".config('settings.company_bank_account')." sebelum ". $reservation->expired_at.". Terimakasih. -SURYASHUTTLE";
        }else{
            $msg = "Hore! Bookingan kamu berhasil.\r\nPastikan datang max 10 mnt sblm kbrgktn\r\nDetail booking: $link\r\n -SURYASHUTTLE";
        }
        $payload['phone'] = $reservation->customer->phone;
        $payload['message'] = $msg;

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

}
