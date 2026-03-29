<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
        'user_id',
        'rescuer_id',
        'child_id',
        'type',
        'locations',
        'latitude',
        'longitude',
        'contact',
        'status',
        'media',
    ];
}
