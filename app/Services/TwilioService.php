<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    public function sendWhatsApp($to, $message)
    {
        $client = new Client(
            env('TWILIO_SID'),
            env('TWILIO_AUTH_TOKEN')
        );

        $client->messages->create(
            "whatsapp:$to",
            [
                'from' => env('TWILIO_WHATSAPP_FROM'),
                'body' => $message
            ]
        );
    }
}
