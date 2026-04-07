<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Incident extends Model
{

    use Notifiable; 

    protected $fillable = [
        'user_id',
        // 'rescuer_id',
        'child_id',
        'type',
        'locations',
        'latitude',
        'longitude',
        'contact',
        'status',
        'media',
    ];

    public function routeNotificationForSms()
    {
        return $this->contact;
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }


    // public function rescuer()
    // {
    //     return $this->belongsTo(Rescuer::class);
    // }

  public function rescuers()
{
    return $this->belongsToMany(Rescuer::class,
        'incident_rescuer',
        'incident_id',
        'rescuer_id' );
}
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
