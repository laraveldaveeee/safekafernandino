<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'email',
        'gender',
        'birthdate',
        'current_latitude',
        'current_longitude',
        'last_reported_at',
    ];
}
