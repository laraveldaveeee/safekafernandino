<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Rescuer extends Model
{
    use Notifiable;

    protected $guarded = [];

    public function emergency()
    {
        return $this->belongsTo(EmergencyType::class);
    }    

    public function routeNotificationForSms()
    {
        return $this->contact;
    }


}
