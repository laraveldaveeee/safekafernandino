<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyType extends Model
{
    protected $fillable = ['name'];

    public function rescuers()
    {
        return $this->hasMany(Rescuer::class);
    }

}
