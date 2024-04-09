<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendWhatsAppMessage()
    {
        $sid    = config('app.twilio_account_sid');
        $token  = config('app.twilio_auth_token');
        $twilio = new Client($sid, $token);

        $twilio->messages
            ->create(
                "whatsapp:+59164488298", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => "hola desde laravel"
                )
            );
            return response()->json(['message' => 'WhatsApp message sent successfully']);
    }
}
