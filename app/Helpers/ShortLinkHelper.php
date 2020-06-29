<?php


namespace App\Helpers;


class ShortLinkHelper
{

    /**
     * @param $url
     */
    public static function shortUrl($url)
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
