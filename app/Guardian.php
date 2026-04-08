<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $guarded = [];

    public function childrens()
    {
        return $this->hasMany(Children::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
