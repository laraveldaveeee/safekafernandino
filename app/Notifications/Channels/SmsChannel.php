<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use App\Services\SmsService;

class SmsChannel
{
    protected $smsService;

    public function __construct()
    {
        $this->smsService = new SmsService();
    }

    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toSms')) {
            return;
        }

        $message = $notification->toSms($notifiable);
        $to = $notifiable->routeNotificationFor('sms');

        if (!$to) {
            \Log::error('No contact number found for SMS');
            return;
        }

        $this->smsService->sendSms($to, $message);
    }
}