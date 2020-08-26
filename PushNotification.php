<?php

class PushNotification
{
    private $api_key = 'AAAA7Ubde3I:APA91bEWz0xZizNMMzIH4J5AtVcd54cdI9yYG9pDhc3jDOPB63na4igLOwDabLjbTnp8HdRRdYG-kH6rhLavVV-X-WBMQxOoqnzpzjItxE_q27bNXA5rM1NitLrfTChmP_iaFjojAol8';
    private $endpoint = 'https://fcm.googleapis.com/fcm/send';
    private $toAll = '/topics/notif_pegawai';
    private $default_action = 'FLUTTER_NOTIFICATION_CLICK';
    private $default_page = '/NotifScreen';

    public function sendToAll(String $title, String $body, String $image = null)
    {
        $fields = $this->buildFields($this->toAll, $title, $body, $image);
        return $this->send($fields);
    }

    public function sendToOne(String $to, String $title, String $body, String $image = null)
    {
        $fields = $this->buildFields($to, $title, $body, $image);
        return $this->send($fields);
    }

    private function send(array $fields)
    {
        $headers = array
        (
            'Authorization: key=' . $this->api_key,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $this->endpoint );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        return $result;
    }

    private function buildFields(String $to, string $title, string $body, ?string $image): array
    {
        $fields = [
            'priority' => 'high',
            'to' => $to,
            'notification' => [
                'title' => $title,
                'body' => substr($body, 0, 100),
                'image' => $image,
                'click_action' => $this->default_action,
            ],
            'data' => [
                'title' => $title,
                'description' => $body,
                'image' => $image,
                'page' => $this->default_page,
            ],
        ];
        return $fields;
    }

}

