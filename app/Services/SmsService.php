<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    protected $url;
    protected $token;

    public function __construct()
    {
        $this->url = env('IPROG_API_URL', 'https://www.iprogsms.com/api/v1/sms_messages');
        $this->token = env('IPROG_API_TOKEN');
    }

    public function sendSms($to, $message)
    {
        $formattedNumber = $this->formatNumber($to);

        $response = Http::withOptions([
            'verify' => false // remove in production
        ])->asForm()->post($this->url, [
            'api_token' => $this->token,
            'message' => 'Your SMS message has been successfully added to the queue and will be processed shortly.',
            'contact' => $formattedNumber, //  
           // 'sender' => 'RescueApp' //  
        ]);

        \Log::info('SMS FULL DEBUG', [
            'number' => $formattedNumber,
            'message' => $message,
            'status' => $response->status(),
            'response' => $response->body()
        ]);

        if ($response->failed()) {
            \Log::error('SMS Failed', [
                'number' => $formattedNumber,
                'response' => $response->body()
            ]);
        }

        return $response->successful();
    }

    private function formatNumber($number)
    {
        if (substr($number, 0, 1) === '0') {
            return '63' . substr($number, 1);
        }

        if (substr($number, 0, 2) === '63') {
            return $number;
        }

        return $number;
    }
}