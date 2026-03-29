<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvacuationPoint extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'status',
    ];
}
