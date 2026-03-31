<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Notifications\Channels\SmsChannel;

class IncidentDispatched extends Notification
{
    protected $incident;

    public function __construct($incident)
    {
        $this->incident = $incident;
    }

    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    public function toSms($notifiable)
    {
        return "Incident #{$this->incident->id} has been dispatched!";
    }
}